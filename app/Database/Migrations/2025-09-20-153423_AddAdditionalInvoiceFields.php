<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAdditionalInvoiceFields extends Migration
{
    public function up()
    {
        $this->forge->addColumn('invoice', [
            'seller_gstin' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => true,
                'after' => 'buyer_order_date',
            ],
            'seller_state' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'after' => 'seller_gstin',
            ],
            'seller_code' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
                'after' => 'seller_state',
            ],
            'reference_date' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'reference',
            ],
            'other_reference' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'reference_date',
            ],
            'dispatch_doc_no' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'after' => 'dispatch_to',
            ],
            'delivery_note_date' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'delivery_note',
            ],
            'terms_of_delivery' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'terms_of_payment',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('invoice', [
            'seller_gstin',
            'seller_state',
            'seller_code',
            'reference_date',
            'other_reference',
            'dispatch_doc_no',
            'delivery_note_date',
            'terms_of_delivery',
        ]);
    }
}
