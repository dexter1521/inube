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

        return $this->successResponse('Producto creado correctamente.', $data, 201);
    }

    public function show($id = null)
    {
        if (!$id) {
            return $this->failValidationErrors('ID requerido');
        }

        $usuario = $this->model->find($id);

        if (!$usuario) {
            return $this->failNotFound("Producto con clave $id no encontrado.");
        }

        return $this->successResponse('Producto encontrado.', $usuario);
    }

    public function update($id = null)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->invalidJsonResponse();
        }

        if (!is_array($data) || empty($data)) {
            return $this->failValidationErrors('Datos inválidos o vacíos.');
        }

        if (!is_numeric($id)) {
            return $this->failValidationErrors('ID inválido');
        }

        if (!$data) {
            return $this->emptyJsonResponse();
        }

        $this->model->setValidationRules([
            'clave' => "required|max_length[50]|is_unique[productos.clave,ID,{$id}]",
        ]);

        if (!$this->model->update($id, $data)) {
            return $this->errorResponse('Error al actualizar el producto', $this->model->errors(), 422);
        }

        $data['id'] = (int) $id;

        return $this->successResponse('Producto actualizado correctamente.', $data, 201);
    }
}
