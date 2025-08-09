<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'email', 'activo', 'is_admin', 'password', 'perfil'];
    protected $validationRules = [
        'id' => 'permit_empty|integer',
        'nombre' => 'required|min_length[3]',
        // Permite el mismo email del usuario al actualizar
        'email'  => 'required|valid_email|is_unique[usuarios.email,id,{id}]',
        'activo' => 'in_list[0,1]',
        'is_admin' => 'in_list[0,1]',
    ];
    protected $returnType = 'array';
}