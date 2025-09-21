<?php

namespace App\Controllers;
use Config\Setting; // Loading config class
use App\Models\UserModel;
use App\Models\GenerateQRModel;
use App\Models\AttendanceModel;

class Participant extends BaseController
{

    public function index()
    {
        helper('form');
        $setting = new Setting;
        $userModel = new UserModel();
        $GenerateQRModel = new GenerateQRModel();
        $AttendanceModel = new AttendanceModel();

        $user_data = $userModel->get_all_data();
        $token_data = $GenerateQRModel->get_all_data();
        $scanned_token_data = $AttendanceModel->get_all_data();
        $user_data = json_decode(json_encode($user_data), true);
        $data = [];
        foreach ($user_data as $key => $value) {
            $attendance = $userModel->get_user_attendance($value['id']);
            $data[$key]['first_name'] = $value['first_name'];
            $data[$key]['last_name'] = $value['last_name'];
            $data[$key]['count'] = count($attendance);
        }
        $result['user_data'] = $data;
        $result['token_data'] = count($token_data);
        $result['scanned_token_data'] = count($scanned_token_data);

        $result['site_name'] = $setting->site_name;
        return view('participant',$result);
    }
}
