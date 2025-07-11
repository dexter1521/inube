<?php

namespace App\Models;

use CodeIgniter\Model;

class MarcasModel extends Model
{
    protected $table      = 'marcas';
    protected $primaryKey = 'marca';

    protected $allowedFields = [
        'marca',
        'marca_descrip',
    ];

    protected $returnType    = 'array';
    protected $useTimestamps = false;

    protected $validationRules = [
        'marca'         => 'required|max_length[15]|is_unique[marcas.marca,marca,{marca}]',
        'marca_descrip' => 'permit_empty|max_length[50]',
    ];

    protected $validationMessages = [
        'marca' => [
            'required'  => 'El campo marca es obligatorio.',
            'is_unique' => 'La marca ya existe.',
        ],
        'marca_descrip' => [
            'max_length' => 'La descripción debe tener como máximo 50 caracteres.',
        ],
    ];
}
