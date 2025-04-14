<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class Prueba extends Controller
{
    public function index()
    {
        $db = Database::connect();
        $query = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='clientes'");
        $result = $query->getResultArray();

        return $this->response->setJSON($result);
    }
}
