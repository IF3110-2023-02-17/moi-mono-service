<?php

class MenfessController 
{
    public function index($studio_id) 
    {
        try 
        {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $data['isLogin'] = true;

                    // handle access
                    
                    $data['studio_name'] = 'Disney Studio';

                    $studio = Utils::view("menfess", "MenfessView", $data);
                    $studio->render();
                    
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            } 
        } 
        catch (Exception $e) 
        {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8001/user/login");
            } else {
                http_response_code($e->getCode());
            }
        }    
    }

    public function send($id)
    {
        try
        {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $data['isLogin'] = true;

                    // handle access

                    
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            } 
        }
        catch (Exception $e) 
        {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8001/user/login");
            } else {
                http_response_code($e->getCode());
            }
        }    
    }
}