<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTokenToDispositivos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('dispositivos', [
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'id', // Ajusta según el orden de tus columnas
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('dispositivos', 'token');
    }
}
