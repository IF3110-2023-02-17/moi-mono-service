<?php

class PostController
{
    public function index($studio_id = 0, $post = 0) 
    {
        try 
        {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $data['isLogin'] = true;

                    // handle access

                    $post = ["post_id" => 1, "title" => "Konten Menarik Nih Konten", 
                    "body" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Integer enim est, tempus sit amet malesuada eu, eleifend consectetur 
                    metus. Sed a nulla eu ex condimentum lacinia. Suspendisse potenti. 
                    Vivamus pulvinar rhoncus eros. Integer sagittis, erat sed cursus 
                    dapibus, lorem nunc elementum erat, ut venenatis diam nibh in libero. 
                    Quisque orci leo, feugiat ac ultricies hendrerit, congue vitae ipsum. 
                    Proin in erat quam. Vestibulum ullamcorper hendrerit lectus, non 
                    scelerisque dui tempor sed. Donec et nisl rutrum, dignissim turpis 
                    quis, ullamcorper nunc. Integer a turpis tristique, efficitur nisi 
                    nec, malesuada orci",
                    "updated_at" => "2023-11-13 19:14:36", "img_path" => "Abang2an.png"];

                    $data['post'] = $post;
                    $data['studio_id'] = $studio_id;
                    $data['post_id'] = $post;

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