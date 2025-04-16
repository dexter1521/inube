<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreaTablaProductos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'clave' => ['type' => 'VARCHAR', 'constraint' => 255],
            'descripcion' => ['type' => 'VARCHAR', 'constraint' => 255],
            'costoultimo' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'precio' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'impuesto' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'SYS'],
            'linea' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'SYS'],
            'marca' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'SYS'],
            'fabricante' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'SYS'],
            'ubicacion' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'SYS'],
            'unidad' => ['type' => 'VARCHAR', 'constraint' => 255],
            'bloqueado' => ['type' => 'INT'],
            'existencia' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'precio2' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'precio3' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'precio4' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'precio5' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'precio6' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'precio7' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'precio8' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'precio9' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'precio10' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'u1' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'u2' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'u3' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'u4' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'u5' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'u6' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'u7' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'u8' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'u9' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'u10' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'claveprodserv' => ['type' => 'VARCHAR', 'constraint' => 255],
            'claveunidad' => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);
        $this->forge->addKey('ID', true); // Clave primaria y autoincrementable
        $this->forge->createTable('productos');

        // Índices
        $this->forge->addKey('clave');
        $this->forge->addKey('descripcion');
    }

    public function down()
    {
        $this->forge->dropTable('productos');
    }
}