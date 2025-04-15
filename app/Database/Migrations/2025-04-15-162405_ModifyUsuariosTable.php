<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyUsuariosTable extends Migration
{
    public function up()
    {
        // Agregar una nueva columna 'telefono' a la tabla 'usuarios'
        $this->forge->addColumn('usuarios', [
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
                'null' => true, // Permitir valores nulos
                'after' => 'email', // Opcional: especificar la posición de la columna
            ],
        ]);

        $this->forge->addColumn('usuarios', [
            'perfil' => [
                'type' => 'INT',
                'null' => true, // Permitir valores nulos
                'after' => 'password', // Opcional: especificar la posición de la columna
            ],
        ]);

        $this->forge->addColumn('usuarios', [
            'is_admin' => [
                'type' => 'INT',
                'null' => true, // Permitir valores nulos
            ],
        ]);

        $this->forge->addColumn('usuarios', [
            'activo' => [
            'type' => 'TINYINT',
            'constraint' => 1,
            'null' => false,
            'default' => 1, // Valor predeterminado
            'comment' => 'Activo:1',
            ],
        ]);
    }

    public function down()
    {
       // Eliminar la columna 'telefono' si se revierte la migración
       $this->forge->dropColumn('usuarios', 'telefono');
    }
}
