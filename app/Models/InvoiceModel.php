<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table = 'invoice';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowCallbacks = true;

    protected $allowedFields = [
        'app_id',
        'user_id',
        'order_no',
        'date',
        'reference',
        'reference_date',
        'other_reference',
        'delivery_note',
        'delivery_note_date',
        'terms_of_payment',
        'terms_of_delivery',
        'buyer_gstin',
        'buyer_name',
        'buyer_address',
        'buyer_state',
        'buyer_code',
        'dispatch_from',
        'dispatch_to',
        'dispatch_doc_no',
        'seller_gstin',
        'seller_state',
        'seller_code',
        'buyer_order_no',
        'buyer_order_date',
        'amount',
        'discount',
        'tax',
        'charges',
        'roundoff',
        'total',
        'paid_amount',
        'description',
        'status',
        'schedule',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

    protected $useSoftDeletes = false;

    // Validation rules
    protected $validationRules = [
        'date' => 'required|valid_date',
        'amount' => 'numeric',
        'total' => 'numeric',
        // Add 'ISSUED' to the allowed status list if needed
        'status' => 'in_list[DRAFT,ORDERED,SCHEDULED,CANCELED,DELIVERED,ISSUED]'
    ];

    protected $validationMessages = [
        'date' => [
            'required' => 'Invoice date is required',
            'valid_date' => 'Please enter a valid date'
        ]
    ];

    public function get_invoice_list($limit = null, $offset = 0)
    {
        $this->select('invoice.*, users.first_name, users.last_name, users.mobile');
        $this->join('users', 'users.id = invoice.user_id', 'left');
        $this->orderBy('invoice.id', 'DESC');

        if ($limit) {
            return $this->paginate($limit, 'default', $offset);
        }

        return $this->findAll();
    }

    public function get_invoice_with_products($invoice_id)
    {
        $invoice = $this->find($invoice_id);

        if ($invoice) {
            $db = $this->db;
            $invoice['products'] = $db->table('invoice_product')
                ->select('invoice_product.*, product.name, product.hsn_sac_code')
                ->join('product', 'product.id = invoice_product.product_id', 'left')
                ->where('invoice_product.invoice_id', $invoice_id)
                ->get()
                ->getResultArray();

            // Set HSN/SAC from product if available, otherwise use invoice_product field
            foreach ($invoice['products'] as &$product) {
                if (empty($product['hsn_sac']) && !empty($product['hsn_sac_code'])) {
                    $product['hsn_sac'] = $product['hsn_sac_code'];
                }
            }

                $customer = $db->table('customer')
                    ->where('id', $invoice['user_id'])
                    ->get()
                    ->getRowArray();

                $invoice['customer'] = $customer;
        }

        return $invoice;
    }

    public function generate_invoice_number()
    {
        $date = date('Ymd');
        $lastInvoice = $this->where('DATE(created_at)', date('Y-m-d'))
            ->orderBy('id', 'DESC')
            ->first();

        if ($lastInvoice) {
            $lastNumber = intval(substr($lastInvoice['order_no'], -4)) + 1;
        } else {
            $lastNumber = 1;
        }

        return 'INV' . $date . str_pad($lastNumber, 4, '0', STR_PAD_LEFT);
    }

    public function get_total_amount($start_date = null, $end_date = null)
    {
        $this->selectSum('total');

        if ($start_date && $end_date) {
            $this->where('date >=', $start_date);
            $this->where('date <=', $end_date);
        }

        return $this->first();
    }
    public function save_invoice_with_products($invoiceData, $productsData)
    {
        $this->db->transStart();

        try {
            $invoiceId = $this->insert($invoiceData, true);

            // Insert invoice products
            foreach ($productsData as $product) {
                $product['invoice_id'] = $invoiceId;
                $this->db->table('invoice_product')->insert($product);
            }

            $this->db->transComplete();

            if ($this->db->transStatus() === FALSE) {
                return false;
            }

            return $invoiceId;
        } catch (\Exception $e) {
            log_message('error', 'InvoicesModel save_invoice_with_products error: ' . $e->getMessage());
            $this->db->transRollback();
            return false;
        }
    }
    public function update_invoice_with_products($invoiceId, $invoiceData, $productsData)
    {
        $this->db->transStart();

        try {
            // Update invoice
            $this->update($invoiceId, $invoiceData);

            // Delete existing products
            $this->db->table('invoice_product')->where('invoice_id', $invoiceId)->delete();

            // Insert updated products
            foreach ($productsData as $product) {
                $product['invoice_id'] = $invoiceId;
                $this->db->table('invoice_product')->insert($product);
            }

            $this->db->transComplete();

            if ($this->db->transStatus() === FALSE) {
                return false;
            }

            return true;
        } catch (\Exception $e) {
            log_message('error', 'InvoiceModel update_invoice_with_products error: ' . $e->getMessage());
            $this->db->transRollback();
            return false;
        }
    }
}
