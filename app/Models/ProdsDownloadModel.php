<?php
namespace App\Models;

use CodeIgniter\Model;

class ProdsDownloadModel extends Model
{
    protected $table = 'prods_download';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'clave',
        'dispositivo',
        'aplicado',
        'fecha_registro',
        'fecha_aplicado'
    ];
    protected $useTimestamps = false;
}
