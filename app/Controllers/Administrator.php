<?php

namespace App\Controllers;

class Administrator extends MyAdministrator
{

    public function index()
    {
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
            'title' => 'Editar Producto'
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

    public function list_dispositivos()
    {
        $data = ['title' => 'Dispositivos'];
        return $this->renderTemplate('dispositivos/index', $data);
    }

    public function crear_dispositivos()
    {
        $data = ['title' => 'Crear Dispositivo'];
        return $this->renderTemplate('dispositivos/add', $data);
    }

    public function editar_dispositivos($id)
    {
        $data = [
            'id' => $id,
            'title' => 'Editar Dispositivo'
        ];
        return $this->renderTemplate('dispositivos/edit', $data);
    }

    public function sucTareas()
    {
        $dispositivoModel = model('App\Models\DispositivosModel');
        $dispositivos = $dispositivoModel->where('activo', 1)->findAll();
        $data = [
            'title' => 'Tareas de Sincronización',
            'dispositivos' => $dispositivos
        ];
        return $this->renderTemplate('dispositivos/sucTareas', $data);
    }

    public function clean_db()
    {
        $data = [
            'title' => 'Limpieza de Base de Datos'
        ];
        return $this->renderTemplate('configuracion/view_clean_db', $data);
    }
}
