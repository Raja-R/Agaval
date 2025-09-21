<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddInvoiceFieldsForGST extends Migration
{
    public function up()
    {
        $this->forge->addColumn('invoice', [
            'delivery_note' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'reference',
            ],
            'terms_of_payment' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'delivery_note',
            ],
            'buyer_gstin' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => true,
                'after' => 'terms_of_payment',
            ],
            'buyer_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'buyer_gstin',
            ],
            'buyer_address' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'buyer_name',
            ],
            'buyer_state' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'after' => 'buyer_address',
            ],
            'buyer_code' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
                'after' => 'buyer_state',
            ],
            'dispatch_from' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'buyer_code',
            ],
            'dispatch_to' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'dispatch_from',
            ],
            'buyer_order_no' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'after' => 'dispatch_to',
            ],
            'buyer_order_date' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'buyer_order_no',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('invoice', [
            'delivery_note',
            'terms_of_payment',
            'buyer_gstin',
            'buyer_name',
            'buyer_address',
            'buyer_state',
            'buyer_code',
            'dispatch_from',
            'dispatch_to',
            'buyer_order_no',
            'buyer_order_date',
        ]);
    }
}
