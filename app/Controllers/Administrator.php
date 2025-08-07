<?php

namespace App\Controllers;

class Administrator extends MyAdministrator
{
    public function db_explorer()
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        $selectedTable = $this->request->getGet('table');
        $structure = $rows = $queryResult = $error = null;
        $sql = $this->request->getPost('sql');

        if ($selectedTable) {
            $structure = $db->getFieldData($selectedTable);
            $rows = $db->table($selectedTable)->limit(20)->get()->getResultArray();
        }

        if ($sql) {
            if (stripos(trim($sql), 'select') === 0) {
                try {
                    $queryResult = $db->query($sql)->getResultArray();
                } catch (\Throwable $e) {
                    $error = $e->getMessage();
                }
            } else {
                $error = 'Solo se permiten consultas SELECT.';
            }
        }

        $data = [
            'title' => 'Admin DB Explorer',
            'tables' => $tables,
            'selectedTable' => $selectedTable,
            'structure' => $structure,
            'rows' => $rows,
            'sql' => $sql,
            'queryResult' => $queryResult,
            'error' => $error
        ];
        return $this->renderTemplate('configuracion/view_db_explorer', $data);
    }
    public function runMigrations()
    {
        // Puedes proteger esto con login o clave si lo deseas
        $migrate = \Config\Services::migrations();
        try {
            $migrate->latest();
            $data = [
                'title' => 'Migraciones',
                'message' => 'Migraciones ejecutadas correctamente.',
                'success' => true
            ];
        } catch (\Throwable $e) {
            $data = [
                'title' => 'Migraciones',
                'message' => 'Error: ' . $e->getMessage(),
                'success' => false
            ];
        }
        return $this->renderTemplate('configuracion/view_migrations', $data);
    }

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
