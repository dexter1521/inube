<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class BaseApiController extends ResourceController
{
    protected function successResponse($message, $data = [], $code = 200)
    {
        return $this->respond([
            'status'  => true,
            'messages' => $message,
            'data'    => $data
        ], $code);
    }

    protected function errorResponse($message, $errors = [], $code = 400)
    {
        return $this->respond([
            'status'  => false,
            'messages' => $message,
            'errors'  => $errors
        ], $code);
    }

    protected function invalidJsonResponse()
    {
        return $this->errorResponse('JSON no válido: ' . json_last_error_msg(), [], 400);
    }

    protected function emptyJsonResponse()
    {
        return $this->errorResponse('Datos JSON inválidos o vacíos', [], 400);
    }
}
