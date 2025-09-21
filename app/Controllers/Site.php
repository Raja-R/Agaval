<?php

namespace App\Controllers;

use Config\Setting; // Loading config class
use Myth\Auth\Config\Auth as AuthConfig;
use App\Models\RoleModel;
use App\Models\SiteModel;
use App\Models\TaxModel;
use App\Models\UnitModel;
use CodeIgniter\I18n\Time;

class Site extends BaseController
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

        helper('form');
        $setting = new Setting;
        $result['site_name'] = $setting->site_name;

        $current_user = $this->auth->user();
        $result['user_data'] = $current_user;
        $result['page'] = 'Application Setting';
        $result['controller'] = '';
        $result['segment'] = '';
        $result['data_table_enable'] = 'N';
        $result['chart_enable'] = 'N';
        $result['is_dashboard'] = 'N';
        $result['select2_enable'] = 'Y';
        $result['export_enable'] = 'N';

        $SiteModel = new SiteModel();
        $config_detail = $SiteModel->get_all_data();

        $result['config_detail'] = $config_detail[0];

        return view('setting/index', $result);
    }

    public function profile()
    {
        helper('form');
        $uri = service('uri');
        $setting = new Setting;
        $result['site_name'] = $setting->site_name;

        $current_user = $this->auth->user();
        $result['user_data'] = $current_user;

        $result['controller'] = $uri->getSegment(1);
        $result['segment'] = $uri->getSegment(2);
        $result['page'] = 'Application Profile';
        $result['data_table_enable'] = 'Y';
        $result['chart_enable'] = 'Y';
        $result['is_dashboard'] = 'N';
        $result['select2_enable'] = 'Y';
        $result['export_enable'] = 'Y';

        return view('setting/index', $result);
    }

    public function tax()
    {
        helper('form');
        $uri = service('uri');
        $setting = new Setting;
        $result['site_name'] = $setting->site_name;

        $current_user = $this->auth->user();
        $result['user_data'] = $current_user;

        $TaxModel = new TaxModel();
        $tax_list = $TaxModel->get_all_data();
        $result['tax_list'] = $tax_list;

        $result['controller'] = $uri->getSegment(1);
        $result['segment'] = $uri->getSegment(2);
        $result['page'] = 'Application Tax';
        $result['data_table_enable'] = 'Y';
        $result['chart_enable'] = 'N';
        $result['is_dashboard'] = 'N';
        $result['select2_enable'] = 'Y';
        $result['export_enable'] = 'N';

        return view('setting/index', $result);
    }

    public function units()
    {
        helper('form');
        $uri = service('uri');
        $setting = new Setting;
        $result['site_name'] = $setting->site_name;

        $current_user = $this->auth->user();
        $result['user_data'] = $current_user;

        $TaxModel = new TaxModel();
        $tax_list = $TaxModel->get_all_data();
        $result['tax_list'] = $tax_list;

        $result['controller'] = $uri->getSegment(1);
        $result['segment'] = $uri->getSegment(2);
        $result['page'] = 'Application Unit';
        $result['data_table_enable'] = 'Y';
        $result['chart_enable'] = 'N';
        $result['is_dashboard'] = 'N';
        $result['select2_enable'] = 'Y';
        $result['export_enable'] = 'N';

        return view('setting/index', $result);
    }

    public function update_setting()
    {
        $rules = [
            "site_name" => "required|min_length[3]",
            "site_copyright" => "required",
        ];

        $messages = [
            "site_name" => [
                "required" => "Name is required",
            ],
            "site_copyright" => [
                "required" => "Copyright is required"
            ],
        ];

        if (!$this->validate($rules, $messages)) {

            if (!$this->validate($rules)) {
                session()->setFlashdata('error_msg', json_encode($this->validator->getErrors()));
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        } else {
            $SiteModel = new SiteModel();


            $data['site_name'] = $this->request->getVar("site_name");
            $data['support_no'] = $this->request->getVar("support_number");
            $data['support_email'] = $this->request->getVar("support_email");
            $data['copy_right'] = $this->request->getVar("site_copyright");
            $data['prefix_category'] = $this->request->getVar("prefix_category");
            $data['prefix_product'] = $this->request->getVar("prefix_product");
            $data['prefix_sale'] = $this->request->getVar("prefix_sale");
            $data['prefix_purchase'] = $this->request->getVar("prefix_purchase");
            $data['prefix_brand'] = $this->request->getVar("prefix_brand");
            $data['prefix_supplier'] = $this->request->getVar("prefix_supplier");
            $data['prefix_invoice'] = $this->request->getVar("prefix_invoice");
            $data['prefix_expense'] = $this->request->getVar("prefix_expense");



            $config_all_data = $SiteModel->get_all_data();

            if ($config_all_data > 0) {
                $data['updated_at'] = date('Y-m-d H:i:s');
                $data['updated_by'] = $this->auth->user()->id;
                $SiteModel->update_data($config_all_data[0]->id, $data);
            } else {
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = $this->auth->user()->id;
                $SiteModel->save($data);
            }

            $imageFile = $this->request->getFile('site_logo');
            if ($imageFile->getClientMimeType() != '') {
                $newName = 'LOGO_' . time() . '.' . $imageFile->getClientExtension();
                $imageFile->move(WRITEPATH . 'uploads', $newName);
                $logo_image = [
                    'image' => $newName,
                    'file'  => $imageFile->getClientMimeType(),
                    'ext'  => $imageFile->getClientExtension()
                ];

                $data = [];
                $data['site_logo'] = json_encode($logo_image);
                $data['updated_by'] = date('Y-m-d H:i:s');
                $SiteModel->update_data($config_all_data[0]->id, $data);
            }

            $imageFile = $this->request->getFile('site_favicon');
            if ($imageFile->getClientMimeType() != '') {
                $newName = 'FAVICON_' . time() . '.' . $imageFile->getClientExtension();
                $imageFile->move(WRITEPATH . 'uploads', $newName);
                $logo_image = [
                    'image' => $newName,
                    'file'  => $imageFile->getClientMimeType(),
                    'ext'  => $imageFile->getClientExtension()
                ];

                $data = [];
                $data['site_favicon'] = json_encode($logo_image);
                $data['updated_by'] = date('Y-m-d H:i:s');
                $SiteModel->update_data($config_all_data[0]->id, $data);
            }

            session()->setFlashdata('success_msg', 'Site Configuration has been updated successfully');

            return redirect()->to('Site');
        }
    }

    public function update_profile()
    {
        $rules = [
            "app_name" => "required|min_length[3]"
        ];

        $messages = [
            "app_name" => [
                "required" => "Name is required",
            ]
        ];

        if (!$this->validate($rules, $messages)) {

            if (!$this->validate($rules)) {
                session()->setFlashdata('error_msg', json_encode($this->validator->getErrors()));
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        } else {
            $SiteModel = new SiteModel();

            $data = [];

            if (!empty($this->request->getVar("app_name"))) {
                service('settings')->set('App.companyName', $this->request->getVar("app_name"));
            }
            if (!empty($this->request->getVar("app_mobile"))) {
                service('settings')->set('App.companyMobile', $this->request->getVar("app_mobile"));
            }

            if (!empty($this->request->getVar("app_phone"))) {
                service('settings')->set('App.companyPhone', $this->request->getVar("app_phone"));
            }
            if (!empty($this->request->getVar("app_email"))) {
                service('settings')->set('App.companyEmail', $this->request->getVar("app_email"));
            }
            if (!empty($this->request->getVar("app_bank"))) {
                service('settings')->set('App.companyBank', $this->request->getVar("app_bank"));
            }

            if (!empty($this->request->getVar("app_gst_no"))) {
                service('settings')->set('App.companyGstno', $this->request->getVar("app_gst_no"));
            }
            if (!empty($this->request->getVar("app_pan_no"))) {
                service('settings')->set('App.companyPanno', $this->request->getVar("app_pan_no"));
            }
            if (!empty($this->request->getVar("app_upi_id"))) {
                service('settings')->set('App.companyUpiID', $this->request->getVar("app_upi_id"));
            }
            if (!empty($this->request->getVar("app_address"))) {
                service('settings')->set('App.companyAddress', $this->request->getVar("app_address"));
            }

            if (!empty($this->request->getVar("app_post_code"))) {
                service('settings')->set('App.companyPostCode', $this->request->getVar("app_post_code"));
            }


            session()->setFlashdata('success_msg', 'Company Profile has been updated successfully');

            return redirect()->to('Site/profile');
        }
    }

    public function add_tax()
    {
        $rules = [
            "tax_name" => "required|min_length[3]",
            "tax_percentage" => "required",
        ];

        $messages = [
            "tax_name" => [
                "required" => "Name is required",
            ],
            "tax_percentage" => [
                "required" => "Percentage is required"
            ],
        ];

        if (!$this->validate($rules, $messages)) {

            if (!$this->validate($rules)) {
                session()->setFlashdata('error_msg', json_encode($this->validator->getErrors()));
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        } else {
            $TaxModel = new TaxModel();


            $data['name'] = $this->request->getVar("tax_name");
            $data['percentage'] = $this->request->getVar("tax_percentage");
            $data['reg_no'] = $this->request->getVar("tax_reg_no");

            if (empty($this->request->getVar("default_tax"))) {
                $data['default_tax'] = 'NO';
            } else {
                $data['default_tax'] = $this->request->getVar("default_tax");
            }

            if (empty($this->request->getVar("tax_status"))) {
                $data['status'] = 'INACTIVE';
            } else {
                $data['status'] = $this->request->getVar("tax_status");
            }


            if ($this->request->getVar("hdn_tax_id") != '') {
                $data['updated_by'] = $this->auth->user()->id;
                $data['updated_at'] = date('Y-m-d H:i:s');
                $TaxModel->update_data($this->request->getVar("hdn_tax_id"), $data);
            } else {
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = $this->auth->user()->id;
                $tax_id = $TaxModel->save($data);
            }

            // if (!empty($this->request->getVar("default_tax"))) {
            //     $data = [];
            //     $data['default_tax'] = 'NO';
            //     $data['updated_by'] = $this->auth->user()->id;
            //     $data['updated_at'] = date('Y-m-d H:i:s');

            //     $TaxModel->update_default_tax($this->auth->user()->id, $data);
            // }

            if ($this->request->getVar("hdn_tax_id") != '') {
                session()->setFlashdata('success_msg', 'Tax has been updated successfully');
            } else {
                session()->setFlashdata('success_msg', 'Tax has been added successfully');
            }

            return redirect()->to('Site/tax');
        }
    }

    public function add_unit()
    {
        $rules = [
            "unit_name" => "required|min_length[2]",
            "unit_description" => "required",
        ];

        $messages = [
            "unit_name" => [
                "required" => "Name is required",
            ],
            "unit_description" => [
                "required" => "Description is required"
            ],
        ];

        if (!$this->validate($rules, $messages)) {

            if (!$this->validate($rules)) {
                session()->setFlashdata('error_msg', json_encode($this->validator->getErrors()));
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        } else {
            $UnitModel = new UnitModel();


            $data['name'] = $this->request->getVar("unit_name");
            $data['description'] = $this->request->getVar("unit_description");

            if (empty($this->request->getVar("unit_status"))) {
                $data['status'] = 'INACTIVE';
            } else {
                $data['status'] = $this->request->getVar("unit_status");
            }


            if ($this->request->getVar("hdn_unit_id") != '') {
                $data['updated_by'] = $this->auth->user()->id;
                $data['updated_at'] = date('Y-m-d H:i:s');
                $UnitModel->update_data($this->request->getVar("hdn_unit_id"), $data);
            } else {
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = $this->auth->user()->id;
                $tax_id = $UnitModel->save($data);
            }


            if ($this->request->getVar("hdn_unit_id") != '') {
                session()->setFlashdata('success_msg', 'Unit has been updated successfully');
            } else {
                session()->setFlashdata('success_msg', 'Unit has been added successfully');
            }

            return redirect()->to('Site/units');
        }
    }

    public function tax_list()
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

        $TaxModel = new TaxModel();
        $tax_list = $TaxModel->get_all_data();

        $result = [];
        $result['data'] = $tax_list;
        echo json_encode($result);
    }

    public function unit_list()
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

        $UnitModel = new UnitModel();
        $unit_list = $UnitModel->get_all_data();

        $result = [];
        $result['data'] = $unit_list;
        echo json_encode($result);
    }



    public function view_tax()
    {
        $rules = [
            "tax_id" => "required",
        ];

        $messages = [
            "tax_id" => [
                "required" => "Tax ID is required",
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            if (!$this->validate($rules)) {
                //echo json_encode($this->validator->getErrors());

                $response = [
                    'status' => 500,
                    'error' => true,
                    'message' => $messages,
                    'data' => []
                ];
                echo json_encode($response);
            }
        } else {
            helper('form');
            $setting = new Setting;

            $tax_id = $this->request->getVar("tax_id");

            // is already logged in.
            if (!$this->auth->check()) {
                $redirectURL = session('redirect_url') ?? site_url('/');
                // Set a return URL if none is specified
                $_SESSION['redirect_url'] = $redirectURL;
                unset($_SESSION['redirect_url']);

                $response = [
                    'status' => 500,
                    'error' => true,
                    'message' => 'session expired',
                    'data' => []
                ];
                echo json_encode($response);
            }
            // Set a return URL if none is specified
            $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');

            $TaxModel = new TaxModel();
            $tax_data = $TaxModel->get_data_by_id($tax_id);
            $tax_data = json_decode(json_encode($tax_data), true);

            // Locale: en
            $time = Time::parse($tax_data[0]['created_at']);
            $data = [];
            $data['name'] = $tax_data[0]['name'];
            $data['percentage'] = floatval($tax_data[0]['percentage']) . '%';
            $data['reg_no'] = $tax_data[0]['reg_no'];
            $data['status'] = ucfirst(strtolower($tax_data[0]['status']));
            $data['default_tax'] = ucfirst(strtolower($tax_data[0]['default_tax']));
            $data['created_at'] = $time->toLocalizedString('MMM d, yyyy');

            $response = [
                'status' => 200,
                'error' => false,
                'message' => '',
                'data' => $data
            ];
            echo json_encode($response);
        }
    }

    public function view_unit()
    {
        $rules = [
            "unit_id" => "required",
        ];

        $messages = [
            "unit_id" => [
                "required" => "Unit ID is required",
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            if (!$this->validate($rules)) {
                //echo json_encode($this->validator->getErrors());

                $response = [
                    'status' => 500,
                    'error' => true,
                    'message' => $messages,
                    'data' => []
                ];
                echo json_encode($response);
            }
        } else {
            helper('form');
            $setting = new Setting;

            $unit_id = $this->request->getVar("unit_id");

            // is already logged in.
            if (!$this->auth->check()) {
                $redirectURL = session('redirect_url') ?? site_url('/');
                // Set a return URL if none is specified
                $_SESSION['redirect_url'] = $redirectURL;
                unset($_SESSION['redirect_url']);

                $response = [
                    'status' => 500,
                    'error' => true,
                    'message' => 'session expired',
                    'data' => []
                ];
                echo json_encode($response);
            }
            // Set a return URL if none is specified
            $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');

            $UnitModel = new UnitModel();
            $unit_data = $UnitModel->get_data_by_id($unit_id);
            $unit_data = json_decode(json_encode($unit_data), true);

            // Locale: en
            $time = Time::parse($unit_data[0]['created_at']);
            $data = [];
            $data['name'] = $unit_data[0]['name'];
            $data['description'] = $unit_data[0]['description'];
            $data['status'] = ucfirst(strtolower($unit_data[0]['status']));
            $data['created_at'] = $time->toLocalizedString('MMM d, yyyy');

            $response = [
                'status' => 200,
                'error' => false,
                'message' => '',
                'data' => $data
            ];
            echo json_encode($response);
        }
    }

    public function delete_tax()
    {
        $rules = [
            "tax_id" => "required",
        ];

        $messages = [
            "tax_id" => [
                "required" => "Tax ID is required",
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            if (!$this->validate($rules)) {
                //echo json_encode($this->validator->getErrors());

                $response = [
                    'status' => 500,
                    'error' => true,
                    'message' => $messages,
                    'data' => []
                ];
                echo json_encode($response);
            }
        } else {
            helper('form');
            $setting = new Setting;

            $tax_id = $this->request->getVar("tax_id");

            // is already logged in.
            if (!$this->auth->check()) {
                $redirectURL = session('redirect_url') ?? site_url('/');
                unset($_SESSION['redirect_url']);
                // Set a return URL if none is specified
                $_SESSION['redirect_url'] = $redirectURL;
                $response = [
                    'status' => 500,
                    'error' => true,
                    'message' => 'session expired',
                    'data' => []
                ];
                echo json_encode($response);
            }

            // Set a return URL if none is specified
            $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');

            $TaxModel = new TaxModel();
            $tax_data = $TaxModel->get_data_by_id($tax_id);
            $tax_data = json_decode(json_encode($tax_data), true);

            if (count($tax_data) > 0) {
                $TaxModel->delete_data($tax_id);
                $response = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Tax record has been deleted successully.',
                    'data' => []
                ];
                echo json_encode($response);
            } else {
                $response = [
                    'status' => 500,
                    'error' => true,
                    'message' => 'Invalid tax id',
                    'data' => []
                ];
                echo json_encode($response);
            }
        }
    }
}
