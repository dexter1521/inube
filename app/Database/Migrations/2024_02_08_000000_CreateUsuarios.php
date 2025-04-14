<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsuarios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'       => ['type' => 'INTEGER', 'auto_increment' => true],
            'nombre'   => ['type' => 'TEXT', 'null' => false],
            'email'    => ['type' => 'TEXT', 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('usuarios');
    }

    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}
