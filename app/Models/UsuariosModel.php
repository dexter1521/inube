<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'email', 'activo', 'is_admin', 'password', 'perfil'];
    protected $validationRules = [
        'nombre' => 'required|min_length[3]',
        'email'  => 'required|valid_email',
        'activo' => 'in_list[0,1]',
        'is_admin' => 'in_list[0,1]',

    ];
    protected $returnType = 'array';
}