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
                    $rest = Utils::client("RestServiceClient");
                    $result = $rest->get("/studio/$studio_id", null);
                    
                    $data["studio_id"] = $studio_id;
                    $data["studio_name"] = json_decode($result["result"])->name;

                    $menfess = Utils::view("menfess", "MenfessView", $data);
                    $menfess->render();
                    
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

                    $payload = [
                        "sender" => $_POST["sender"],
                        "body" => $_POST["body"],
                        "studio_id" => (int) $id
                    ];

                    $rest = Utils::client("RestServiceClient");
                    $result = $rest->post('/menfess/', json_encode($payload));
                    
                    header('Content-Type: application/json');
                    http_response_code(200);
                    echo json_encode(['message' => json_decode($result['result'])->message]);
                    
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