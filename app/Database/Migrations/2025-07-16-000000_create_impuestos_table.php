<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateImpuestosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'rfc' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'guid' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'nombreImpuesto' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'porcentajeImpuesto' => [
                'type'       => 'NUMERIC',
                'null'       => true,
            ],
            'tipoImpuesto' => [
                'type'       => 'NUMERIC',
                'null'       => true,
            ],
            'ambito' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'sku' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('ID', true);
        $this->forge->createTable('impuestos');
    }

    public function down()
    {
        $this->forge->dropTable('impuestos');
    }
}
