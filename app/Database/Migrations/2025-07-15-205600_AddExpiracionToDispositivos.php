<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddExpiracionToDispositivos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('dispositivos', [
            'expiracion' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'activo', // Ajusta según el orden de tus columnas
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('dispositivos', 'expiracion');
    }
}
