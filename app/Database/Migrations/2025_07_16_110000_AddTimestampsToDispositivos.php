<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTimestampsToDispositivos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('dispositivos', [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'expiracion',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'created_at',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('dispositivos', ['created_at', 'updated_at']);
    }
}
