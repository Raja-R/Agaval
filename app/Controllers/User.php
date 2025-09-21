<?php

namespace App\Controllers;

use Config\Setting; // Loading config class
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;
use App\Models\PermissionsModel;
use App\Models\PermissionModel;
use App\Models\RoleModel;
use App\Models\UsersModel;

class User extends BaseController
{
  protected $auth;

  /**
   * @var AuthConfig
   */
  protected $config;

  /**
   * @var Session
   */
  public $session;

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


    $RoleModel = new RoleModel();
    $role_list = $RoleModel->get_all_data();

    $uri = service('uri');
    $result['controller'] = $uri->getSegment(1);
    $result['segment'] = $uri->getSegment(2);
    $result['user_permission'] = session('user_permission');
    $result['data_table_enable'] = 'Y';
    $result['chart_enable'] = 'Y';
    $result['is_dashboard'] = 'N';
    $result['select2_enable'] = 'Y';
    $result['export_enable'] = 'Y';

    $result['role_data'] = $role_list;
    $result['user_data'] = $current_user;
    $result['site_name'] = $setting->site_name;
    return view('user/index', $result);
  }

  public function user_list()
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

    $UsersModel = new UsersModel();
    $user_list = $UsersModel->get_all_data();

    $result = [];
    $result['data'] = $user_list;
    echo json_encode($result);
  }

  public function add_user()
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


    $RoleModel = new RoleModel();
    $role_list = $RoleModel->get_all_data();
    $result['role_list'] = $role_list;


    $result['page'] = 'User Add';
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
    return view('user/index', $result);
  }


  public function role()
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


    $RoleModel = new RoleModel();
    $role_list = $RoleModel->get_all_data();
    $result['role_list'] = $role_list;


    $result['page'] = 'Roles List';
    $result['controller'] = $uri->getSegment(1);
    $result['segment'] = $uri->getSegment(2);
    $result['data_table_enable'] = 'Y';
    $result['chart_enable'] = 'N';
    $result['is_dashboard'] = 'N';
    $result['select2_enable'] = 'Y';
    $result['export_enable'] = 'Y';
    $result['user_data'] = $current_user;
    $result['site_name'] = $setting->site_name;
    return view('user/index', $result);
  }


  public function role_permission()
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


    $RoleModel = new RoleModel();
    $role_list = $RoleModel->get_all_data();
    $result['role_list'] = $role_list;


    $PermissionModel = new PermissionsModel();
    $permission_list = $PermissionModel->get_all_data();

    $result['permission_list'] = json_decode(json_encode($permission_list), true);

    $result['page'] = 'Roles Permission';
    $result['controller'] = $uri->getSegment(1);
    $result['segment'] = $uri->getSegment(2);
    $result['data_table_enable'] = 'Y';
    $result['chart_enable'] = 'N';
    $result['is_dashboard'] = 'N';
    $result['select2_enable'] = 'Y';
    $result['export_enable'] = 'Y';
    $result['user_data'] = $current_user;
    $result['site_name'] = $setting->site_name;
    return view('user/index', $result);
  }

  public function permission()
  {
    helper('form');
    $uri = service('uri');

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

    $result['page'] = 'Permissions List';
    $result['controller'] = $uri->getSegment(1);
    $result['segment'] = $uri->getSegment(2);
    $result['data_table_enable'] = 'Y';
    $result['chart_enable'] = 'N';
    $result['is_dashboard'] = 'N';
    $result['select2_enable'] = 'Y';
    $result['export_enable'] = 'Y';
    $result['user_data'] = $current_user;
    $result['site_name'] = $setting->site_name;
    return view('user/index', $result);
  }

  public function add_permission()
  {
    $rules = [
      "permission_name" => "required|is_unique[auth_permissions.name]|min_length[3]",
      "permission_desc" => "required",
    ];

    $messages = [
      "permission_name" => [
        "required" => "Name is required",
        "is_unique" => "Permission Name is already exists"
      ],
      "permission_desc" => [
        "required" => "Description is required"
      ],
    ];

    if (!$this->validate($rules, $messages)) {

      if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
      }
    } else {
      $PermissionModel = new PermissionsModel();

      $data['name'] = $this->request->getVar("permission_name");
      $data['description'] = $this->request->getVar("permission_desc");
      $PermissionModel->save($data);

      return redirect()->to('User/permission');
    }
  }

  public function permission_list()
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

    $PermissionModel = new PermissionsModel();
    $permission_list = $PermissionModel->get_all_data();

    $result = [];
    $result['data'] = $permission_list;
    echo json_encode($result);
  }

  public function add_role()
  {

    $rules = [
      "role_name" => "required|is_unique[auth_groups.name]|min_length[3]",
      "role_desc" => "required",
    ];

    $messages = [
      "role_name" => [
        "required" => "Name is required",
        "is_unique" => "Role Name is already exists"
      ],
      "role_desc" => [
        "required" => "Description is required"
      ],
    ];

    if (!$this->validate($rules, $messages)) {

      if (!$this->validate($rules)) {
        session()->setFlashdata('error_msg', json_encode($this->validator->getErrors()));
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
      }
    } else {
      $RoleModel = new RoleModel();

      $data['name'] = $this->request->getVar("role_name");
      $data['description'] = $this->request->getVar("role_desc");
      $role_id = $RoleModel->insert_data($data);

      $permission_role = [];

      $permission_data = [];
      if (count($_POST['permission_read']) >= count($_POST['permission_create']) && count($_POST['permission_read']) >= count($_POST['permission_edit']) && count($_POST['permission_read']) >= count($_POST['permission_del'])) {
        $permission_data = $_POST['permission_read'];
      } else if (count($_POST['permission_create']) >= count($_POST['permission_read']) && count($_POST['permission_create']) >= count($_POST['permission_edit']) && count($_POST['permission_create']) >= count($_POST['permission_del'])) {
        $permission_data = $_POST['permission_create'];
      } else if (count($_POST['permission_edit']) >= count($_POST['permission_read']) && count($_POST['permission_edit']) >= count($_POST['permission_create']) && count($_POST['permission_edit']) >= count($_POST['permission_del'])) {
        $permission_data = $_POST['permission_edit'];
      } else {
        $permission_data = $_POST['permission_del'];
      }

      foreach ($permission_data as $key => $value) {
        $permission_role[$key]['read_module'] = $_POST['permission_read'][$key];
        $permission_role[$key]['create_module'] = $_POST['permission_create'][$key];
        $permission_role[$key]['update_module'] = $_POST['permission_edit'][$key];
        $permission_role[$key]['delete_module'] = $_POST['permission_del'][$key];
        $permission_role[$key]['group_id'] = $role_id;
        $permission_role[$key]['permission_id'] = $key;
        $permission_role[$key]['created_by'] = $this->auth->user()->id;
      }

      foreach ($permission_role as $key => $data) {
        $RoleModel->insert_permission_data($data);
      }

      session()->setFlashdata('success_msg', 'Role has been added successfully');

      return redirect()->to('User/role');
    }
  }

  public function role_list()
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

    $RoleModel = new RoleModel();
    $role_list = $RoleModel->get_all_data();

    $result = [];
    $result['data'] = $role_list;
    echo json_encode($result);
  }
}
