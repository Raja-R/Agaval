<?php

namespace App\Controllers;

use Config\Setting; // Loading config class
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;
use App\Models\SalesModel;
use App\Models\ProductModel;
use App\Models\CustomerModel;
use CodeIgniter\I18n\Time;

class Sales extends BaseController
{
    protected $auth;

    /**
     * @var AuthConfig
     */
    protected $config;

    /**
     * @var Session
     */
    protected $session;

    public function __construct()
    {
        // Most services in this controller require
        // the session to be started - so fire it up!
        $this->session = service('session');

        $this->config = config('Auth');
        $this->auth   = service('authentication');
    }

    public function index()
    {
        $current_user = $this->auth->user();
        // Set a return URL if none is specified
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');

        helper('form');
        $uri = service('uri');
        $setting = new Setting;
        $current_user = $this->auth->user();

        $result['page'] = 'Sales List';
        $result['controller'] = $uri->getSegment(1);
        $result['segment'] = $uri->getSegment(2);
        $result['data_table_enable'] = 'Y';
        $result['chart_enable'] = 'Y';
        $result['is_dashboard'] = 'N';
        $result['select2_enable'] = 'Y';
        $result['export_enable'] = 'Y';
        $result['user_data'] = $current_user;
        $result['role_data'] = [];
        $result['site_name'] = $setting->site_name;
        return view('sales/index', $result);
    }

