<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddHsnSacToInvoiceProductTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('invoice_product', [
            'hsn_sac' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'after' => 'description',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('invoice_product', 'hsn_sac');
    }
}
