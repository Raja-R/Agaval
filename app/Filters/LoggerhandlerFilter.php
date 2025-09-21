<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;


class LoggerhandlerFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
       
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //print_r($request);
        $response_service = \Config\Services::response();
        $uri = $request->getUri();
        log_message('info', '{message}', ['message' => '-------------------------------------------']);
        log_message('info', '{message}', ['message' => 'Request Start']);
        log_message('info', '{message}', ['message' => json_encode($uri->getSegments())]);
        log_message('info', '{message}', ['message' => json_encode(strtoupper($request->getMethod()))]);
        log_message('info', '{message}', ['message' => json_encode($request->getVar())]);
        
        log_message('info', '{message}', ['message' => $response_service->getJSON()]);
        
        log_message('info', '{message}', ['message' => 'Response End']);
        log_message('info', '{message}', ['message' => '-------------------------------------------']);
    }
}
