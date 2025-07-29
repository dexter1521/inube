<?php
namespace App\Controllers\Api;

use App\Models\ProdsDownloadModel;
use CodeIgniter\RESTful\ResourceController;

class ProdsDownload extends ResourceController
{
    protected $modelName = ProdsDownloadModel::class;
    protected $format = 'json';

    // Obtener productos pendientes para un dispositivo (por nombre)
    public function pendientes($dispositivo = null)
    {
        if (!$dispositivo) {
            return $this->failValidationError('Nombre de dispositivo requerido');
        }
        $pendientes = $this->model
            ->where('dispositivo', $dispositivo)
            ->where('aplicado', 0)
            ->findAll();
        return $this->respond($pendientes);
    }

    // Marcar como aplicado
    public function aplicar()
    {
        $json = $this->request->getJSON();
        if (!$json || !isset($json->id)) {
            return $this->failValidationError('ID de registro requerido');
        }
        $update = [
            'aplicado' => 1,
            'fecha_aplicado' => date('Y-m-d H:i:s')
        ];
        $this->model->update($json->id, $update);
        return $this->respond(['status' => true, 'id' => $json->id]);
    }
}
