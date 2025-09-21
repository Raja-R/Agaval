<?php

namespace App\Controllers;

use Config\Setting; // Loading config class
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;
use App\Models\CategoryModel;
use CodeIgniter\I18n\Time;

class Category extends BaseController
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

        $result['page'] = 'Category List';
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
        return view('category/index', $result);
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

        $CategoryModel = new CategoryModel();
        $category_list = $CategoryModel->get_all_data();

        $result = [];
        $result['data'] = $category_list;
        echo json_encode($result);
    }

    public function add_category()
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

        $result['category_data'] = [];
        $result['page'] = 'Category Add';
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
        return view('category/index', $result);
    }

    public function update_category()
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


        $category_id = $uri->getSegment(3);

        if ($category_id == '') {
            session()->setFlashdata('error_msg', 'Invalid Category');
            return redirect()->to('Category');
        }
        $CategoryModel = new CategoryModel();
        $category_data = $CategoryModel->get_data_by_id($category_id);
        $result['category_data'] = $category_data;


        $result['page'] = 'Category Update';
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
        return view('category/index', $result);
    }

    public function save_category()
    {
        $rules = [
            "category_name" => "required"
        ];

        $messages = [
            "category_name" => [
                "required" => "Category name is required"
            ]
        ];

        if (!$this->validate($rules, $messages)) {

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        } else {
            $CategoryModel = new CategoryModel();
            $data = [];

            $data['name'] = $this->request->getVar("category_name");
            $data['description'] = $this->request->getVar("category_desc");

            if ($this->request->getVar("category_status") == '') {
                $data['status'] = 'INACTIVE';
            } else {
                $data['status'] = $this->request->getVar("category_status");
            }



            if ($this->request->getVar("hdn_category_id") == '') {
                $data['created_by'] = $this->auth->user()->id;
                $CategoryModel->save($data);
                session()->setFlashdata('success_msg', 'Category has been added successfully');
            } else {
                $data['updated_by'] = $this->auth->user()->id;
                $data['updated_at'] = date('Y-m-d H:i:s');
                $CategoryModel->update_data($this->request->getVar("hdn_category_id"), $data);
                session()->setFlashdata('success_msg', 'Category has been updated successfully');
            }

            return redirect()->to('Category');
        }
    }

    public function delete_category()
    {
        $uri = service('uri');
        $category = $uri->getSegment(3);
        $CategoryModel = new CategoryModel();

        if ($category == '') {
            session()->setFlashdata('error_msg', 'Category ID is required');
            return redirect()->back()->withInput()->with('errors', 'Category ID is required');
        } else {
            $CategoryModel->delete_data($category);
            session()->setFlashdata('success_msg', 'Category has been deleted successfully');
        }

        return redirect()->to('Category');
    }

}
