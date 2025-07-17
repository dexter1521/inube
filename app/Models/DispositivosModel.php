<?php

namespace App\Models;

use CodeIgniter\Model;

class DispositivosModel extends Model
{
    protected $table = 'dispositivos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'dispositivo',
        'nombre',
        'almacen',
        'macaddress',
        'tipo',
        'tipoconcentrador',
        'zona',
        'ventas',
        'facturas',
        'pedidos',
        'productos',
        'masterproductos',
        'token',
        'activo',
        'expiracion'
    ];
    protected $useTimestamps = true;
    protected $returnType = 'array';
}
