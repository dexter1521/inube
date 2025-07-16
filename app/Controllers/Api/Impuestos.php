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
}
