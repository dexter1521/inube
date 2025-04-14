<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreaTablaDispositivos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'unsigned' => true, 'auto_increment' => true],
            'dispositivo' => ['type' => 'VARCHAR', 'constraint' => 255],
            'nombre' => ['type' => 'VARCHAR', 'constraint' => 255],
            'almacen' => ['type' => 'INTEGER'],
            'macaddress' => ['type' => 'VARCHAR', 'constraint' => 255],
            'tipo' => ['type' => 'VARCHAR', 'constraint' => 255],
            'tipoconcentrador' => ['type' => 'VARCHAR', 'constraint' => 255],
            'zona' => ['type' => 'VARCHAR', 'constraint' => 255],
            'ventas' => ['type' => 'INTEGER'],
            'facturas' => ['type' => 'INTEGER'],
            'pedidos' => ['type' => 'INTEGER'],
            'productos' => ['type' => 'INTEGER'],
            'masterproductos' => ['type' => 'INTEGER'],
        ]);
        $this->forge->addPrimaryKey('id'); // 'id' es la clave primaria
        $this->forge->addUniqueKey('dispositivo'); // 'dispositivo' es único
        $this->forge->createTable('dispositivos');
    }

    public function down()
    {
        $this->forge->dropTable('dispositivos');
    }
}
