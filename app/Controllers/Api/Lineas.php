<?php

namespace App\Controllers\Api;

class Lineas extends BaseApiController
{
    protected $modelName = 'App\Models\LineasModel';
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

        $linea = $this->model->find($id);

        if (!$linea) {
            return $this->failNotFound("ID $id no encontrado.");
        }

        return $this->successResponse('encontrado.', $linea);
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
            return $this->errorResponse('Error al crear: ', $this->model->errors(), 422);
        }

        $data['id'] = $this->model->getInsertID();

        return $this->successResponse('creado correctamente.', $data, 201);
    }

    public function update($id = null)
    {
        //print_r($_REQUEST()); exit();
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->respond([
                'status' => false,
                'messages' => 'JSON no válido: ' . json_last_error_msg()
            ], 400);
        }

        if (!is_numeric($id)) {
            return $this->failValidationErrors('ID inválido');
        }

        if (!$data) {
            return $this->respond([
                'status' => false,
                'messages' => 'Datos JSON inválidos o vacíos'
            ], 400);
        }

        if (!$this->model->update($id, $data)) {
            return $this->respond([
                'status' => false,
                'messages' => 'Error de validación',
                'errors' => $this->model->errors()
            ], 422);
        }

        $data['id'] = (int) $id;

        return $this->respond([
            'status' => true,
            'messages' => 'Usuario actualizado correctamente.',
            'data' => $data
        ], 200);
    }


    public function delete($id = null)
    {
        if (!$id) {
            return $this->failValidationErrors('ID requerido');
        }

        $linea = $this->model->find($id);

        if (!$linea) {
            return $this->failNotFound(" ID $id no encontrado.");
        }

        $data = ['activo' => 0];

        if (!$this->model->update($id, $data)) {
            return $this->errorResponse('No se pudo desactivar el usuario.');
        }

        return $this->successResponse("ID $id desactivado correctamente.");
    }

    public function activate($id = null)
    {
        if (!$id) {
            return $this->failValidationErrors('ID requerido');
        }

        $linea = $this->model->find($id);

        if (!$linea) {
            return $this->failNotFound("ID $id no encontrado.");
        }

        $data = ['activo' => 1];

        if (!$this->model->update($id, $data)) {
            return $this->errorResponse('No se pudo activar.');
        }

        return $this->successResponse("ID $id activado correctamente.");
    }
}
