<?php

namespace App\Controllers\Api;

use App\Models\ImpuestosModel;

class Impuestos extends BaseApiController
{
    protected $modelName = 'App\Models\ImpuestosModel';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        if (!$id) {
            return $this->failValidationErrors('ID requerido');
        }
        $impuesto = $this->model->find($id);
        if (!$impuesto) {
            return $this->failNotFound("Impuesto con ID $id no encontrado.");
        }
        return $this->respond($impuesto);
    }

    // Crear un nuevo impuesto
    public function create()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if (!$data) {
            return $this->emptyJsonResponse();
        }
        if (!$this->model->insert($data)) {
            return $this->errorResponse('Error al crear el impuesto', $this->model->errors(), 422);
        }
        $id = $this->model->getInsertID();
        $impuesto = $this->model->find($id);
        return $this->successResponse('Impuesto creado correctamente', $impuesto, 201);
    }

    // Actualizar un impuesto existente
    public function update($id = null)
    {
        if (!$id) {
            return $this->failValidationErrors('ID requerido');
        }
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->fail('JSON no válido: ' . json_last_error_msg(), 400);
        }
        if (!$data) {
            return $this->emptyJsonResponse();
        }
        if (!$this->model->update($id, $data)) {
            return $this->errorResponse('Error al actualizar el impuesto', $this->model->errors(), 422);
        }
        $impuesto = $this->model->find($id);
        return $this->successResponse('Impuesto actualizado correctamente', $impuesto);
    }

    // Eliminar un impuesto
    public function delete($id = null)
    {
        if (!$id) {
            return $this->failValidationErrors('ID requerido');
        }
        $impuesto = $this->model->find($id);
        if (!$impuesto) {
            return $this->failNotFound("Impuesto con ID $id no encontrado.");
        }
        // Validar si hay productos asociados a este impuesto
        $productosModel = model('App\Models\ProductosModel');
        $asociados = $productosModel->where('impuesto', $impuesto['nombreImpuesto'])->countAllResults();
        if ($asociados > 0) {
            return $this->errorResponse('No se puede eliminar el impuesto porque está asociado a uno o más productos.', [], 422);
        }
        if (!$this->model->delete($id)) {
            return $this->errorResponse('Error al eliminar el impuesto', $this->model->errors(), 422);
        }
        return $this->successResponse('Impuesto eliminado correctamente');
    }
}
