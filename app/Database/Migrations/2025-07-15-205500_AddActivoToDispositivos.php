<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddActivoToDispositivos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('dispositivos', [
            'activo' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'null' => false,
                'after' => 'token', // Ajusta según el orden de tus columnas
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('dispositivos', 'activo');
    }
}
