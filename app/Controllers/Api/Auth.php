<?php

namespace App\Controllers\Api;

use App\Models\AuthModel;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth extends ResourceController
{
    protected $format = 'json';

    public function login()
    {
        $json = $this->request->getJSON();
        $email = $json->email ?? $json->username ?? null;
        $password = $json->password ?? null;

        if (!$email || !$password) {
            return $this->fail('Email y contraseña requeridos', 400);
        }

        $model = new AuthModel();
        $user = $model->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return $this->fail('Credenciales inválidas', 401);
        }

        $key = getenv('JWT_SECRET') ?: 'supersecretkey';
        $iat = time();
        $exp = $iat + 3600; // 1 hora
        $payload = [
            'iat' => $iat,
            'exp' => $exp,
            'uid' => $user['id'],
            'email' => $user['email'],
            'perfil' => $user['perfil'] ?? null
        ];
        $token = JWT::encode($payload, $key, 'HS256');

        return $this->respond([
            'token' => $token,
            'user' => [
                'id' => $user['id'],
                'email' => $user['email'],
                'perfil' => $user['perfil'] ?? null
            ]
        ]);
    }
}
