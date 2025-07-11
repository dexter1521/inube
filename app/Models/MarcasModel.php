<?php

namespace App\Models;

use CodeIgniter\Model;

class MarcasModel extends Model
{
    protected $table      = 'marcas';
    protected $primaryKey = 'marca';

    protected $allowedFields = [
        'marca',
        'descripcion',
        'usufecha',
        'usuhora',
    ];

    protected $returnType    = 'array';
    protected $useTimestamps = false;


    protected $validationRules = [
        'marca'       => 'required|max_length[15]',
        'descripcion' => 'permit_empty|max_length[50]',
    ];

    public function insert($data = null, bool $returnID = true)
    {
        // Validar unicidad solo al crear
        $this->validationRules['marca'] = 'required|max_length[15]|is_unique[marcas.marca]';
        return parent::insert($data, $returnID);
    }

    public function update($id = null, $data = null): bool
    {
        // No aplicar is_unique al actualizar
        $this->validationRules['marca'] = 'required|max_length[15]';
        return parent::update($id, $data);
    }

    protected $validationMessages = [
        'marca' => [
            'required'  => 'El campo marca es obligatorio.',
            'is_unique' => 'La marca ya existe.',
        ],
        'descripcion' => [
            'max_length' => 'La descripción debe tener como máximo 50 caracteres.',
        ],
    ];
}
