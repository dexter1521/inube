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
            'precio' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'impuesto' => ['type' => 'VARCHAR', 'constraint' => 255],
            'unidad' => ['type' => 'VARCHAR', 'constraint' => 255],
            'tipoDeImpuesto' => ['type' => 'VARCHAR', 'constraint' => 255],
            'paraVentaEnPortal' => ['type' => 'VARCHAR', 'constraint' => 255],
            'html' => ['type' => 'TEXT'],
            'bloqueado' => ['type' => 'INT'],
            'ultimaModificacion' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'accesos' => ['type' => 'INT'],
            'iepslitro' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'retencioniva' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'retencionisr' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'retencionesLocales' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'nombreretencionesLocales' => ['type' => 'VARCHAR', 'constraint' => 255],
            'trasladosLocales' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'nombretrasladosLocales' => ['type' => 'VARCHAR', 'constraint' => 255],
            'ieps' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'iepscalculo' => ['type' => 'VARCHAR', 'constraint' => 255],
            'cuentapredial' => ['type' => 'VARCHAR', 'constraint' => 255],
            'linea' => ['type' => 'VARCHAR', 'constraint' => 255],
            'marca' => ['type' => 'VARCHAR', 'constraint' => 255],
            'fabricante' => ['type' => 'VARCHAR', 'constraint' => 255],
            'ubicacion' => ['type' => 'VARCHAR', 'constraint' => 255],
            'existencia' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'precio2' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'precio3' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'precio4' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'precio5' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'precio6' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'precio7' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'precio8' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'precio9' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'precio10' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'u1' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'u2' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'u3' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'u4' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'u5' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'u6' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'u7' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'u8' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'u9' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'u10' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'costoultimo' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'precioautomatico' => ['type' => 'INT'],
            'suscripcion' => ['type' => 'VARCHAR', 'constraint' => 255],
            'claveprodserv' => ['type' => 'VARCHAR', 'constraint' => 255],
            'claveunidad' => ['type' => 'VARCHAR', 'constraint' => 255],
            'tipofactor' => ['type' => 'VARCHAR', 'constraint' => 255],
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