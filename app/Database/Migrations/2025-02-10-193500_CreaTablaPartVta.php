<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreaTablaPartvta extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'SUCURSAL' => ['type' => 'VARCHAR', 'constraint' => 255],
            'VENTA' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'ID_SALIDA' => ['type' => 'INT'],
            'F_EMISION' => ['type' => 'VARCHAR', 'constraint' => 255], // Considerar cambiar a DATE o DATETIME
            'TIPO_DOC' => ['type' => 'VARCHAR', 'constraint' => 255],
            'serieDocumento' => ['type' => 'VARCHAR', 'constraint' => 255],
            'NO_REFEREN' => ['type' => 'INT'],
            'ARTICULO' => ['type' => 'VARCHAR', 'constraint' => 255],
            'CANTIDAD' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'PRECIO' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'COSTO' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'DESCUENTO' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'IMPUESTO' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'OBSERV' => ['type' => 'VARCHAR', 'constraint' => 255],
            'PARTIDA' => ['type' => 'INT'],
            'Usuario' => ['type' => 'VARCHAR', 'constraint' => 255],
            'UsuFecha' => ['type' => 'VARCHAR', 'constraint' => 255], // Considerar cambiar a DATE o DATETIME
            'UsuHora' => ['type' => 'VARCHAR', 'constraint' => 255],
            'ALMACEN' => ['type' => 'INT'],
            'LISTA' => ['type' => 'INT'],
            'Clave' => ['type' => 'VARCHAR', 'constraint' => 255],
            'PRCANTIDAD' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'PRDESCRIP' => ['type' => 'VARCHAR', 'constraint' => 255],
            'estado' => ['type' => 'VARCHAR', 'constraint' => 255],
            'PrecioBase' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'Autorizado' => ['type' => 'VARCHAR', 'constraint' => 255],
            'Caja' => ['type' => 'VARCHAR', 'constraint' => 255],
            'Devolucion' => ['type' => 'INT'],
            'DevConf' => ['type' => 'INT'],
            'ID_entrada' => ['type' => 'INT'],
            'Invent' => ['type' => 'INT'],
            'importe' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'kit' => ['type' => 'INT'],
            'costo_u' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'iespecial' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'puntadas' => ['type' => 'INT'],
            'colores' => ['type' => 'INT'],
            'verificado' => ['type' => 'INT'],
            'donativo' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'A01' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'peso' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'lote' => ['type' => 'INT'],
            'iepslitro' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
        ]);
        $this->forge->addKey('ID', true); // Clave primaria y autoincrementable
        $this->forge->createTable('partvta');

        // Índices
        $this->forge->addKey(['SUCURSAL', 'VENTA']);
        $this->forge->addKey('ARTICULO');
        $this->forge->addKey('F_EMISION');
        $this->forge->addKey(['UsuFecha', 'UsuHora']);
    }

    public function down()
    {
        $this->forge->dropTable('partvta');
    }
}