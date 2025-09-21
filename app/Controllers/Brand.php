<?php

namespace App\Controllers;

use Config\Setting; // Loading config class
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;
use App\Models\BrandModel;
use CodeIgniter\I18n\Time;

class Brand extends BaseController
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

        $result['page'] = 'Brand List';
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
        return view('brand/index', $result);
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

        $BrandModel = new BrandModel();
        $brand_list = $BrandModel->get_all_data();

        $result = [];
        $result['data'] = $brand_list;
        echo json_encode($result);
    }

    public function add_brand()
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

        $result['brand_data'] = [];
        $result['page'] = 'Brand Add';
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
        return view('brand/index', $result);
    }

    public function update_brand()
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


        $brand_id = $uri->getSegment(3);

        if ($brand_id == '') {
            session()->setFlashdata('error_msg', 'Invalid Brand');
            return redirect()->to('Brand');
        }
        $BrandModel = new BrandModel();
        $brand_data = $BrandModel->get_data_by_id($brand_id);
        $result['brand_data'] = $brand_data;


        $result['page'] = 'Brand Update';
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
        return view('brand/index', $result);
    }

    public function save_brand()
    {
        $rules = [
            "brand_name" => "required"
        ];

        $messages = [
            "brand_name" => [
                "required" => "Brand name is required"
            ]
        ];

        if (!$this->validate($rules, $messages)) {

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        } else {
            $BrandModel = new BrandModel();
            $data = [];

            $data['name'] = $this->request->getVar("brand_name");
            $data['description'] = $this->request->getVar("brand_desc");

            if ($this->request->getVar("brand_status") == '') {
                $data['status'] = 'INACTIVE';
            } else {
                $data['status'] = $this->request->getVar("brand_status");
            }



            if ($this->request->getVar("hdn_brand_id") == '') {
                $data['created_by'] = $this->auth->user()->id;
                $BrandModel->save($data);
                session()->setFlashdata('success_msg', 'Brand has been added successfully');
            } else {
                $data['updated_by'] = $this->auth->user()->id;
                $data['updated_at'] = date('Y-m-d H:i:s');
                $BrandModel->update_data($this->request->getVar("hdn_brand_id"), $data);
                session()->setFlashdata('success_msg', 'Brand has been updated successfully');
            }

            return redirect()->to('Brand');
        }
    }

    public function delete_brand()
    {
        $uri = service('uri');
        $brand = $uri->getSegment(3);
        $BrandModel = new BrandModel();

        if ($brand == '') {
            session()->setFlashdata('error_msg', 'Brand ID is required');
            return redirect()->back()->withInput()->with('errors', 'Brand ID is required');
        } else {
            $BrandModel->delete_data($brand);
            session()->setFlashdata('success_msg', 'Brand has been deleted successfully');
        }

        return redirect()->to('Brand');
    }

}
