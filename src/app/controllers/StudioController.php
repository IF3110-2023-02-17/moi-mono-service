<?php

class StudioController 
{
    public function index($page = 1) {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':

                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();
                    
                    $user_id = $_SESSION['user_id'];

                    $data['isLogin'] = true;

                    $count = true;
                    $rest = Utils::client("RestServiceClient"); 
                    $result = $rest->get("/studio/$user_id/$page?count=$count", null);
                    
                    $data['studio'] = json_decode($result['result'])->studios;


                    $data['countPage'] = json_decode($result['result'])->count;
                    $data['currPage'] = json_decode($result['result'])->page;

                    $studio = Utils::view("studio", "StudiosView", $data);
                    $studio->render();
                    
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8001/user/login");
            } else {
                http_response_code($e->getCode());
            }
        }
    }
    public function fetch($page) {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':

                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();
                    
                    $user_id = $_SESSION['user_id'];

                    $rest = Utils::client("RestServiceClient"); 
                    $result = $rest->get("/studio/$user_id/$page", null);
                    
                    $data['studio'] = json_decode($result['result'])->studios;
                    $data['currPage'] = json_decode($result['result'])->page;

                    header('Content-Type: application/json');
                    http_response_code(200);
                    echo json_encode($data);
                    
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8001/user/login");
            } else {
                http_response_code($e->getCode());
            }
        }
    }
    public function dashboard($id = 1) {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();

                    $prem = Utils::middleware("SubscriptionAuth");
                    $prem->isSubscribeAccept($id);

                    $data['isLogin'] = true;

                    if (isset($_GET['movie_page'])) {
                        $movie_page = $_GET['movie_page'];
                    } else {
                        $movie_page = 1; 
                    }

                    if (isset($_GET['post_page'])) {
                        $post_page = $_GET['post_page'];
                    } else {
                        $post_page = 1;
                    }

                    $count = true;

                    $movie = Utils::model("Movie");
                    $data['movies'] = $movie->getMovieByStudio((int)$id, $movie_page);
                    $data['movie_count'] = $movie->getPageMovieByStudio((int)$id);
                    $data['movie_page'] = $movie_page;
                    
                    $rest = Utils::client("RestServiceClient"); 
                    $result = $rest->get("/posts/$id/$post_page?count=$count", null);
                    
                    $data['posts'] = json_decode($result['result'])->posts;
                    $data['post_count'] = json_decode($result['result'])->count;
                    $data['post_page'] = json_decode($result['result'])->page;
                    
                    $data['studio_id'] = $id;
                    $data['studio_name'] = json_decode($result['result'])->name;

                    $studio = Utils::view("studio", "StudioView", $data);
                    $studio->render();
                    
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8001/user/login");
            } else {
                http_response_code($e->getCode());
            }
        }
    }
    public function fetch_movie($id) {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $data['isLogin'] = true;

                    if (isset($_GET['movie_page'])) {
                        $movie_page = $_GET['movie_page'];
                    } else {
                        $movie_page = 1; 
                    }
            
                    if (isset($_GET['post_page'])) {
                        $post_page = $_GET['post_page'];
                    } else {
                        $post_page = 1;
                    }

                    $movie = Utils::model("Movie");
                    $data['movies'] = $movie->getMovieByStudio($id, $movie_page);
                    $data['movie_count'] = $movie->getCountAll();
                    $data['movie_page'] = $movie_page;
                    
                    header('Content-Type: application/json');
                    http_response_code(200);
                    echo json_encode($data);
                    
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8001/user/login");
            } else {
                http_response_code($e->getCode());
            }
        }
    }
    public function fetch_post($id) {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $data['isLogin'] = true;

                    if (isset($_GET['movie_page'])) {
                        $movie_page = $_GET['movie_page'];
                    } else {
                        $movie_page = 1; 
                    }
            
                    if (isset($_GET['post_page'])) {
                        $post_page = $_GET['post_page'];
                    } else {
                        $post_page = 1;
                    }
                    
                    $count = false;

                    $rest = Utils::client("RestServiceClient"); 
                    $result = $rest->get("/posts/$id/$post_page?count=$count", null);
                    
                    $data['posts'] = json_decode($result['result'])->posts;
                    $data['post_count'] = json_decode($result['result'])->count;
                    $data['post_page'] = json_decode($result['result'])->page;

                    header('Content-Type: application/json');
                    http_response_code(200);
                    echo json_encode($data);
                    
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8001/user/login");
            } else {
                http_response_code($e->getCode());
            }
        }
    }
    public function subscribe($id) {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':

                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();
                    
                    $user_id = $_SESSION['user_id'];
                    // $user_id = 3;

                    $soap_client = Utils::client("SoapServiceClient");
                    $result = $soap_client->invoke("subscribe", "Subscription", [ "studioID" => $id, "subscriberID" => $user_id]);
                    
                    $subs = $result["result"];

                    $subscription = Utils::model("Subscription");
                    $subscription->insertSubs($subs["studioId"], $subs["subsId"], $subs["status"]);

                    header('Content-Type: application/json');
                    http_response_code(200);
                    echo json_encode($result);
                    
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8001/user/login");
            } else {
                http_response_code($e->getCode());
            }
        }
    }

    public function detail(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Authentication
                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();
                    $data['isLogin'] = true;

                    $isAdmin = false; 
                    try {
                        $auth->isAdminLogin();
                        $isAdmin = true;
                    } catch (Exception $e) {
                        if ($e-> getCode() !== STATUS_UNAUTHORIZED) {
                            throw new Exception($e->getMessage(), $e->getCode());
                        }
                    }

                    $data["isAdmin"] = $isAdmin;

                    var_dump(SOAP_API_URL);

                    $client = Utils::client("SoapServiceClient");
                    var_dump($client);
                    $client->invoke("Example", array('input' => [12, 13, 14]));

                    $studioView = Utils::view("studio", "StudioView", $data);
                    $studioView->render();
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8080/user/login");
            } else {
                http_response_code($e->getCode());
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
}
