<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id', 'username', 'password', 'perfil'
    ];
    protected $returnType = 'array';
}

