<?php

class PostController
{
    public function index($postID = 0) 
    {
        try 
        {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();
                    $data['isLogin'] = true;

                    $rest = Utils::client("RestServiceClient"); 
                    $result = $rest->get("/posts/$postID", null);

                    $data['post'] = json_decode($result['result'])->post;
                    $data['post_id'] = $postID;

                    // var_dump($data);

                    $studio = Utils::view("post", "PostView", $data);
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
}