<?php

namespace App\Controllers;

use Config\Setting; // Loading config class
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;
use App\Models\CustomerModel;

class Suppliers extends BaseController
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

        $result['page'] = 'Supplier List';
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
        return view('supplier/index', $result);
    }


    public function customer_list()
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

        $CustomerModel = new CustomerModel();
        $customer_list = $CustomerModel->get_customer_data('SUPPLIER');

        $result = [];
        $result['data'] = $customer_list;
        echo json_encode($result);
    }

    public function add_customer()
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

        $result['customer_data'] = [];
        $result['page'] = 'Supplier Add';
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
        return view('supplier/index', $result);
    }

    public function update_customer()
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


        $customer_id = $uri->getSegment(3);

        if($customer_id==''){
            session()->setFlashdata('error_msg', 'Invalid Customer');
            return redirect()->to('Customer');
        }
        $CustomerModel = new CustomerModel();
        $customer_data = $CustomerModel->get_data_by_id($customer_id);
        $result['customer_data'] = $customer_data;


        $result['page'] = 'Supplier Update';
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
        return view('supplier/index', $result);
    }

    public function save_customer()
    {

        $rules = [
            "customer_name" => "required|min_length[3]"
        ];

        $messages = [
            "customer_name" => [
                "required" => "Customer Name is required"
            ],
        ];

        if (!$this->validate($rules, $messages)) {

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        } else {
            $CustomerModel = new CustomerModel();

            $data['name'] = $this->request->getVar("customer_name");
            $data['mobile'] = $this->request->getVar("customer_mobile");
            $data['email'] = $this->request->getVar("customer_email");
            $data['phone'] = $this->request->getVar("customer_phone");
            $data['gst_no'] = $this->request->getVar("customer_gst");
            $data['tax_no'] = $this->request->getVar("customer_tax");
            $data['address'] = $this->request->getVar("customer_address");
            $data['city'] = $this->request->getVar("customer_city");
            $data['state'] = $this->request->getVar("customer_state");
            $data['country'] = $this->request->getVar("customer_country");
            $data['postcode'] = $this->request->getVar("customer_postcode");
            $data['type'] = 'SUPPLIER';
            $data['module'] = 'PURCHASE';

            if ($this->request->getVar("hdn_customerid") == '') {
                $data['created_by'] = $this->auth->user()->id;
                $CustomerModel->save($data);
                session()->setFlashdata('success_msg', 'Supplier has been added successfully');
            } else {
                $data['updated_by'] = $this->auth->user()->id;
                $data['updated_at'] = date('Y-m-d H:i:s');
                $CustomerModel->update_data($this->request->getVar("hdn_customerid"), $data);
                session()->setFlashdata('success_msg', 'Supplier has been updated successfully');
            }



            return redirect()->to('Suppliers');
        }
    }

    public function view_customer()
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


        $customer_id = $uri->getSegment(3);

        if($customer_id==''){
            session()->setFlashdata('error_msg', 'Invalid Customer');
            return redirect()->to('Suppliers');
        }
        $CustomerModel = new CustomerModel();
        $customer_data = $CustomerModel->get_data_by_id($customer_id);
       
        $result['customer_data'] = $customer_data[0];


        $result['page'] = 'Supplier View';
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
        return view('supplier/index', $result);
    }

    public function delete_customer()
    {
        $uri = service('uri');
        $customer_id = $uri->getSegment(3);
        $CustomerModel = new CustomerModel();

        if ($customer_id == '') {
            session()->setFlashdata('error_msg', 'Customer ID is required');
            return redirect()->back()->withInput()->with('errors', 'Customer ID is required');
            
        } else {
            $CustomerModel->delete_data($customer_id);
            session()->setFlashdata('success_msg', 'Supplier has been deleted successfully');
        }

        return redirect()->to('Suppliers');
    }
}
