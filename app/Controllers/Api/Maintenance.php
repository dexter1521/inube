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
     * Endpoint para optimizar la base de datos con VACUUM (SQLite).
     * SOLO debe usarse en entornos controlados desde el panel web.
     */
    private function __vacuum()
    {
        $db = \Config\Database::connect();
        if ($db->DBDriver === 'SQLite3') {
            $db->query('VACUUM');
            return $this->respond(['status' => 'ok', 'message' => 'VACUUM ejecutado correctamente'], 200);
        } else {
            return $this->respond(['status' => 'error', 'message' => 'VACUUM solo disponible para SQLite'], 400);
        }
    }

    /**
     * Endpoint público para ejecutar ANALYZE (SQLite).
     * SOLO debe usarse en entornos controlados desde el panel web.
     */
    public function analyze()
    {
        $db = \Config\Database::connect();
        if ($db->DBDriver === 'SQLite3') {
            $db->query('ANALYZE');
            return $this->respond(['status' => 'ok', 'message' => 'ANALYZE ejecutado correctamente'], 200);
        } else {
            return $this->respond(['status' => 'error', 'message' => 'ANALYZE solo disponible para SQLite'], 400);
        }
    }

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
            // Reinicia el índice autoincrement si es SQLite
            if ($db->DBDriver === 'SQLite3') {
                $db->query("DELETE FROM sqlite_sequence WHERE name='" . $table . "';");
            }
        }
        $this->__vacuum(); // Ejecuta VACUUM después de limpiar
        return $this->respond(['status' => 'ok', 'message' => 'Base de datos limpiada y autoincrement reiniciado'], 200);
    }
}
