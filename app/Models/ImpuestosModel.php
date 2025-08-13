<?php

namespace App\Models;

use CodeIgniter\Model;

class ImpuestosModel extends Model
{
    protected $table      = 'impuestos';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'rfc',
        'guid',
        'nombreImpuesto',
        'porcentajeImpuesto',
        'tipoImpuesto',
        'ambito',
        'sku'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    // Reglas de validación para evitar duplicados en nombreImpuesto
    protected $validationRules = [
        'nombreImpuesto' => 'required|is_unique[impuestos.nombreImpuesto,ID,{ID}]',
    ];

    public function update($id = null, $data = null): bool
    {
        // Si el nombre no cambia, elimina la regla is_unique para evitar falso positivo
        if ($id && isset($data['nombreImpuesto'])) {
            $actual = $this->find($id);
            if ($actual && $actual['nombreImpuesto'] === $data['nombreImpuesto']) {
                $this->validationRules['nombreImpuesto'] = 'required';
            } else {
                $this->validationRules['nombreImpuesto'] = 'required|is_unique[impuestos.nombreImpuesto,ID,' . $id . ']';
            }
        }
        return parent::update($id, $data);
    }
    protected $validationMessages = [
        'nombreImpuesto' => [
            'required' => 'El nombre del impuesto es obligatorio.',
            'is_unique' => 'Ya existe un impuesto con ese nombre.',
        ],
    ];
}
