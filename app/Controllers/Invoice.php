<?php

namespace App\Controllers;

use Config\Setting; // Loading config class
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;
use App\Models\ProductModel;
use App\Models\InvoiceModel;
use App\Models\CustomerModel;
use CodeIgniter\I18n\Time;

class Invoice extends BaseController
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

    /**
     * @var \CodeIgniter\Database\ConnectionInterface
     */
    protected $db;

    public function __construct()
    {
        // Most services in this controller require
        // the session to be started - so fire it up!
        $this->session = service('session');

        $this->config = config('Auth');
        $this->auth   = service('authentication');
        $this->db = \Config\Database::connect();
    }


    public function index()
    {
        $current_user = $this->auth->user();
        // Set a return URL if none is specified
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');

        helper('form');
        $uri = service('uri');
        $setting = new Setting;

        $result['page'] = 'Invoice List';
        $result['controller'] = $uri->getSegment(1);
        $result['segment'] = $uri->getSegment(2);
        $result['data_table_enable'] = 'Y';
        $result['chart_enable'] = 'N';
        $result['is_dashboard'] = 'N';
        $result['select2_enable'] = 'Y';
        $result['export_enable'] = 'Y';
        $result['user_data'] = $current_user;
        $result['role_data'] = [];
        $result['site_name'] = $setting->site_name;
        return view('invoice/index', $result);
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
            $invoiceModel = new \App\Models\InvoiceModel();
            $invoice_list = $invoiceModel->get_invoice_list();

            $result = ['data' => $invoice_list];

            return $this->response->setJSON($result);
        } catch (\Exception $e) {
            log_message('error', '[InvoiceController] ' . $e->getMessage());
            // Return the actual error message for debugging
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function get_orders_list()
    {
        helper('form');
        $setting = new Setting;

        // Check authentication
        if (!$this->auth->check()) {
            $redirectURL = session('redirect_url') ?? site_url('/');
            unset($_SESSION['redirect_url']);
            return redirect()->to($redirectURL);
        }

        try {
            $salesModel = new \App\Models\SalesModel();
            $orders_list = $salesModel->get_sales_list();

            $result = ['data' => $orders_list];

            return $this->response->setJSON($result);
        } catch (\Exception $e) {
            log_message('error', '[InvoiceController] get_orders_list error: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function convert_order_to_invoice()
    {
        if (!$this->auth->check()) {
            return redirect()->to(site_url('dashboard'));
        }

        $uri = service('uri');
        $order_id = $uri->getSegment(3);
        if (!$order_id || !is_numeric($order_id)) {
            session()->setFlashdata('error_msg', 'Invalid Order ID');
            return redirect()->to('Invoice');
        }

        $salesModel = new \App\Models\SalesModel();
        $invoiceModel = new \App\Models\InvoiceModel();

        $order_data = $salesModel->get_sale_with_products($order_id);

        if (!$order_data) {
            session()->setFlashdata('error_msg', 'Order not found');
            return redirect()->to('Invoice');
        }

        // Check if already converted to invoice
        $existing_invoice = $invoiceModel->where('reference', $order_data['id'])->first();
        if ($existing_invoice) {
            session()->setFlashdata('error_msg', 'Order has already been converted to invoice');
            return redirect()->to('Invoice/view/' . $existing_invoice->id);
        }

        try {
            // Generate invoice number
            $invoice_no = $invoiceModel->generate_invoice_number();

            // Prepare invoice data
            $invoiceData = [
                'app_id' => $order_data['app_id'] ?? null,
                'user_id' => $order_data['user_id'],
                'order_no' => $invoice_no,
                'date' => $order_data['date'],
                'reference' => $order_data['id'], // Store original order ID
                'amount' => $order_data['amount'],
                'discount' => $order_data['discount'] ?? 0,
                'tax' => $order_data['tax'] ?? 0,
                'total' => $order_data['total'],
                'description' => $order_data['description'],
                'status' => 'ISSUED', // Invoice status
                'created_by' => $this->auth->user()->id
            ];

            // Insert invoice
            $invoiceId = $invoiceModel->insert($invoiceData);

            // Copy products
            foreach ($order_data['products'] as $product) {
                $this->db->table('invoice_product')->insert([
                    'invoice_id' => $invoiceId,
                    'product_id' => $product['product_id'],
                    'description' => $product['description'] ?? '',
                    'quantity' => $product['quantity'],
                    'rate' => $product['rate'],
                    'amount' => $product['amount'],
                    'total' => $product['total'] ?? $product['amount']
                ]);
            }

            session()->setFlashdata('success_msg', "Order #{$order_data['order_no']} has been converted to Invoice #{$invoice_no}");
            return redirect()->to('Invoice/view/' . $invoiceId);
        } catch (\Exception $e) {
            log_message('error', '[InvoiceController] convert_order_to_invoice error: ' . $e->getMessage());
            session()->setFlashdata('error_msg', 'Failed to convert order to invoice');
            return redirect()->back();
        }
    }

    public function update()
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
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');

        $invoice_id = $uri->getSegment(3);
        if (!$invoice_id || !is_numeric($invoice_id)) {
            session()->setFlashdata('error_msg', 'Invalid Invoice ID');
            return redirect()->to('Invoice');
        }

        $invoiceModel = new InvoiceModel();
        $invoice_data = $invoiceModel->get_invoice_with_products($invoice_id);

        if (!$invoice_data) {
            session()->setFlashdata('error_msg', 'Invoice not found');
            return redirect()->to('Invoice');
        }

        $productModel = new ProductModel();

        // Load customers (users with customer role or from customer table)
        $customerModel = new \App\Models\CustomerModel();
        $customer_list = $customerModel->findAll();

        $product_list = $productModel->get_list();

        // Load tax list
        $taxModel = new \App\Models\TaxModel();
        $tax_list = $taxModel->get_all_data();

        $result['page'] = 'Edit Invoice';
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
        $result['invoice_data'] = $invoice_data;
        $result['site_name'] = $setting->site_name;
        return view('invoice/index', $result);
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
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');

        $invoiceModel = new \App\Models\InvoiceModel();
        $productModel = new ProductModel();

        // Load customers (users with customer role or from customer table)
        $customerModel = new \App\Models\CustomerModel();
        $customer_list = $customerModel->findAll();

        $product_list = $productModel->get_list();

        // Load tax list
        $taxModel = new \App\Models\TaxModel();
        $tax_list = $taxModel->get_all_data();

        $result['page'] = 'Add Invoice';
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
        return view('invoice/index', $result);
    }

    public function update_product()
    {
        helper('form');
        $setting = new Setting;
        $uri = service('uri');
        if (!$this->auth->check()) {
            $redirectURL = session('redirect_url') ?? site_url('/');
            unset($_SESSION['redirect_url']);
            return redirect()->to($redirectURL);
        }
        $current_user = $this->auth->user();
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');

        $product_id = $uri->getSegment(3);

        if ($product_id == '') {
            session()->setFlashdata('error_msg', 'Invalid Product');
            return redirect()->to('Product');
        }
        $ProductModel = new ProductModel();
        $result['product_data'] = $ProductModel->get_data_by_id($product_id);
        $result['category_data'] = $ProductModel->get_category_list();

        $result['page'] = 'Product Update';
        $result['controller'] = $uri->getSegment(1);
        $result['segment'] = $uri->getSegment(2);
        $result['data_table_enable'] = 'N';
        $result['chart_enable'] = 'N';
        $result['is_dashboard'] = 'N';
        $result['select2_enable'] = 'Y';
        $result['export_enable'] = 'Y';
        $result['user_data'] = $current_user;
        $result['site_name'] = $setting->site_name;
        return view('product/index', $result);
    }

    public function save_product()
    {
        $rules = [
            "name" => "required|min_length[3]",
            "rate" => "required|numeric",
            "category_id" => "required|numeric",
        ];

        $messages = [
            "name" => [
                "required" => "Product Name is required"
            ],
            "rate" => [
                "required" => "Product Rate is required"
            ],
            "category_id" => [
                "required" => "Category is required"
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        } else {
            $ProductModel = new ProductModel();
            $data = [
                'name' => $this->request->getVar("name"),
                'code' => $this->request->getVar("code"),
                'rate' => $this->request->getVar("rate"),
                'category_id' => $this->request->getVar("category_id"),
                'description' => $this->request->getVar("description"),
                'status' => $this->request->getVar("status") ?? 'INACTIVE',
            ];

            if ($this->request->getVar("hdn_productid") == '') {
                $data['created_by'] = $this->auth->user()->id;
                $ProductModel->insert($data);
                session()->setFlashdata('success_msg', 'Product has been added successfully');
            } else {
                $data['updated_by'] = $this->auth->user()->id;
                $data['updated_at'] = date('Y-m-d H:i:s');
                $ProductModel->update($this->request->getVar("hdn_productid"), $data);
                session()->setFlashdata('success_msg', 'Product has been updated successfully');
            }

            return redirect()->to('Product');
        }
    }

    public function view_product()
    {
        helper('form');
        $setting = new Setting;
        $uri = service('uri');
        if (!$this->auth->check()) {
            $redirectURL = session('redirect_url') ?? site_url('/');
            unset($_SESSION['redirect_url']);
            return redirect()->to($redirectURL);
        }
        $current_user = $this->auth->user();
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');

        $product_id = $uri->getSegment(3);

        if ($product_id == '') {
            session()->setFlashdata('error_msg', 'Invalid Product');
            return redirect()->to('Product');
        }
        $ProductModel = new ProductModel();
        $result['product_data'] = $ProductModel->get_data_by_id($product_id);

        $result['page'] = 'Product View';
        $result['controller'] = $uri->getSegment(1);
        $result['segment'] = $uri->getSegment(2);
        $result['data_table_enable'] = 'N';
        $result['chart_enable'] = 'N';
        $result['is_dashboard'] = 'N';
        $result['select2_enable'] = 'Y';
        $result['export_enable'] = 'N';
        $result['user_data'] = $current_user;
        $result['config_detail'] = [];
        $result['site_name'] = $setting->site_name;
        return view('product/index', $result);
    }

    public function category()
    {
        $current_user = $this->auth->user();
        // Set a return URL if none is specified
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');

        helper('form');
        $uri = service('uri');
        $setting = new Setting;
        $current_user = $this->auth->user();

        $result['page'] = 'Expenses Category List';
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
        return view('expense/index', $result);
    }

    public function category_list()
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

        $ProductModel = new ProductModel();
        $expense_list = $ProductModel->get_category_list();


        $result = [];
        $result['data'] = $expense_list;
        echo json_encode($result);
    }

    public function category_add()
    {
        $current_user = $this->auth->user();
        // Set a return URL if none is specified
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');

        helper('form');
        $uri = service('uri');
        $setting = new Setting;
        $current_user = $this->auth->user();

        $result['page'] = 'Expenses Category Add';
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
        return view('expense/index', $result);
    }

    public function category_update()
    {
        $current_user = $this->auth->user();
        // Set a return URL if none is specified
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');

        helper('form');
        $uri = service('uri');
        $setting = new Setting;
        $current_user = $this->auth->user();

        $category_id = $uri->getSegment(3);

        if ($category_id == '') {
            session()->setFlashdata('error_msg', 'Invalid Customer');
            return redirect()->to('Customer');
        }
        $ProductModel = new ProductModel();
        $category_data = $ProductModel->get_cat_data_by_id($category_id);
        $result['category_data'] = $category_data;

        $result['page'] = 'Expenses Category Add';
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
        return view('expense/index', $result);
    }

    public function save_category()
    {
        $id = $this->request->getVar("hdn_categoryid");
        $rules = [
            "category_name" => "required|min_length[3]",
        ];

        $messages = [
            "category_name" => [
                "required" => "Category Name is required"
            ],
        ];

        if (!$this->validate($rules, $messages)) {

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        } else {
            $ProductModel = new ProductModel();
            $data = [];
            $data['category_name'] = $this->request->getVar("category_name");
            $data['description'] = $this->request->getVar("category_desc");

            if ($this->request->getVar("category_status") == '') {
                $data['status'] = 'INACTIVE';
            } else {
                $data['status'] = $this->request->getVar("category_status");
            }



            if ($this->request->getVar("hdn_categoryid") == '') {
                $data['created_by'] = $this->auth->user()->id;
                $ProductModel->insert_category_data($data);
                session()->setFlashdata('success_msg', 'Category has been added successfully');
            } else {
                $data['updated_by'] = $this->auth->user()->id;
                $data['updated_at'] = date('Y-m-d H:i:s');
                $ProductModel->update_category_data($this->request->getVar("hdn_categoryid"), $data);
                session()->setFlashdata('success_msg', 'Category has been updated successfully');
            }

            return redirect()->to('Expenses/category');
        }
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
                "required" => "Invoice date is required",
                "valid_date" => "Please enter a valid date"
            ],
            "user_id" => [
                "required" => "Customer selection is required",
                "numeric" => "Invalid customer selected"
            ],
            "order_no" => [
                "required" => "Invoice number is required"
            ],
            "products" => [
                "required" => "At least one product must be selected"
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        } else {
            $invoiceModel = new InvoiceModel();

            // Prepare invoice data
            $invoiceData = [
                'order_no' => $this->request->getVar("order_no"),
                'date' => $this->request->getVar("date"),
                'user_id' => $this->request->getVar("user_id"),
                'reference' => $this->request->getVar("reference"),
                'reference_date' => $this->request->getVar("reference_date"),
                'other_reference' => $this->request->getVar("other_reference"),
                'delivery_note' => $this->request->getVar("delivery_note"),
                'delivery_note_date' => $this->request->getVar("delivery_note_date"),
                'terms_of_payment' => $this->request->getVar("terms_of_payment"),
                'terms_of_delivery' => $this->request->getVar("terms_of_delivery"),
                'buyer_gstin' => $this->request->getVar("buyer_gstin"),
                'buyer_name' => $this->request->getVar("buyer_name"),
                'buyer_address' => $this->request->getVar("buyer_address"),
                'buyer_state' => $this->request->getVar("buyer_state"),
                'buyer_code' => $this->request->getVar("buyer_code"),
                'dispatch_from' => $this->request->getVar("dispatch_from"),
                'dispatch_to' => $this->request->getVar("dispatch_to"),
                'dispatch_doc_no' => $this->request->getVar("dispatch_doc_no"),
                'seller_gstin' => $this->request->getVar("seller_gstin"),
                'seller_state' => $this->request->getVar("seller_state"),
                'seller_code' => $this->request->getVar("seller_code"),
                'buyer_order_no' => $this->request->getVar("buyer_order_no"),
                'buyer_order_date' => $this->request->getVar("buyer_order_date"),
                'amount' => $this->request->getVar("subtotal"),
                'discount' => $this->request->getVar("discount"),
                'tax' => $this->request->getVar("tax_amount"),
                'total' => $this->request->getVar("total"),
                'description' => $this->request->getVar("description"),
                'status' => 'ISSUED'
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
                            'hsn_sac' => $productData['hsn_sac'] ?? '',
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

            if ($this->request->getVar("hdn_invoiceid") == '') {
                $invoiceData['created_by'] = $this->auth->user()->id;

                $invoiceId = $invoiceModel->save_invoice_with_products($invoiceData, $productsData);


                session()->setFlashdata('success_msg', 'Invoice has been created successfully');
            } else {
                $invoiceData['updated_by'] = $this->auth->user()->id;
                $invoiceData['updated_at'] = date('Y-m-d H:i:s');

                $invoiceModel->update($this->request->getVar("hdn_invoiceid"), $invoiceData);

                // Update products - delete existing and insert new
                $this->db->table('invoice_product')->where('invoice_id', $this->request->getVar("hdn_invoiceid"))->delete();

                foreach ($productsData as $product) {
                    $product['invoice_id'] = $this->request->getVar("hdn_invoiceid");
                    $this->db->table('invoice_product')->insert($product);
                }

                session()->setFlashdata('success_msg', 'Invoice has been updated successfully');
            }

            return redirect()->to('Invoice');
        }
    }

    public function generate_number()
    {
        $invoiceModel = new InvoiceModel();
        $invoice_no = $invoiceModel->generate_invoice_number();

        return $this->response->setJSON(['invoice_no' => $invoice_no]);
    }


    public function export_pdf()
    {
        $uri = service('uri');
        $invoice_id = $uri->getSegment(3);

        // if (!$this->auth->check() || !$invoice_id) {
        //     return redirect()->to(site_url('Invoice'));
        // }

        $invoiceModel = new \App\Models\InvoiceModel();
        $invoice_data = $invoiceModel->get_invoice_with_products($invoice_id);

        if (!$invoice_data) {
            //return redirect()->to(site_url('Invoice'));
        }

        // Load TCPDF wrapper (PdfLibrary)
        $pdf = new \App\Libraries\PdfLibrary(
            PDF_PAGE_ORIENTATION,
            PDF_UNIT,
            PDF_PAGE_FORMAT,
            true,
            'UTF-8',
            false
        );

        // Use the generator
        $generator = new \App\Libraries\InvoicePdfGenerator($pdf);

        // Download PDF
        $generator->generate($invoice_data, 'D');
    }


    public function view()
    {
        helper('form');
        $setting = new Setting;
        $uri = service('uri');

        // Check if logged in.
        if (!$this->auth->check()) {
            $redirectURL = session('redirect_url') ?? site_url('/');
            unset($_SESSION['redirect_url']);
            return redirect()->to($redirectURL);
        }
        $current_user = $this->auth->user();
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');

        if ($uri->getSegment(3) == '' || !is_numeric($uri->getSegment(3))) {
            session()->setFlashdata('error_msg', 'Invalid Invoice ID');
            return redirect()->to('Invoice');
        }

        $invoice_id = $uri->getSegment(3);

        $invoiceModel = new InvoiceModel();
        $invoice_data = $invoiceModel->get_invoice_with_products($invoice_id);
        if (!$invoice_data) {
            session()->setFlashdata('error_msg', 'Invoice not found');
            return redirect()->to('Invoice');
        }

        $result['page'] = 'View Invoice';
        $result['controller'] = $uri->getSegment(1);
        $result['segment'] = $uri->getSegment(2);
        $result['data_table_enable'] = 'N';
        $result['chart_enable'] = 'N';
        $result['is_dashboard'] = 'N';
        $result['select2_enable'] = 'N';
        $result['export_enable'] = 'N';
        $result['user_data'] = $current_user;
        $result['invoice_data'] = $invoice_data;
        $result['site_name'] = $setting->site_name;
        return view('invoice/index', $result);
    }

    public function delete_category()
    {
        $uri = service('uri');
        $category_id = $uri->getSegment(3);
        $ProductModel = new ProductModel();

        if ($category_id == '') {
            session()->setFlashdata('error_msg', 'Category ID is required');
            return redirect()->back()->withInput()->with('errors', 'Category ID is required');
        } else {
            $ProductModel->delete_category_data($category_id);
            session()->setFlashdata('success_msg', 'Category has been deleted successfully');
        }

        return redirect()->to('Expenses/category');
    }

    private function convert_number_to_words($number)
    {
        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' Rupees ';
        $dictionary  = array(
            0                   => 'Zero',
            1                   => 'One',
            2                   => 'Two',
            3                   => 'Three',
            4                   => 'Four',
            5                   => 'Five',
            6                   => 'Six',
            7                   => 'Seven',
            8                   => 'Eight',
            9                   => 'Nine',
            10                  => 'Ten',
            11                  => 'Eleven',
            12                  => 'Twelve',
            13                  => 'Thirteen',
            14                  => 'Fourteen',
            15                  => 'Fifteen',
            16                  => 'Sixteen',
            17                  => 'Seventeen',
            18                  => 'Eighteen',
            19                  => 'Nineteen',
            20                  => 'Twenty',
            30                  => 'Thirty',
            40                  => 'Fourty',
            50                  => 'Fifty',
            60                  => 'Sixty',
            70                  => 'Seventy',
            80                  => 'Eighty',
            90                  => 'Ninety',
            100                 => 'Hundred',
            1000                => 'Thousand',
            100000             => 'Lakh',
            10000000           => 'Crore'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . $this->convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[(int)$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = (int)$number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = (int)($number / 100);
                $remainder = (int)$number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
            case $number < 100000:
                $thousands  = (int)($number / 1000);
                $remainder = (int)$number % 1000;
                $string = $this->convert_number_to_words($thousands) . ' ' . $dictionary[1000];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
            case $number < 10000000:
                $lakhs  = (int)($number / 100000);
                $remainder = (int)$number % 100000;
                $string = $this->convert_number_to_words($lakhs) . ' ' . $dictionary[100000];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log((int)$number, 1000)));
                $numBaseUnits = (int) ((int)$number / $baseUnit);
                $remainder = (int)$number % $baseUnit;
                $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $string .= $this->convert_number_to_words($fraction) . ' Paisa';
        }

        return $string;
    }
}
