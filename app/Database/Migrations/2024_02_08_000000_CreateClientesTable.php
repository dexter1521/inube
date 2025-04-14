<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClientesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID'                => ['type' => 'INTEGER', 'constraint' => 11, 'auto_increment' => true],
            'clave'             => ['type' => 'TEXT', 'null' => false],
            'cliente'           => ['type' => 'TEXT', 'null' => false],
            'rfc'               => ['type' => 'TEXT', 'null' => false],
            'nombre'            => ['type' => 'TEXT', 'null' => false],
            'calle'             => ['type' => 'TEXT', 'null' => true],
            'colonia'           => ['type' => 'TEXT', 'null' => true],
            'localidad'         => ['type' => 'TEXT', 'null' => true],
            'municipio'         => ['type' => 'TEXT', 'null' => true],
            'estado'            => ['type' => 'TEXT', 'null' => true],
            'pais'              => ['type' => 'TEXT', 'null' => true],
            'telefono'          => ['type' => 'TEXT', 'null' => true],
            'codigopostal'      => ['type' => 'TEXT', 'null' => true],
            'mail'              => ['type' => 'TEXT', 'null' => true],
            'mailcobranza'      => ['type' => 'TEXT', 'null' => true],
            'numeroExterior'    => ['type' => 'TEXT', 'null' => true],
            'numeroInterior'    => ['type' => 'TEXT', 'null' => true],
            'accesos'           => ['type' => 'TEXT', 'null' => true],
            'ultimoAcceso'      => ['type' => 'TEXT', 'null' => true],
            'bloqueado'         => ['type' => 'NUMERIC', 'null' => true],
            'diasdecredito'     => ['type' => 'NUMERIC', 'null' => true],
            'credito'           => ['type' => 'NUMERIC', 'null' => true],
            'usocfdi'           => ['type' => 'TEXT', 'null' => true],
            'saldo'             => ['type' => 'NUMERIC', 'null' => true],
            'asociacion'        => ['type' => 'TEXT', 'null' => true],
            'franquicia'        => ['type' => 'TEXT', 'null' => true],
            'clavesucursal'     => ['type' => 'TEXT', 'null' => true],
            'nombresucursal'    => ['type' => 'TEXT', 'null' => true],
            'tiposucursal'      => ['type' => 'TEXT', 'null' => true],
            'esquina'           => ['type' => 'TEXT', 'null' => true],
            'entrecalle'        => ['type' => 'TEXT', 'null' => true],
            'referencia'        => ['type' => 'TEXT', 'null' => true],
            'latitud'           => ['type' => 'TEXT', 'null' => true],
            'longitud'          => ['type' => 'TEXT', 'null' => true],
            'nombrecontacto'    => ['type' => 'TEXT', 'null' => true],
            'apellidopatcont'   => ['type' => 'TEXT', 'null' => true],
            'apellidomatcont'   => ['type' => 'TEXT', 'null' => true],
            'cargocont'         => ['type' => 'TEXT', 'null' => true],
            'horariosuc'        => ['type' => 'TEXT', 'null' => true],
            'giro'              => ['type' => 'TEXT', 'null' => true],
            'cobrador'          => ['type' => 'TEXT', 'null' => true],
            'exportado'         => ['type' => 'INTEGER', 'null' => true],
            'descargado'        => ['type' => 'INTEGER', 'null' => true],
            'actualizado'       => ['type' => 'INTEGER', 'null' => true],
        ]);

        $this->forge->addKey('ID', true);
        $this->forge->addKey('rfc');
        $this->forge->addKey('nombre');
        $this->forge->addKey('clave');

        $this->forge->createTable('clientes');
    }

    public function down()
    {
        $this->forge->dropTable('clientes');
    }
}
