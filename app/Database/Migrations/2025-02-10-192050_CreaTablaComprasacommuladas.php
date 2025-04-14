<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreaTablaComprasacommuladas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'rfc' => ['type' => 'VARCHAR', 'constraint' => 255],
            'guid' => ['type' => 'VARCHAR', 'constraint' => 255],
            'dispositivo' => ['type' => 'VARCHAR', 'constraint' => 255],
            'compra' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'ocupado' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'tipo_doc' => ['type' => 'VARCHAR', 'constraint' => 255],
            'factura' => ['type' => 'VARCHAR', 'constraint' => 255],
            'f_emision' => ['type' => 'INT', 'unsigned' => true], // Timestamp
            'hora' => ['type' => 'VARCHAR', 'constraint' => 255],
            'f_venc' => ['type' => 'INT', 'unsigned' => true], // Timestamp
            'proveedor' => ['type' => 'VARCHAR', 'constraint' => 255],
            'importe' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'descuento' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'impuesto' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'costo' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'almacen' => ['type' => 'INT'],
            'estado' => ['type' => 'VARCHAR', 'constraint' => 255],
            'observ' => ['type' => 'VARCHAR', 'constraint' => 255],
            'tipo_cam' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'moneda' => ['type' => 'VARCHAR', 'constraint' => 255],
            'desc1' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'desc2' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'desc3' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'desc4' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'desc5' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'datos' => ['type' => 'TEXT'],
            'desglose' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'cuenxpag' => ['type' => 'INT'],
            'usuario' => ['type' => 'VARCHAR', 'constraint' => 255],
            'usufecha' => ['type' => 'INT', 'unsigned' => true], // Timestamp
            'usuhora' => ['type' => 'VARCHAR', 'constraint' => 255],
            'exportado' => ['type' => 'INT'],
            'no_referen' => ['type' => 'INT'],
            'vencimiento' => ['type' => 'INT', 'unsigned' => true], // Timestamp
            'decompra' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'donativo' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'porcentajederetencion' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'retencion' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'pedimentos' => ['type' => 'TEXT'],
            'compraconfirmada' => ['type' => 'INT'],
            'uuid' => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);
        $this->forge->addUniqueKey(['rfc', 'guid']);
        $this->forge->createTable('comprasAcumuladas');
    }

    public function down()
    {
        $this->forge->dropTable('comprasAcumuladas');
    }
}
