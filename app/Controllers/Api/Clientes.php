<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Clientes extends ResourceController
{
    protected $modelName = 'App\Models\ClientesModel';
    protected $format    = 'json';

   
    public function index()
    {
        return $this->respond($this->model->findAll());
    }
    
    public function show($id = null)
    {
        $cliente = $this->model->find($id);
        if ($cliente) {
            return $this->respond($cliente);
        }
        return $this->failNotFound("Cliente con ID $id no encontrado.");
    }
    
    public function create()
    {
        $data = $this->request->getJSON(true);

        if ($this->model->insert($data)) {
            return $this->respondCreated(["message" => "Cliente creado correctamente"]);
        }
        return $this->fail("Error al crear cliente.");
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if ($this->model->update($id, $data)) {
            return $this->respond(["message" => "Cliente actualizado correctamente"]);
        }
        return $this->fail("Error al actualizar cliente.");
    }
    
    public function delete($id = null)
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted(["message" => "Cliente eliminado correctamente"]);
        }
        return $this->failNotFound("Cliente con ID $id no encontrado.");
    }
}
