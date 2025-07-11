<?php

namespace App\Controllers\Api;

class Marcas extends BaseApiController
{
    protected $modelName = 'App\Models\MarcasModel';
    protected $format    = 'json';

    // Implementa los métodos necesarios para el controlador de recursos
    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        if (!$id) {
            return $this->failValidationErrors('ID requerido');
        }

        $marca = $this->model->find($id);

        if (!$marca) {
            return $this->failNotFound("Marca con ID $id no encontrada.");
        }

        return $this->respond($marca);
    }

    public function create()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->fail('JSON no válido: ' . json_last_error_msg(), 400);
        }

        if (!$data) {
            return $this->fail('Datos vacíos', 400);
        }

        // Agregar usufecha y usuhora si no vienen
        if (!isset($data['usufecha'])) {
            $data['usufecha'] = time();
        }
        if (!isset($data['usuhora'])) {
            $data['usuhora'] = date('H:i:s');
        }

        if (!$this->model->insert($data)) {
            return $this->fail($this->model->errors(), 422);
        }

        $data['id'] = $this->model->getInsertID();

        return $this->respondCreated($data);
    }

    public function update($id = null)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->fail('JSON no válido: ' . json_last_error_msg(), 400);
        }



        if (!$data) {
            return $this->fail('Datos vacíos', 400);
        }

        // Agregar usufecha y usuhora si no vienen
        if (!isset($data['usufecha'])) {
            $data['usufecha'] = time();
        }
        if (!isset($data['usuhora'])) {
            $data['usuhora'] = date('H:i:s');
        }

        if (!$this->model->update($id, $data)) {
            return $this->fail($this->model->errors(), 422);
        }

        $data['id'] = $id;

        return $this->respond($data);
    }


    public function delete($id = null)
    {
        if (!$id) {
            return $this->failValidationErrors('ID requerido');
        }

        $marca = $this->model->find($id);

        if (!$marca) {
            return $this->failNotFound("Marca con ID $id no encontrada.");
        }

        if (!$this->model->delete($id)) {
            return $this->fail('No se pudo eliminar la marca.');
        }

        return $this->respondDeleted(["id" => $id]);
    }

    // No se implementa activate porque la tabla no tiene campo 'activo'.
}
