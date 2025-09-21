<?php

declare(strict_types=1);

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use App\Models\AttendanceModel;
use Exception;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use Config\Setting; // Loading config class


use App\Libraries\Ciqrcode;
use DateTime;

/**
 * @property Ciqrcode $ciqrcode
 */


class Users extends ResourceController
{

    public function addUser()
    {
        $rules = [
            "first_name" => "required",
            "user_email" => "required|valid_email|is_unique[user.email]|min_length[6]",
            "user_mobile" => "required",
            "user_password" => "required",
        ];

        $messages = [
            "first_name" => [
                "required" => "Name is required"
            ],
            "user_email" => [
                "required" => "Email required",
                "valid_email" => "Email address is not in format",
                "is_unique" => "Email address already exists"
            ],
            "user_mobile" => [
                "required" => "Phone Number is required"
            ],
            "user_password" => [
                "required" => "Password is required"
            ],
        ];

        if (!$this->validate($rules, $messages)) {

            $response = [
                'status' => 500,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ];
        } else {
            $setting = new Setting;
            $key = $setting->token_key;
            $authHeader = $this->request->getHeader("Authorization");
            $authHeader = $authHeader->getValue();
            $token = $authHeader;

            try {
                $decoded = JWT::decode($token, new Key($key, 'HS256'));

                $UserModel = new UserModel();

                $data['first_name'] = $this->request->getVar("first_name");
                $data['last_name'] = $this->request->getVar("last_name");
                $data['email'] = $this->request->getVar("user_email");
                $data['username'] = $this->request->getVar("user_email");
                $data['password'] = password_hash($this->request->getVar("user_password"), PASSWORD_DEFAULT);
                $data['mobile'] = $this->request->getVar("user_mobile");
                $data['type'] = $this->request->getVar("user_role");
                $data['status'] = $this->request->getVar("user_status");

                $UserModel->save($data);

                $response = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'User added successfully',
                    'data' => []
                ];
            } catch (Exception $ex) {
                $response = [
                    'status' => 401,
                    'error' => true,
                    'message' => 'Access denied',
                    'data' => []
                ];
                return $this->respondCreated($response);
            }
        }

        return $this->respondCreated($response);
    }

    public function listUser()
    {
        $userlist = new UserModel();

        
        $response = [
            'status' => 200,
            "error" => false,
            'messages' => 'User list',
            'data' => $userlist->get_all_data()
        ];

        return $this->respond($response,200);
        
    }

    public function deleteUser($id = null)
    {
        $UserModel = new UserModel();
        $id = $this->request->getVar("user_id");
        $del_data = $UserModel->delete_data($id);
        if ($del_data) {
            $response = [
                'status' => 200,
                "error" => false,
                'message' => 'Record has been deleted successfully',
                'data' => $del_data
            ];

            return $this->respond($response,200);
        } else {
            $response = [
                'status' => 500,
                'error' => true,
                'message' => 'Sorry!. Unable to delete the Record.',
                'data' => []
            ];
            return $this->respond($response,500);
        }
    }

    public function getAllAttendance()
    {
        $setting = new Setting;
        $key = $setting->token_key;
        $authHeader = $this->request->getHeader("Authorization");
        $authHeader = $authHeader->getValue();
        $token = $authHeader;


        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $AttendanceModel = new AttendanceModel();

            $attendance_data = $AttendanceModel->get_all_data();
            $response = [
                'status' => 200,
                "error" => false,
                'messages' => 'Attendance list',
                'count' => count($attendance_data),
                'data' => count($attendance_data)
            ];

            return $this->respond($response,200);
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => true,
                'message' => 'Access denied',
                'data' => []
            ];
            return $this->respond($response,401);
        }
    }


    public function getAttendance()
    {
        $setting = new Setting;
        $key = $setting->token_key;
        $authHeader = $this->request->getHeader("Authorization");
        $authHeader = $authHeader->getValue();
        $token = $authHeader;


        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $user_id =  $decoded->data->id;
            $AttendanceModel = new AttendanceModel();

            $attendance_data = $AttendanceModel->get_user_data($user_id);
            $response = [
                'status' => 200,
                "error" => false,
                'messages' => 'Attendance list',
                'count' => count($attendance_data),
                'data' => $attendance_data
            ];

            return $this->respond($response,200);
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => true,
                'message' => 'Access denied',
                'data' => []
            ];
            return $this->respond($response,401);
        }
    }

    public function getAttendanceCount()
    {
        $setting = new Setting;
        $key = $setting->token_key;
        $authHeader = $this->request->getHeader("Authorization");
        $authHeader = $authHeader->getValue();
        $token = $authHeader;


        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $user_id =  $decoded->data->id;
            $AttendanceModel = new AttendanceModel();

            $attendance_data = $AttendanceModel->get_user_data($user_id);
            $response = [
                'status' => 200,
                "error" => false,
                'messages' => 'Attendance Count',
                'data' => count($attendance_data)
            ];

            return $this->respond($response,200);
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => true,
                'message' => 'Access denied',
                'data' => []
            ];
            return $this->respond($response,401);
        }
    }

    public function addAttendance()
    {
        $rules = [
            "token_id" => "required"
        ];

        $messages = [
            "token_id" => [
                "required" => "Token is required"
            ]
        ];

        if (!$this->validate($rules, $messages)) {

            $response = [
                'status' => 500,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ];
            return $this->respond($response,500);
        } else {
            $setting = new Setting;
            $key = $setting->token_key;
            $authHeader = $this->request->getHeader("Authorization");
            $authHeader = $authHeader->getValue();
            $token = $authHeader;

            try {
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
                $user_id =  $decoded->data->id;
                $token_id = $this->request->getVar("token_id");
                $AttendanceModel = new AttendanceModel();

                $ResultVerify = $AttendanceModel->checkQRVerification($token_id);

                if (count($ResultVerify) > 0) {
                    $ResultToken = $AttendanceModel->checkToken($token_id);
                    if (count($ResultToken) == 0) {
                        $data['token_id'] = $this->request->getVar("token_id");
                        $data['user_id'] = $user_id;

                        $AttendanceID = $AttendanceModel->insert_data($data);

                        $attendance_data = $AttendanceModel->get_user_data($user_id);
                        $response = [
                            'status' => 200,
                            'error' => false,
                            'message' => 'Token has been submitted successfully',
                            'count' => count($attendance_data),
                            'data' => count($attendance_data)
                        ];
                        return $this->respond($response,200);
                    } else {
                        $response = [
                            'status' => 500,
                            'error' => true,
                            'message' => 'Token is exist',
                            'data' => []
                        ];
                        return $this->respond($response,500);
                    }
                } else {
                    $response = [
                        'status' => 500,
                        'error' => true,
                        'message' => 'Token is not found',
                        'data' => []
                    ];
                    return $this->respond($response,500);
                }
            } catch (Exception $ex) {
                $response = [
                    'status' => 401,
                    'error' => true,
                    'message' => 'Login expired',
                    'data' => []
                ];
                return $this->respond($response,401);
            }
        }
    }
}
