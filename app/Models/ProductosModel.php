<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $table      = 'productos';
    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'clave',
        'descripcion',
        'precio',
        'linea',
        'marca',
        'fabricante',
        'ubicacion',
        'unidad',
        'bloqueado',
        'impuesto',
        'existencia',
        'precio2',
        'precio3',
        'precio4',
        'precio5',
        'precio6',
        'precio7',
        'precio8',
        'precio9',
        'precio10',
        'u1',
        'u2',
        'u3',
        'u4',
        'u5',
        'u6',
        'u7',
        'u8',
        'u9',
        'u10',
        'c1', 'c2', 'c3', 'c4', 'c5', 'c6', 'c7', 'c8', 'c9', 'c10',
        'costoultimo',
        'claveprodserv',
        'claveunidad'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $returnType = 'array';

    protected $validationRules = [
        'clave' => 'required|max_length[50]|is_unique[productos.clave,ID,{ID}]',
        'descripcion' => 'permit_empty',
        'costoultimo' => 'required|decimal',
        'precio' => 'required|decimal',
        'linea' => 'permit_empty',
        'unidad' => 'permit_empty',
        'bloqueado' => 'permit_empty|in_list[0,1]'
    ];

    protected $validationMessages = [
        'clave' => [
            'required' => 'El campo clave es obligatorio.',
            'is_unique' => 'La clave ya existe.'
        ],
        'descripcion' => [
            'required' => 'El campo descripcion es obligatorio.'
        ],
        'precio' => [
            'required' => 'El campo precio es obligatorio.',
            'decimal' => 'El campo precio debe ser un número decimal.'
        ]
    ];
}
