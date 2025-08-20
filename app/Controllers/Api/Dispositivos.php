<?php

namespace App\Controllers\Api;

use App\Models\DispositivosModel;
use CodeIgniter\RESTful\ResourceController;

class Dispositivos extends ResourceController
{
    protected $modelName = 'App\Models\DispositivosModel';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $dispositivo = $this->model->find($id);
        if (!$dispositivo) {
            return $this->failNotFound('Dispositivo no encontrado.');
        }
        return $this->respond($dispositivo);
    }

    public function create()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        // Si 'dispositivo' no está presente, usar el valor de 'nombre'
        if (empty($data['dispositivo']) && !empty($data['nombre'])) {
            $data['dispositivo'] = $data['nombre'];
        }
        // Validar que solo exista un masterproductos=1
        if (isset($data['masterproductos']) && intval($data['masterproductos']) === 1) {
            $existe = $this->model->where('masterproductos', 1)->first();
            if ($existe) {
                return $this->failValidationErrors(['masterproductos' => 'Ya existe un dispositivo con masterproductos activo.']);
            }
        }
        if (!$this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }
        $data['id'] = $this->model->getInsertID();
        return $this->respondCreated($data);
    }

    public function update($id = null)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        // Si 'dispositivo' no está presente, usar el valor de 'nombre'
        if (empty($data['dispositivo']) && !empty($data['nombre'])) {
            $data['dispositivo'] = $data['nombre'];
        }
        // Validar que solo exista un masterproductos=1
        if (isset($data['masterproductos']) && intval($data['masterproductos']) === 1) {
            $existe = $this->model->where('masterproductos', 1)->where('id !=', $id)->first();
            if ($existe) {
                return $this->failValidationErrors(['masterproductos' => 'Ya existe un dispositivo con masterproductos activo.']);
            }
        }
        if (!$this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }
        return $this->respond($this->model->find($id));
    }

    public function delete($id = null)
    {
        if (!$this->model->delete($id)) {
            return $this->failNotFound('No se pudo eliminar el dispositivo.');
        }
        return $this->respondDeleted(['id' => $id]);
    }

    /**
     * Devuelve los permisos de acceso del dispositivo autenticado
     */
    public function access()
    {
        $dispositivo = $this->request->dispositivo ?? null;
        if (!$dispositivo) {
            return $this->failUnauthorized('No autenticado como dispositivo');
        }
        $accesos = [
            'ventas' => $dispositivo['ventas'] ?? 0,
            'facturas' => $dispositivo['facturas'] ?? 0,
            'pedidos' => $dispositivo['pedidos'] ?? 0,
            'productos' => $dispositivo['productos'] ?? 0,
            'masterproductos' => $dispositivo['masterproductos'] ?? 0,
        ];
        return $this->respond(['accesos' => $accesos, 'dispositivo' => $dispositivo]);
    }
}
