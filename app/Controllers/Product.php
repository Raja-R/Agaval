<?php

namespace App\Controllers;

use Config\Setting; // Loading config class
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;
use App\Models\ProductModel;
use CodeIgniter\I18n\Time;

class Product extends BaseController
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

        $result['page'] = 'Product List';
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
        return view('product/index', $result);
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
            $ProductModel = new ProductModel();
            $product_list = $ProductModel->get_list();

            $result = ['data' => $product_list];

            return $this->response->setJSON($result);
        } catch (\Exception $e) {
            log_message('error', '[ProductController] ' . $e->getMessage());
            // Return the actual error message for debugging
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function add_product()
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

        $ProductModel = new ProductModel();
        $category_data = $ProductModel->get_category_list();
        $result['category_data'] = $category_data;

        $brand_data = $ProductModel->get_brand_list();
        $result['brand_data'] = $brand_data;

        $result['expense_data'] = [];
        $result['page'] = 'Product Add';
        $result['controller'] = $uri->getSegment(1);
        $result['segment'] = $uri->getSegment(2);
        $result['data_table_enable'] = 'N';
        $result['chart_enable'] = 'N';
        $result['is_dashboard'] = 'N';
        $result['select2_enable'] = 'Y';
        $result['export_enable'] = 'Y';
        $result['user_data'] = $current_user;
        $result['config_detail'] = [];
        $result['site_name'] = $setting->site_name;
        return view('product/index', $result);
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
            "code" => "required",
            "purchase_price" => "required|numeric|greater_than[0]",
            "sales_price" => "required|numeric|greater_than[0]",
            "category_id" => "required|numeric",
        ];

        $messages = [
            "name" => [
                "required" => "Product Name is required",
                "min_length" => "Product Name must be at least 3 characters"
            ],
            "code" => [
                "required" => "Product Code is required"
            ],
            "purchase_price" => [
                "required" => "Product Purchase Price is required",
                "numeric" => "Purchase Price must be a valid number",
                "greater_than" => "Purchase Price must be greater than 0"
            ],
            "sales_price" => [
                "required" => "Product Sales Price is required",
                "numeric" => "Sales Price must be a valid number",
                "greater_than" => "Sales Price must be greater than 0"
            ],
            "category_id" => [
                "required" => "Category is required",
                "numeric" => "Invalid category selected"
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        } else {
            $ProductModel = new ProductModel();
            $data = [
                'name' => $this->request->getVar("name"),
                'code' => $this->request->getVar("code"),
                'purchase_price' => $this->request->getVar("purchase_price"),
                'sales_price' => $this->request->getVar("sales_price"),
                'category_id' => $this->request->getVar("category_id"),
                'brand_id' => $this->request->getVar("brand_id"),
                'stock' => $this->request->getVar("stock") ?? 0,
                'min_order_qty' => $this->request->getVar("min_order_qty") ?? 1,
                'hsn_sac_code' => $this->request->getVar("hsn_sac_code"),
                'product_type' => $this->request->getVar("product_type") ?? 'SALES',
                'description' => $this->request->getVar("description"),
                'status' => $this->request->getVar("status") ?? 'ACTIVE',
            ];

            // Handle file upload for product image
            $productImage = $this->request->getFile('product_image');
            if ($productImage && $productImage->isValid() && !$productImage->hasMoved()) {
                $newName = $productImage->getRandomName();
                $uploadPath = WRITEPATH . 'uploads/products/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                $productImage->move($uploadPath, $newName);
                $data['image'] = $newName;
            }

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

    public function delete_product()
    {
        $uri = service('uri');
        $product_id = $uri->getSegment(3);

        if (!$product_id || !is_numeric($product_id)) {
            session()->setFlashdata('error_msg', 'Invalid Product ID');
            return redirect()->to('Product');
        }

        $ProductModel = new ProductModel();

        if (!$ProductModel->find($product_id)) {
            session()->setFlashdata('error_msg', 'Product not found');
            return redirect()->to('Product');
        }

        $ProductModel->delete($product_id);
        session()->setFlashdata('success_msg', 'Product has been deleted successfully');

        return redirect()->to('Product');
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
}
