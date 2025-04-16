<?php

namespace App\Traits;

use CodeIgniter\HTTP\Exceptions\HTTPException;

trait JsonRequestTrait
{
    /**
     * Decodifica el JSON del cuerpo de la petición.
     *
     * @param bool $assoc Si se debe devolver como arreglo asociativo.
     * @return array|null Devuelve el array de datos o null si está vacío.
     */
    public function getJsonRequest(bool $assoc = true)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, $assoc);

        if (json_last_error() !== JSON_ERROR_NONE) {
            // Usa failValidationErrors si está disponible en el controlador
            if (method_exists($this, 'failValidationErrors')) {
                return $this->failValidationErrors('JSON inválido: ' . json_last_error_msg());
            }

            // Fallback si se usa en otro contexto
            return [
                'status' => 400,
                'error' => 'JSON inválido: ' . json_last_error_msg()
            ];
        }

        return $data;
    }
}
