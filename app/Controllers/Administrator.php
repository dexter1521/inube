<?php

namespace App\Controllers;

class Administrator extends MyAdministrator
{
    public function index()
    {
        error_log('ENTRANDO A ADMINISTRATOR::INDEX');
        $data = [
            'title' => 'Dashboard',
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

    public function list_category()
    {
        $data = ['title' => 'Líneas'];
        return $this->renderTemplate('lineas/index', $data);
    }

    public function list_brands()
    {
        $data = ['title' => 'Marcas'];
        return $this->renderTemplate('marcas/index', $data);
    }
}
