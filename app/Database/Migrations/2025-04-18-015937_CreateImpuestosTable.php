<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateImpuestosTable extends Migration
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
                'impuesto' => [
                    'type' => 'VARCHAR',
                    'constraint' => 10,
                    'null' => FALSE
                ],
                'descripcion' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                    'null' => TRUE
                ],
                'valor' => [
                    'type' => 'DECIMAL',
                    'constraint' => 10,2,
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
        $this->forge->addKey('linea', TRUE); // Crear índice en "linea"
        $this->forge->createTable('lineas', TRUE);
    }

    public function down()
    {
        //
    }
}
