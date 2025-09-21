<?php

namespace App\Controllers;

use Config\Setting; // Loading config class
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;
use App\Models\ExpenseModel;
use CodeIgniter\I18n\Time;

class Expenses extends BaseController
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

        $result['page'] = 'Expenses List';
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


    public function expense_list()
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

        $ExpenseModel = new ExpenseModel();
        $expense_list = $ExpenseModel->get_list();


        $result = [];
        $result['data'] = $expense_list;
        echo json_encode($result);
    }

    public function add_expense()
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

        $ExpenseModel = new ExpenseModel();
        $category_data = $ExpenseModel->get_category_list();
        $result['category_data'] = $category_data;


        $result['expense_data'] = [];
        $result['page'] = 'Expense Add';
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
        return view('expense/index', $result);
    }

    public function update_expense()
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


        $expense_id = $uri->getSegment(3);

        if ($expense_id == '') {
            session()->setFlashdata('error_msg', 'Invalid Customer');
            return redirect()->to('Customer');
        }
        $ExpenseModel = new ExpenseModel();
        $expense_data = $ExpenseModel->get_data_by_id($expense_id);
        $result['expense_data'] = $expense_data;

        $category_data = $ExpenseModel->get_category_list();
        $result['category_data'] = $category_data;

        $result['page'] = 'Customer Update';
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
        return view('expense/index', $result);
    }

    public function save_expense()
    {
        $rules = [
            "expenses_date" => "required",
            "expenses_category" => "required",
            "expenses_for" => "required",
            "expenses_amount" => "required",
        ];

        $messages = [
            "expenses_date" => [
                "required" => "Expense date is required"
            ],
            "expenses_category" => [
                "required" => "Expense Category is required"
            ],
            "expenses_for" => [
                "required" => "Expense For is required"
            ],
            "expenses_amount" => [
                "required" => "Expense Amount is required"
            ],
        ];

        if (!$this->validate($rules, $messages)) {

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        } else {
            $ExpenseModel = new ExpenseModel();
            $data = [];

            $expense_date = Time::parse($this->request->getVar("expenses_date"));
            $data['expense_date'] = $expense_date->toLocalizedString('yyyy-MM-dd');
            $data['category_id'] = $this->request->getVar("expenses_category");
            $data['expense_for'] = $this->request->getVar("expenses_for");
            $data['expense_amt'] = $this->request->getVar("expenses_amount");
            $data['reference_no'] = $this->request->getVar("expenses_ref_no");
            $data['note'] = $this->request->getVar("expenses_note");

            if ($this->request->getVar("expenses_status") == '') {
                $data['status'] = 'INACTIVE';
            } else {
                $data['status'] = $this->request->getVar("expenses_status");
            }



            if ($this->request->getVar("hdn_expense_id") == '') {
                $data['created_by'] = $this->auth->user()->id;
                $ExpenseModel->save($data);
                session()->setFlashdata('success_msg', 'Expenses has been added successfully');
            } else {
                $data['updated_by'] = $this->auth->user()->id;
                $data['updated_at'] = date('Y-m-d H:i:s');
                $ExpenseModel->update_data($this->request->getVar("hdn_expense_id"), $data);
                session()->setFlashdata('success_msg', 'Expenses has been updated successfully');
            }

            return redirect()->to('Expenses');
        }
    }

    public function view_expense()
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


        $expense_id = $uri->getSegment(3);

        if ($expense_id == '') {
            session()->setFlashdata('error_msg', 'Invalid Customer');
            return redirect()->to('Customer');
        }
        $ExpenseModel = new ExpenseModel();
        $expense_data = $ExpenseModel->get_data_by_id($expense_id);
        $result['expense_data'] = $expense_data;

        $chart_data = $ExpenseModel->get_expenses_by_cat_id($expense_data[0]['category_id']);
        

        $ExpenseChartData = [];
        foreach($chart_data as $key=>$value){
            
            $ExpenseChartData['X'][] = $value->expense_amt;

            $expense_date = Time::parse($value->expense_date);
            $ExpenseChartData['Y'][] = $expense_date->toLocalizedString('MMM-dd');
        }
       
        $category_data = $ExpenseModel->get_category_list();
        $result['category_data'] = $category_data;

        $result['page'] = 'View Expenses';
        $result['controller'] = $uri->getSegment(1);
        $result['segment'] = $uri->getSegment(2);
        $result['data_table_enable'] = 'N';
        $result['chart_enable'] = 'N';
        $result['is_dashboard'] = 'N';
        $result['select2_enable'] = 'Y';
        $result['export_enable'] = 'Y';
        $result['user_data'] = $current_user;
        $result['ExpenseChartData'] = $ExpenseChartData;

        $result['config_detail'] = [];
        $result['site_name'] = $setting->site_name;
        return view('expense/index', $result);
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

        $ExpenseModel = new ExpenseModel();
        $expense_list = $ExpenseModel->get_category_list();


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
        $ExpenseModel = new ExpenseModel();
        $category_data = $ExpenseModel->get_cat_data_by_id($category_id);
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
            $ExpenseModel = new ExpenseModel();
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
                $ExpenseModel->insert_category_data($data);
                session()->setFlashdata('success_msg', 'Category has been added successfully');
            } else {
                $data['updated_by'] = $this->auth->user()->id;
                $data['updated_at'] = date('Y-m-d H:i:s');
                $ExpenseModel->update_category_data($this->request->getVar("hdn_categoryid"), $data);
                session()->setFlashdata('success_msg', 'Category has been updated successfully');
            }

            return redirect()->to('Expenses/category');
        }
    }


    public function delete_category()
    {
        $uri = service('uri');
        $category_id = $uri->getSegment(3);
        $ExpenseModel = new ExpenseModel();

        if ($category_id == '') {
            session()->setFlashdata('error_msg', 'Category ID is required');
            return redirect()->back()->withInput()->with('errors', 'Category ID is required');
        } else {
            $ExpenseModel->delete_category_data($category_id);
            session()->setFlashdata('success_msg', 'Category has been deleted successfully');
        }

        return redirect()->to('Expenses/category');
    }
}
