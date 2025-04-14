<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientesModel extends Model
{
    protected $table      = 'clientes';
    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'clave', 'cliente', 'rfc', 'nombre', 'calle', 'colonia', 'localidad', 'municipio',
        'estado', 'pais', 'telefono', 'codigopostal', 'mail', 'mailcobranza',
        'numeroExterior', 'numeroInterior', 'accesos', 'ultimoAcceso', 'bloqueado',
        'diasdecredito', 'credito', 'usocfdi', 'saldo', 'asociacion', 'franquicia',
        'clavesucursal', 'nombresucursal', 'tiposucursal', 'esquina', 'entrecalle',
        'referencia', 'latitud', 'longitud', 'nombrecontacto', 'apellidopatcont',
        'apellidomatcont', 'cargocont', 'horariosuc', 'giro', 'cobrador', 'exportado',
        'descargado', 'actualizado'
    ];
}
