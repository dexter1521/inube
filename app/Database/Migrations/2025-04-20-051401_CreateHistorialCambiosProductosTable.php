<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHistorialCambiosProductosTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'clave' => ['type' => 'VARCHAR', 'constraint' => 255],
            'id_dispositivo ' => ['type' => 'INT', 'unsigned' => true,], // ID del dispositivo, que el dispositivo lo tomamos como una sucursal
            'created_at' => ['type' => 'DATETIME'],
            'usuario' => ['type' => 'VARCHAR', 'constraint' => 255],
            'exportado' => ['type' => 'TINYINT', 'default' => '0'],
        ]);
        
        $this->forge->addKey('id', true); // Clave primaria y autoincrementable
        $this->forge->addKey('clave'); // Índice para búsquedas
        //$this->forge->addForeignKey('id_dispositivo', 'dispositivos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('historial_cambios_productos');
    }

    public function down()
    {
        $this->forge->dropTable('historial_cambios_productos');
    }
}
