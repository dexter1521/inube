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
        'precio2', 'precio3', 'precio4', 'precio5', 'precio6', 'precio7', 'precio8', 'precio9', 'precio10',
        'u1', 'u2', 'u3', 'u4', 'u5', 'u6', 'u7', 'u8', 'u9', 'u10',
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
        'clave' => 'required|max_length[50]|is_unique[productos.clave,clave,{ID}]', // Esto se realiza para poder validar el update
        'descripcion' => 'required|trim|max_length[255]',
        'costoultimo' => 'required|decimal',
        'precio' => 'required|decimal',
        'linea' => 'required',
        'unidad' => 'required',
        //'marca' => 'required',
        'impuesto' => 'required',
        'c2' => 'required',
        'precio2' => 'required|decimal',
        'c3' => 'required',
        'precio3' => 'required|decimal',
        'paraventa' => 'required',
        'invent' => 'required',
        

        /*
        
        'bloqueado' => 'required',
        'granel' => 'required',
        'speso' => 'required',
        'precio4' => 'required|decimal',
        'precio5' => 'required|decimal',
        'precio6' => 'required|decimal',
        'precio7' => 'required|decimal',
        'precio8' => 'required|decimal',
        'precio9' => 'required|decimal',
        'precio10' => 'required|decimal',
        'c4' => 'required',
        'c5' => 'required',
        'c6' => 'required',
        'c7' => 'required',
        'c8' => 'required',
        'c9' => 'required',
        'c10' => 'required',
        
        
        */
    ];

    protected $validationMessages = [
        'clave' => [
            'required' => 'El campo articulo es obligatorio.',
            'is_unique' => 'La clave ya existe.'
        ],
        'descripcion' => [
            'required' => 'El campo descripción es obligatorio.'
        ],
        'precio' => [
            'required' => 'El precio es obligatorio.',
            'decimal' => 'El precio debe ser un número decimal.'
        ]
    ];
}
