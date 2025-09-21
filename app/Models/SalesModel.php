<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesModel extends Model
{
    protected $table = 'order';
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
        'status' => 'in_list[DRAFT,ORDERED,SCHEDULED,CANCELED,DELIVERED]'
    ];

    protected $validationMessages = [
        'date' => [
            'required' => 'Sales date is required',
            'valid_date' => 'Please enter a valid date'
        ]
    ];

    public function get_sales_list($limit = null, $offset = 0)
    {
        $this->select('order.*, users.first_name, users.last_name, users.mobile');
        $this->join('users', 'users.id = order.user_id', 'left');
        $this->orderBy('order.id', 'DESC');

        if ($limit) {
            return $this->paginate($limit, 'default', $offset);
        }

        return $this->findAll();
    }

    public function get_sale_with_products($sale_id)
    {
        $sale = $this->find($sale_id);

        if ($sale) {
            $db = $this->db;
            $sale['products'] = $db->table('order_product')
                ->select('order_product.*, product.name')
                ->join('product', 'product.id = order_product.product_id', 'left')
                ->where('order_product.order_id', $sale_id)
                ->get()
                ->getResultArray();
        }

        return $sale;
    }

    public function generate_sale_number()
    {
        $date = date('Ymd');
        $lastSale = $this->where('DATE(created_at)', date('Y-m-d'))
            ->orderBy('id', 'DESC')
            ->first();

        if ($lastSale) {
            $lastNumber = intval(substr($lastSale['order_no'], -4)) + 1;
        } else {
            $lastNumber = 1;
        }

        return 'ORD' . $date . str_pad($lastNumber, 4, '0', STR_PAD_LEFT);
    }

    public function get_total_sales($start_date = null, $end_date = null)
    {
        $this->selectSum('total');

        if ($start_date && $end_date) {
            $this->where('date >=', $start_date);
            $this->where('date <=', $end_date);
        }

        return $this->first();
    }

    public function save_sale_with_products($saleData, $productsData)
    {
        $this->db->transStart();

        try {
            // Insert sale/order
            $saleId = $this->insert($saleData);

            // Insert sale products
            foreach ($productsData as $product) {
                $product['order_id'] = $saleId;
                $this->db->table('order_product')->insert($product);
            }

            $this->db->transComplete();

            if ($this->db->transStatus() === FALSE) {
                return false;
            }

            return $saleId;
        } catch (\Exception $e) {
            log_message('error', 'SalesModel save_sale_with_products error: ' . $e->getMessage());
            $this->db->transRollback();
            return false;
        }
    }

    public function update_sale_with_products($saleId, $saleData, $productsData)
    {
        $this->db->transStart();

        try {
            // Update sale/order
            $this->update($saleId, $saleData);

            // Delete existing products
            $this->db->table('order_product')->where('order_id', $saleId)->delete();

            // Insert updated products
            foreach ($productsData as $product) {
                $product['order_id'] = $saleId;
                $this->db->table('order_product')->insert($product);
            }

            $this->db->transComplete();

            if ($this->db->transStatus() === FALSE) {
                return false;
            }

            return true;
        } catch (\Exception $e) {
            log_message('error', 'SalesModel update_sale_with_products error: ' . $e->getMessage());
            $this->db->transRollback();
            return false;
        }
    }
}