    public function list()
    {
        helper('form');
        $setting = new Setting;

        // is already logged in.
        if (!$this->auth->check()) {
            $redirectURL = session('redirect_url') ?? site_url('/');
            unset($_SESSION['redirect_url']);

            return redirect()->to($redirectURL);
        }
        $current_user = $this->auth->user();
        // Set a return URL if none is specified
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');

        try {
            $salesModel = new SalesModel();
            $sales_list = $salesModel->get_sales_list();

            $result = ['data' => $sales_list];

            return $this->response->setJSON($result);
        } catch (\Exception $e) {
            log_message('error', '[SalesController] ' . $e->getMessage());
            // Return the actual error message for debugging
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function add()
    {
        helper('form');
        $setting = new Setting;
        $uri = service('uri');
        // is already logged in.
        if (!$this->auth->check()) {
            $redirectURL = session('redirect_url') ?? site_url('/');
            unset($_SESSION['redirect_url']);

            return redirect()->to($redirectURL);
        }
        $current_user = $this->auth->user();
        // Set a return URL if none is specified
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');

        $salesModel = new SalesModel();
        $productModel = new ProductModel();

        // Load customers (users with customer role or from customer table)
        $customerModel = new CustomerModel();
        $customer_list = $customerModel->findAll();

        $product_list = $productModel->get_list();

        // Load tax list
        $taxModel = new \App\Models\TaxModel();
        $tax_list = $taxModel->get_all_data();

        $result['page'] = 'Add Sale';
        $result['controller'] = $uri->getSegment(1);
        $result['segment'] = $uri->getSegment(2);
        $result['data_table_enable'] = 'N';
        $result['chart_enable'] = 'N';
        $result['is_dashboard'] = 'N';
        $result['select2_enable'] = 'Y';
        $result['export_enable'] = 'N';
        $result['user_data'] = $current_user;
        $result['customer_list'] = $customer_list;
        $result['product_list'] = $product_list;
        $result['tax_list'] = $tax_list;
        $result['site_name'] = $setting->site_name;
        return view('sales/index', $result);
    }

    public function save()
    {
        $this->request->getPost();

        $rules = [
            "date" => "required|valid_date",
            "user_id" => "required|numeric",
            "order_no" => "required",
            "products" => "required",
        ];

        $messages = [
            "date" => [
                "required" => "Sales date is required",
                "valid_date" => "Please enter a valid date"
            ],
            "user_id" => [
                "required" => "Customer selection is required",
                "numeric" => "Invalid customer selected"
            ],
            "order_no" => [
                "required" => "Sales number is required"
            ],
            "products" => [
                "required" => "At least one product must be selected"
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        } else {
            $salesModel = new SalesModel();

            // Prepare sale data
            $saleData = [
                'order_no' => $this->request->getVar("order_no"),
                'reference' => $this->request->getVar("order_no"),
                'date' => $this->request->getVar("date"),
                'user_id' => $this->request->getVar("user_id"),
                'amount' => $this->request->getVar("subtotal"),
                'discount' => $this->request->getVar("discount"),
                'tax' => $this->request->getVar("tax_amount"),
                'total' => $this->request->getVar("total"),
                'description' => $this->request->getVar("description"),
                'status' => 'ORDERED' // Sales are typically completed immediately
            ];

            // Prepare products data
            $productsData = [];
            $products = $this->request->getVar("products");
            if ($products) {
                foreach ($products as $index => $productData) {
                    if (!empty($productData['product_id'])) {
                        $productsData[] = [
                            'product_id' => $productData['product_id'],
                            'description' => '',
                            'quantity' => $productData['quantity'] ?? 1,
                            'rate' => $productData['rate'] ?? 0,
                            'amount' => $productData['amount'] ?? 0,
                            'discount_value' => 0,
                            'discount_type' => 'PERCENTAGE',
                            'tax_id' => $productData['tax_id'] ?? 0,
                            'total' => $productData['amount'] ?? 0
                        ];
                    }
                }
            }

            if ($this->request->getVar("hdn_saleid") == '') {
                $saleData['created_by'] = $this->auth->user()->id;
                $saleId = $salesModel->save_sale_with_products($saleData, $productsData);
                if ($saleId) {
                    session()->setFlashdata('success_msg', 'Sale has been created successfully');
                } else {
                    session()->setFlashdata('error_msg', 'Failed to create sale');
                    return redirect()->back();
                }
            } else {
                $saleData['updated_by'] = $this->auth->user()->id;
                $saleData['updated_at'] = date('Y-m-d H:i:s');
                $result = $salesModel->update_sale_with_products($this->request->getVar("hdn_saleid"), $saleData, $productsData);
                if ($result) {
                    session()->setFlashdata('success_msg', 'Sale has been updated successfully');
                } else {
                    session()->setFlashdata('error_msg', 'Failed to update sale');
                    return redirect()->back();
                }
            }

            return redirect()->to('Sales');
        }
    }

    public function generate_number()
    {
        $salesModel = new SalesModel();
        $sale_no = $salesModel->generate_sale_number();

        return $this->response->setJSON(['sale_no' => $sale_no]);
    }

    public function update($sale_id = null)
    {
        helper('form');
        $setting = new Setting;
        $uri = service('uri');

        // Check if logged in
        if (!$this->auth->check()) {
            $redirectURL = session('redirect_url') ?? site_url('/');
            unset($_SESSION['redirect_url']);
            return redirect()->to($redirectURL);
        }
        $current_user = $this->auth->user();
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');

        if (!$sale_id || !is_numeric($sale_id)) {
            session()->setFlashdata('error_msg', 'Invalid Sale ID');
            return redirect()->to('Sales');
        }

        $salesModel = new SalesModel();
        $sale_data = $salesModel->get_sale_with_products($sale_id);

        if (!$sale_data) {
            session()->setFlashdata('error_msg', 'Sale not found');
            return redirect()->to('Sales');
        }

        // Load other data
        $productModel = new ProductModel();
        $customerModel = new CustomerModel();

        $customer_list = $customerModel->findAll();
        $product_list = $productModel->get_list();

        // Load tax list
        $taxModel = new \App\Models\TaxModel();
        $tax_list = $taxModel->get_all_data();

        $result['page'] = 'Update Sale';
        $result['controller'] = $uri->getSegment(1);
        $result['segment'] = $uri->getSegment(2);
        $result['data_table_enable'] = 'N';
        $result['chart_enable'] = 'N';
        $result['is_dashboard'] = 'N';
        $result['select2_enable'] = 'Y';
        $result['export_enable'] = 'N';
        $result['user_data'] = $current_user;
        $result['customer_list'] = $customer_list;
        $result['product_list'] = $product_list;
        $result['tax_list'] = $tax_list;
        $result['sale_data'] = $sale_data;
        $result['site_name'] = $setting->site_name;
        return view('sales/index', $result);
    }

    public function delete($sale_id = null)
    {
        if (!$this->auth->check()) {
            return redirect()->to(site_url('dashboard'));
        }

        $uri = service('uri');
        $sale_id = $uri->getSegment(3) ?? $sale_id;

        if (!$sale_id || !is_numeric($sale_id)) {
            session()->setFlashdata('error_msg', 'Invalid Sale ID');
            return redirect()->to('Sales');
        }

        $salesModel = new SalesModel();
        $sale = $salesModel->find($sale_id);

        if (!$sale) {
            session()->setFlashdata('error_msg', 'Sale not found');
            return redirect()->to('Sales');
        }

        try {
            // Delete sale products first
            $db = \Config\Database::connect();
            $db->table('order_product')->where('order_id', $sale_id)->delete();

            // Delete the sale
            $salesModel->delete($sale_id);
            session()->setFlashdata('success_msg', 'Sale has been deleted successfully');
        } catch (\Exception $e) {
            log_message('error', '[SalesController] Delete error: ' . $e->getMessage());
            session()->setFlashdata('error_msg', 'Failed to delete sale');
        }

        return redirect()->to('Sales');
    }

}
