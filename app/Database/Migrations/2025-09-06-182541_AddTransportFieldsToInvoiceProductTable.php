<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTransportFieldsToInvoiceProductTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('invoice_product', [
            'lr_number' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'after' => 'description',
            ],
            'transport_date' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'lr_number',
            ],
            'truck_number' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'after' => 'transport_date',
            ],
            'route_from_to' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'truck_number',
            ],
            'material' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'route_from_to',
            ],
            'nos' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 1,
                'after' => 'material',
            ],
            'weight_kg' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'after' => 'nos',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('invoice_product', [
            'lr_number',
            'transport_date',
            'truck_number',
            'route_from_to',
            'material',
            'nos',
            'weight_kg',
        ]);
    }
}
