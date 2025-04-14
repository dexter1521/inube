<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'email'];
    protected $validationRules = [
        'nombre' => 'required|min_length[3]',
        'email'  => 'required|valid_email',
    ];
}