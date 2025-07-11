<?php

namespace App\Models;

use CodeIgniter\Model;

class LineasModel extends Model
{
    protected $table      = 'lineas';
    protected $primaryKey = 'linea';

    protected $allowedFields = [
        'linea',
        'descripcion',
        'usuario',
        'usufecha',
        'usuhora',
        'numero',
    ];

    protected $returnType     = 'array';
    protected $useTimestamps  = false;
}
