<?php

namespace App\Controllers;

class Administrator extends MyAdministrator
{
    public function list_products()
    {
        $data = [
            'title' => 'Listado de Productos'
        ];
        return $this->renderTemplate('productos/index', $data);
    }

    public function create_product()
    {
        return $this->renderTemplate('productos/create');
    }

    public function edit($id)
    {
        $data = [
            'id' => $id,
            // otros datos específicos para la vista de edición
        ];
        return $this->renderTemplate('productos/edit', $data);
    }
}