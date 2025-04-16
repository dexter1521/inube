<?php

namespace App\Controllers;

class Administrator extends MyAdministrator
{
    public function index()
    {
        $data = [
            'title' => 'Administración',
            'subtitle' => 'Bienvenido al panel de administración'
        ];
        return $this->renderTemplate('view_dashboard', $data);
    }

    public function list_products()
    {
        $data = [
            'title' => 'Listado de Productos'
        ];
        return $this->renderTemplate('productos/index', $data);
    }

    public function create_product()
    {
        $data = [
            'title' => 'Crear Producto'
        ];
        return $this->renderTemplate('productos/add', $data);
    }

    public function edit($id)
    {
        $data = [
            'id' => $id,
            // otros datos específicos para la vista de edición
        ];
        return $this->renderTemplate('productos/edit', $data);
    }

    public function list_users()
    {
        $data = [
            'title' => 'Usuarios'
        ];
        return $this->renderTemplate('usuarios/index', $data);
    }
}