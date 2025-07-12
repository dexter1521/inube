<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarCamposTokenActivoDispositivos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('dispositivos', [
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'unique' => true,
                'after' => 'tipoconcentrador',
            ],
            'activo' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'null' => false,
                'after' => 'token',
            ],
            'expiracion' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'activo',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('dispositivos', 'token');
        $this->forge->dropColumn('dispositivos', 'activo');
        $this->forge->dropColumn('dispositivos', 'expiracion');
    }
}
