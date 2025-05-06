<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMarcasTable extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id' => [
                    'type' => 'INT',
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'marca' => [
                    'type' => 'VARCHAR',
                    'constraint' => 15,
                    'null' => FALSE
                ],
                'descripcion' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                    'null' => TRUE
                ],
                'usuario' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => TRUE
                ],
                'usufecha' => [
                    'type' => 'INT',
                    'unsigned' => TRUE,
                    'null' => False
                ],
                'usuhora' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => False
                ]
            ]
        );
        $this->forge->addKey('marca', TRUE); // Crear índice en "linea"
        $this->forge->createTable('marcas', TRUE);
    }

    public function down()
    {
        //
    }
}
