<?php

declare(strict_types=1);

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\GenerateQRModel;
use Exception;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use Config\Setting; // Loading config class


use App\Libraries\Ciqrcode;
use DateTime;

/**
 * @property Ciqrcode $ciqrcode
 */


class QRGenerate extends ResourceController
{
    public function addToken()
    {
        $rules = [
            "token" => "required"
        ];

        $messages = [
            "token" => [
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
        } else {

            try {
                $GenerateQRModel = new GenerateQRModel();
                
                $result = $GenerateQRModel->checkQRVerification($this->request->getVar("token"));
                
                if(count($result)>0){
                    $response = [
                        'status' => 500,
                        'error' => true,
                        'message' => 'Token already exists',
                        'data' => []
                    ];
                }else{
                    $data['token'] = $this->request->getVar("token");
    
                    $GenerateQRModel->save($data);
    
                    $response = [
                        'status' => 200,
                        'error' => false,
                        'message' => 'QRCODE log Detail',
                        'user' => 'Esai',
                        'data' => []
                    ];
                }
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
    
    public function listToken()
    {
        $GenerateQRModel = new GenerateQRModel();
        
        $QRList = $GenerateQRModel->get_all_data();

        $response = [
            'status' => 200,
            "error" => false,
            'messages' => 'QRCODE log Detail',
            'count' => count($QRList),
            'data' => $QRList
        ];

        return $this->respondCreated($response);
    }

    public function deleteToken()
    {
        $GenerateQRModel = new GenerateQRModel();
        $id = $this->request->getVar("token_id");
       
        $del_data = $GenerateQRModel->delete_data($id);
        if ($del_data) {
            $response = [
                'status' => 200,
                "error" => false,
                'message' => 'Record has been deleted successfully',
                'data' => $del_data
            ];

            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 500,
                'error' => true,
                'message' => 'Sorry!. Unable to delete the Record.',
                'data' => []
            ];
            return $this->respondCreated($response);
        }
    }
    
    public function updateToken()
    {
        $rules = [
            "token" => "required",
            "token_id" => "required"
        ];

        $messages = [
            "token" => [
                "required" => "Token is required"
            ],
            "token_id" => [
                "required" => "Token ID is required"
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            $response = [
                'status' => 500,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ];
        } else {
            
            try {
                $token_id = $this->request->getVar("token_id");
                $GenerateQRModel = new GenerateQRModel();
                $data['token'] = $this->request->getVar("token");
                $GenerateQRModel->update_data($token_id, $data);
                $response = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Record updated successfully',
                    'data' => []
                ];
                return $this->respondCreated($response);
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
    }

    public function truncate_token()
    {
        $GenerateQRModel = new GenerateQRModel();
        
        $QRList = $GenerateQRModel->truncate_all_data();

        $response = [
            'status' => 200,
            "error" => false,
            'messages' => 'Scan table reset successfully',
            'data' => $QRList
        ];

        return $this->respondCreated($response);
    }
    
    
}
