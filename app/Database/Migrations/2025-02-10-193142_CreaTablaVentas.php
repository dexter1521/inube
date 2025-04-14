<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreaTablaVentas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'VENTA' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'SUCURSAL' => ['type' => 'VARCHAR', 'constraint' => 255],
            'OCUPADO' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'TIPO_DOC' => ['type' => 'VARCHAR', 'constraint' => 255],
            'serieDocumento' => ['type' => 'VARCHAR', 'constraint' => 255],
            'NO_REFEREN' => ['type' => 'INT'],
            'F_EMISION' => ['type' => 'VARCHAR', 'constraint' => 255], // Considerar cambiar a DATE o DATETIME
            'F_VENC' => ['type' => 'VARCHAR', 'constraint' => 255], // Considerar cambiar a DATE o DATETIME
            'CLIENTE' => ['type' => 'VARCHAR', 'constraint' => 255],
            'VEND' => ['type' => 'VARCHAR', 'constraint' => 255],
            'IMPORTE' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'DESCUENTO' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'IMPUESTO' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'PRECIO' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'COSTO' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'ALMACEN' => ['type' => 'INT'],
            'ESTADO' => ['type' => 'VARCHAR', 'constraint' => 255],
            'OBSERV' => ['type' => 'VARCHAR', 'constraint' => 255],
            'TIPO_CAM' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'MONEDA' => ['type' => 'VARCHAR', 'constraint' => 255],
            'DESC1' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'DESC2' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'DESC3' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'DESC4' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'DESC5' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'DATOS' => ['type' => 'TEXT'],
            'ENFAC' => ['type' => 'INT'],
            'VENTAREF' => ['type' => 'INT'],
            'CIERRE' => ['type' => 'INT'],
            'cierretienda' => ['type' => 'INT'],
            'DESGLOSE' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'COBRANZA' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'USUARIO' => ['type' => 'VARCHAR', 'constraint' => 255],
            'USUFECHA' => ['type' => 'VARCHAR', 'constraint' => 255], // Considerar cambiar a DATE o DATETIME
            'USUHORA' => ['type' => 'VARCHAR', 'constraint' => 255],
            'AUTO' => ['type' => 'INT'],
            'Relacion' => ['type' => 'INT'],
            'PEDCLI' => ['type' => 'VARCHAR', 'constraint' => 255],
            'PEMB' => ['type' => 'VARCHAR', 'constraint' => 255],
            'DATEMB' => ['type' => 'VARCHAR', 'constraint' => 255],
            'AplicarDes' => ['type' => 'VARCHAR', 'constraint' => 255],
            'TipoVenta' => ['type' => 'VARCHAR', 'constraint' => 255],
            'Exportado' => ['type' => 'INT'],
            'VentaSuc' => ['type' => 'INT'],
            'Pago1' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'Pago2' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'Pago3' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'Concepto1' => ['type' => 'VARCHAR', 'constraint' => 255],
            'Concepto2' => ['type' => 'VARCHAR', 'constraint' => 255],
            'Concepto3' => ['type' => 'VARCHAR', 'constraint' => 255],
            'Comision' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'VentaOrigen' => ['type' => 'INT'],
            'Diario' => ['type' => 'INT'],
            'Caja' => ['type' => 'VARCHAR', 'constraint' => 255],
            'OrigenDev' => ['type' => 'INT'],
            'Corte' => ['type' => 'VARCHAR', 'constraint' => 255],
            'Impreso' => ['type' => 'VARCHAR', 'constraint' => 255],
            'BANCO' => ['type' => 'VARCHAR', 'constraint' => 255],
            'NumeroCheque' => ['type' => 'VARCHAR', 'constraint' => 255],
            'estacion' => ['type' => 'VARCHAR', 'constraint' => 255],
            'interes' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'redondeo' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'Ticket' => ['type' => 'INT'],
            'importar' => ['type' => 'INT'],
            'sucremota' => ['type' => 'VARCHAR', 'constraint' => 255],
            'ventaremota' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'comodin' => ['type' => 'VARCHAR', 'constraint' => 255],
            'iespecial' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'nodesglosedetalle' => ['type' => 'INT'],
            'verificado' => ['type' => 'INT'],
            'donativo' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'pagado' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'comisionvendedor' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'comodin1' => ['type' => 'VARCHAR', 'constraint' => 255],
            'comodin2' => ['type' => 'VARCHAR', 'constraint' => 255],
            'comodin3' => ['type' => 'VARCHAR', 'constraint' => 255],
            'comodin4' => ['type' => 'VARCHAR', 'constraint' => 255],
            'pago4' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'concepto4' => ['type' => 'VARCHAR', 'constraint' => 255],
            'fechacierre' => ['type' => 'VARCHAR', 'constraint' => 255], // Considerar cambiar a DATE o DATETIME
            'businessintelligence' => ['type' => 'INT'],
            'pedido' => ['type' => 'INT'],
            'cambioDeEstado' => ['type' => 'INT'],
            'paraconcentrador' => ['type' => 'INT'],
            'tocken' => ['type' => 'VARCHAR', 'constraint' => 255],
            'uuid' => ['type' => 'VARCHAR', 'constraint' => 255],
            'importeletra' => ['type' => 'TEXT'],
            'facturado' => ['type' => 'INT'],
        ]);
        $this->forge->addKey('ID', true); // Primary Key
        // Agregar índices adicionales
        $this->forge->addKey('F_EMISION');
        $this->forge->addKey(['SUCURSAL', 'serieDocumento', 'TIPO_DOC', 'NO_REFEREN']);
        $this->forge->addKey('CLIENTE');
        $this->forge->addKey('VEND');
        $this->forge->addKey('SUCURSAL');
        $this->forge->addKey('uuid');
        $this->forge->addKey('tocken');
        $this->forge->addKey(['USUFECHA', 'USUHORA']);
        $this->forge->createTable('ventas');
    }

    public function down()
    {
        $this->forge->dropTable('ventas');
    }
}
