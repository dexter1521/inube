<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Usuarios extends ResourceController
{
    protected $modelName = 'App\Models\UsuariosModel';
    protected $format    = 'json';

    // Implementa los métodos necesarios para el controlador de recursos
    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $this->respond($data);
        }
        return $this->failNotFound('Usuario no encontrado');
    }

    public function create()
    {
        //sigo sin entender xq esto no funciona tal vez sea la version de php
        //$input = $this->request->getPost();
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if (!$data) {
            return $this->failValidationErrors('JSON no válido');
        }
        
         if (!$this->model->insert($data)) {
            log_message('error', 'Error en inserción: ' . json_encode($this->model->errors()));
            return $this->fail($this->model->errors());
        }

        return $this->respondCreated($data);
    }

    public function update($id = null)
    {
        $input = $this->request->getRawInput();
        if ($this->model->update($id, $input)) {
            return $this->respond($input);
        }
        return $this->failValidationErrors($this->model->errors());
    }

    public function delete($id = null)
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted(['id' => $id]);
        }
        return $this->failNotFound('Usuario no encontrado');
    }
}
