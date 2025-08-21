<?php

namespace App\Controllers\Api;

class Productos extends BaseApiController
{
    protected $modelName = 'App\Models\ProductosModel';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function create()
    {
        //sigo sin entender xq esto no funciona tal vez sea la version de php
        //$input = $this->request->getPost();
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->invalidJsonResponse();
        }

        if (!$data) {
            return $this->emptyJsonResponse();
        }

        if (!$this->model->insert($data)) {
            return $this->errorResponse('Error al crear el producto', $this->model->errors(), 422);
        }

        $data['id'] = $this->model->getInsertID();
        $clave = $data['clave'];

        // Insertar registros en prods_download para cada dispositivo activo
        $dispositivoModel = model('App\Models\DispositivosModel');
        $prodsDownloadModel = model('App\Models\ProdsDownloadModel');
        $dispositivos = $dispositivoModel->where('activo', 1)->findAll();
        foreach ($dispositivos as $disp) {
            if (empty($disp['masterproductos']) || intval($disp['masterproductos']) !== 1) {
                $prodsDownloadModel->insert([
                    'clave' => $clave,
                    'dispositivo' => $disp['dispositivo'],
                    'aplicado' => 0,
                    'fecha_registro' => date('Y-m-d H:i:s')
                ]);
            }
        }

        return $this->successResponse('Producto creado correctamente.', $data, 201);
    }

    public function show($identifier = null)
    {
        if (!$identifier) {
            return $this->failValidationErrors('Identificador requerido (id o clave del producto)');
        }

        // Buscar por ID o por clave
        $producto = is_numeric($identifier)
            ? $this->model->find($identifier)
            : $this->model->where('clave', $identifier)->first();

        if (!$producto) {
            return $this->failNotFound("Producto no encontrado.");
        }

        return $this->successResponse('Producto encontrado.', $producto);
    }

    public function update($identifier = null)
    {
        if (!$identifier) {
            return $this->failValidationErrors('Identificador requerido (id o clave del producto)');
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->invalidJsonResponse();
        }

        if (!is_array($data) || empty($data)) {
            return $this->failValidationErrors('Datos inválidos o vacíos.');
        }

        // Buscar el producto por ID o clave
        $producto = is_numeric($identifier)
            ? $this->model->find($identifier)
            : $this->model->where('clave', $identifier)->first();

        if (!$producto) {
            return $this->failNotFound("Producto no encontrado.");
        }

        // Si la clave no está en los datos o es la misma que la actual, remover validación única
        if (!isset($data['clave']) || $data['clave'] === $producto['clave']) {
            $this->model->setValidationRule('clave', 'required|max_length[50]');
        } else {
            // Si se está cambiando la clave, validar que sea única
            $this->model->setValidationRule(
                'clave',
                "required|max_length[50]|is_unique[productos.clave,ID,{$producto['ID']}]"
            );
        }


        // Actualizar usando siempre el ID
        if (!$this->model->update($producto['ID'], $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        $clave = isset($data['clave']) ? $data['clave'] : $producto['clave'];
        // Insertar o actualizar registros en prods_download para cada dispositivo activo
        $dispositivoModel = model('App\Models\DispositivosModel');
        $prodsDownloadModel = model('App\Models\ProdsDownloadModel');
        $dispositivos = $dispositivoModel->where('activo', 1)->findAll();
        foreach ($dispositivos as $disp) {
            //if (empty($disp['masterproductos']) || intval($disp['masterproductos']) !== 1) {
                // Si ya existe el registro, lo pone como pendiente
                $row = $prodsDownloadModel->where([
                    'clave' => $clave,
                    'dispositivo' => $disp['nombre']
                ])->first();
                if ($row) {
                    $prodsDownloadModel->update($row['id'], [
                        'aplicado' => 0,
                        'fecha_aplicado' => null
                    ]);
                } else {
                    $prodsDownloadModel->insert([
                        'clave' => $clave,
                        'dispositivo' => $disp['nombre'],
                        'aplicado' => 0,
                        'fecha_registro' => date('Y-m-d H:i:s')
                    ]);
                }
            //}
        }

        $productoActualizado = $this->model->find($producto['ID']);
        return $this->successResponse('Producto actualizado correctamente.', $productoActualizado, 200);
    }
}
