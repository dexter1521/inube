<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CambiarProdsDownloadADispositivoString extends Migration
{
    public function up()
    {
        // Eliminar tabla si existe (para desarrollo, en producción usar alter table)
        $this->forge->dropTable('prods_download', true);

        $this->forge->addField([
            'id' => [
                'type' => 'INTEGER',
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'clave' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'dispositivo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'aplicado' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => false,
            ],
            'fecha_registro' => [
                'type' => 'DATETIME',
                'null' => false,
                'default' => 'CURRENT_TIMESTAMP',
            ],
            'fecha_aplicado' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['clave', 'dispositivo']);
        $this->forge->createTable('prods_download');
    }

    public function down()
    {
        $this->forge->dropTable('prods_download');
    }
}
