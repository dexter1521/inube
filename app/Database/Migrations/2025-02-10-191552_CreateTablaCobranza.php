<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablaCobranza extends Migration
{
    public function up()
    {
        // Tabla cobdetAcumulada
        $this->forge->addField([
            'rfc' => ['type' => 'VARCHAR', 'constraint' => 255],
            'guid' => ['type' => 'VARCHAR', 'constraint' => 255],
            'puid' => ['type' => 'VARCHAR', 'constraint' => 255],
            'cliente' => ['type' => 'VARCHAR', 'constraint' => 255],
            'fecha' => ['type' => 'INT', 'unsigned' => true], // Asumo que es un timestamp
            'seriedocumento' => ['type' => 'VARCHAR', 'constraint' => 255],
            'tipo_doc' => ['type' => 'VARCHAR', 'constraint' => 255],
            'no_referen' => ['type' => 'VARCHAR', 'constraint' => 255],
            'cargo_ab' => ['type' => 'VARCHAR', 'constraint' => 255],
            'importe' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'moneda' => ['type' => 'VARCHAR', 'constraint' => 255],
            'tip_cam' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'venta' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'cobrador' => ['type' => 'VARCHAR', 'constraint' => 255],
            'observ' => ['type' => 'VARCHAR', 'constraint' => 255],
            'contab' => ['type' => 'INT'],
            'abono' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'usuario' => ['type' => 'VARCHAR', 'constraint' => 255],
            'usufecha' => ['type' => 'INT', 'unsigned' => true], // Asumo que es un timestamp
            'usuhora' => ['type' => 'VARCHAR', 'constraint' => 255],
            'concepto' => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);
        $this->forge->addUniqueKey(['rfc', 'guid', 'puid']);
        $this->forge->createTable('cobdetAcumulada');

        // Tabla cobranzaAcumulada
        $this->forge->addField([
            'rfc' => ['type' => 'VARCHAR', 'constraint' => 255],
            'guid' => ['type' => 'VARCHAR', 'constraint' => 255],
            'dispositivo' => ['type' => 'VARCHAR', 'constraint' => 255],
            'cobranza' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'cliente' => ['type' => 'VARCHAR', 'constraint' => 255],
            'fecha' => ['type' => 'INT', 'unsigned' => true], // Asumo que es un timestamp
            'seriedocumento' => ['type' => 'VARCHAR', 'constraint' => 255],
            'tipo_doc' => ['type' => 'VARCHAR', 'constraint' => 255],
            'no_referen' => ['type' => 'INT'],
            'fecha_venc' => ['type' => 'INT', 'unsigned' => true], // Asumo que es un timestamp
            'importe' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'moneda' => ['type' => 'VARCHAR', 'constraint' => 255],
            'saldo' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'tip_cam' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'venta' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'cobrador' => ['type' => 'VARCHAR', 'constraint' => 255],
            'estado' => ['type' => 'VARCHAR', 'constraint' => 255],
            'observ' => ['type' => 'VARCHAR', 'constraint' => 255],
            'contab' => ['type' => 'INT'],
            'usuario' => ['type' => 'VARCHAR', 'constraint' => 255],
            'usufecha' => ['type' => 'INT', 'unsigned' => true], // Asumo que es un timestamp
            'usuhora' => ['type' => 'VARCHAR', 'constraint' => 255],
            'leyenda' => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);
        $this->forge->addUniqueKey(['rfc', 'guid']);
        $this->forge->createTable('cobranzaAcumulada');
    }

    public function down()
    {
        $this->forge->dropTable('cobdetAcumulada');
        $this->forge->dropTable('cobranzaAcumulada');
    }
}
