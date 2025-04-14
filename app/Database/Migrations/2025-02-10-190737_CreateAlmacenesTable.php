<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migration_Create_Almacenes extends Migration
{

    public function up()
    {
        // Crear la tabla almacenes
        $this->forge->addField([
            'almacen' => [
                'type' => 'INT',
                'null' => FALSE
            ],
            'descripcion' => [
                'type' => 'TEXT',
                'null' => TRUE
            ]
        ]);
        $this->forge->addKey('almacen', TRUE); // Crear índice en "almacen"
        $this->forge->createTable('almacenes', TRUE);

        // Crear el índice almacenes_almacen
        //$this->db->query('CREATE INDEX IF NOT EXISTS almacenes_almacen ON almacenes (almacen)');

        echo "Tabla 'almacenes' creada correctamente.\n";
    }

    public function down()
    {
        // Eliminar la tabla si es necesario
        $this->forge->dropTable('almacenes', TRUE);
        echo "Tabla 'almacenes' eliminada correctamente.\n";
    }
}
