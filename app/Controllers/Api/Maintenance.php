<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Database\BaseConnection;

class Maintenance extends ResourceController
{
    use ResponseTrait;

    /**
     * Endpoint para limpiar la base de datos.
     * SOLO debe usarse en entornos controlados desde el panel web.
     */
    public function clean()
    {
        $db = \Config\Database::connect();
        $tables = [
            // Agrega aquí otras tablas que quieras limpiar
            'productos',
            'lineas',
            'marcas',
            'impuestos',
            'prods_download'
            
        ];
        foreach ($tables as $table) {
            $db->table($table)->truncate();
        }
        return $this->respond(['status' => 'ok', 'message' => 'Base de datos limpiada'], 200);
    }
}
