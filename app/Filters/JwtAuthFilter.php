<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeaderLine('Authorization');
        if (!$authHeader || !preg_match('/Bearer\s(.*)/', $authHeader, $matches)) {
            return service('response')->setJSON([
                'status' => 401,
                'error' => 'Token no proporcionado'
            ])->setStatusCode(401);
        }
        $token = $matches[1];

        // Validar token estático en la tabla dispositivos
        $db = \Config\Database::connect();
        $builder = $db->table('dispositivos');
        $builder->where('token', $token);
        $builder->where('activo', 1);
        $builder->groupStart()
            ->where('expiracion IS NULL')
            ->orWhere('expiracion >', date('Y-m-d H:i:s'))
        ->groupEnd();
        $dispositivo = $builder->get()->getRowArray();
        if ($dispositivo) {
            // Token estático válido, permitir acceso
            $request->dispositivo = $dispositivo;
            return;
        }

        // Si no es token estático, validar como JWT
        $key = getenv('JWT_SECRET') ?: 'supersecretkey';
        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $request->user = $decoded;
        } catch (\Exception $e) {
            return service('response')->setJSON([
                'status' => 401,
                'error' => 'Token inválido o expirado',
                'message' => $e->getMessage()
            ])->setStatusCode(401);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se requiere lógica post-respuesta
    }
}
