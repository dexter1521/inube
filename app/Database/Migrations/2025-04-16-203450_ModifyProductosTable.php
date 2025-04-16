<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyProductosTable extends Migration
{
    public function up()
    {
        $fields = [
            'c2' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'c3' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'c4' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'c5' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'c6' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'c7' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'c8' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'c9' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'c10' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'paraventa' => ['type' => 'INT', 'default' => '1'], // producto de venta
            'invent' => ['type' => 'INT', 'default' => '1'], // control de inventario
            'granel' => ['type' => 'INT', 'default' => '0'], // venta a granel
            'bajocosto' => ['type' => 'INT', 'default' => '0'], // venta a bajo costo
            'speso' => ['type' => 'INT', 'default' => '0'], // solicitar peso
            'created_at' => ['type' => 'DATETIME', 'null' => true], // Cambiado a DATETIME
            'updated_at' => ['type' => 'DATETIME', 'null' => true], // Cambiado a DATETIME
        ];

        if ($this->db->tableExists('productos')) {
            $this->forge->addColumn('productos', $fields);
        }
    }

    public function down()
    {
        if ($this->db->tableExists('productos')) {
            $this->forge->dropColumn('productos', [
                'tipoDeImpuesto', 'paraVentaEnPortal', 'html', 'ultimaModificacion',
                'accesos', 'iepslitro', 'retencioniva', 'retencionisr',
                'retencionesLocales', 'nombreretencionesLocales', 'trasladosLocales',
                'nombretrasladosLocales', 'ieps', 'iepscalculo', 'cuentapredial',
                'precioautomatico', 'suscripcion', 'tipofactor',
            ]);
        }
    }
}