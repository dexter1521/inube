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
        $data = $this->request->getJSON(true);
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
}
