<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $beforeUpdate = ['beforeUpdate'];
    protected $forceCheckboxFields = [
        'paraventa',
        'invent',
        'bloqueado',
        'granel',
        'speso',
        'bajocosto'
    ];

    protected function beforeUpdate(array $data)
    {
        // Forzar que los campos tipo checkbox se actualicen aunque sean 0
        if (isset($data['data'])) {
            foreach ($this->forceCheckboxFields as $field) {
                // Si el campo existe y su valor es '1', guardar como 1
                if (array_key_exists($field, $data['data'])) {
                    $data['data'][$field] = (intval($data['data'][$field]) ? 1 : 0);
                } else {
                    // Si no existe, guardar como 0
                    $data['data'][$field] = 0;
                }
            }
        }
        // ...
        // Log adicional para ver el array final de datos antes del update
        if (isset($data['data'])) {
            log_message('debug', 'Array final enviado a update: ' . json_encode($data['data']));
        }
        return $data;
    }
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
        'paraventa',
        'invent',
        'granel',
        'speso',
        'bajocosto',
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
        'c1',
        'c2',
        'c3',
        'c4',
        'c5',
        'c6',
        'c7',
        'c8',
        'c9',
        'c10',
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
