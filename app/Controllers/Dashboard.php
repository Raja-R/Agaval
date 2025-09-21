<?php

namespace App\Controllers;
use Config\Setting; // Loading config class
use Myth\Auth\Config\Auth as AuthConfig;


class Dashboard extends BaseController
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

        $setting = new Setting;
        $result['site_name'] = $setting->site_name;

        $current_user = $this->auth->user();
        $result['user_data'] = $current_user;

        $result['controller'] = '';
        $result['segment'] = '';
        $result['data_table_enable'] = 'Y';
        $result['chart_enable'] = 'Y';
        $result['is_dashboard'] = 'N';
        $result['select2_enable'] = 'Y';
        $result['export_enable'] = 'Y';

        $result['site_name'] = $setting->site_name;
        return view('dashboard',$result);
    }
}
