<?php

namespace App\Models;

use CodeIgniter\Model;

class LineasModel extends Model
{
    protected $table      = 'lineas';
    protected $primaryKey = 'id';

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

    protected $validationRules = [
        'linea' => 'required|is_unique[lineas.linea,id,{id}]',
        'descripcion' => 'permit_empty',
    ];

    protected $validationMessages = [
        'linea' => [
            'required' => 'El campo línea es obligatorio.',
            'is_unique' => 'Ya existe una línea con ese nombre.'
        ]
    ];
}
