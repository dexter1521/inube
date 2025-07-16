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
}
