<?php

class StudioController 
{
    public function index($page = 1) {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $data['isLogin'] = true;

                    // get data with page 
                    $data['studio'] = [
                        ["studio_id" => 1, "name" => "Rizky Studio" , "accept" => true, "pending" => false, "reject" => false, "description" => "Deskripsi ini merupakan deskripsi film itu dengan film yang terkenal adalah makan-makan" ],
                        ["studio_id" => 2, "name" => "Abdillah Studio" , "accept" => false, "pending" => false, "reject" => false, "description" => "Deskripsi ini merupakan deskripsi film itu dengan film yang terkenal adalah makan-makan" ],
                        ["studio_id" => 3, "name" => "Rasyid Studio" , "accept" => false, "pending" => false, "reject" => true, "description" => "Deskripsi ini merupakan deskripsi film itu dengan film yang terkenal adalah makan-makan" ],
                        ["studio_id" => 4, "name" => "Golang Studio" , "accept" => false, "pending" => true, "reject" => false, "description" => "Deskripsi ini merupakan deskripsi film itu dengan film yang terkenal adalah makan-makan" ],
                        ["studio_id" => 5, "name" => "Java Studio" , "accept" => false, "pending" => false, "reject" => false, "description" => "Deskripsi ini merupakan deskripsi film itu dengan film yang terkenal adalah makan-makan" ],
                        ["studio_id" => 6, "name" => "Rizky Studio" , "accept" => true, "pending" => false, "reject" => false, "description" => "Deskripsi ini merupakan deskripsi film itu dengan film yang terkenal adalah makan-makan" ],
                        ["studio_id" => 7, "name" => "Abdillah Studio" , "accept" => false, "pending" => false, "reject" => false, "description" => "Deskripsi ini merupakan deskripsi film itu dengan film yang terkenal adalah makan-makan" ],
                        ["studio_id" => 8, "name" => "Rasyid Studio" , "accept" => false, "pending" => false, "reject" => true, "description" => "Deskripsi ini merupakan deskripsi film itu dengan film yang terkenal adalah makan-makan" ],
                        ["studio_id" => 9, "name" => "Golang Studio" , "accept" => false, "pending" => true, "reject" => false, "description" => "Deskripsi ini merupakan deskripsi film itu dengan film yang terkenal adalah makan-makan" ],
                    ];

                    // count pages
                    $data['countPage'] = 2;
                    $data['currPage'] = $page;

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

                    $data['studio'] = [
                        ["studio_id" => 1, "name" => "Andrea Studio" , "accept" => true, "pending" => false, "reject" => false, "description" => "Deskripsi ini merupakan deskripsi film itu dengan film yang terkenal adalah makan-makan" ],
                        ["studio_id" => 2, "name" => "Akido Studio" , "accept" => false, "pending" => false, "reject" => false, "description" => "Deskripsi ini merupakan deskripsi film itu dengan film yang terkenal adalah makan-makan" ],
                        ["studio_id" => 3, "name" => "Yagami Studio" , "accept" => false, "pending" => false, "reject" => true, "description" => "Deskripsi ini merupakan deskripsi film itu dengan film yang terkenal adalah makan-makan" ],
                        ["studio_id" => 4, "name" => "Golang Studio" , "accept" => false, "pending" => true, "reject" => false, "description" => "Deskripsi ini merupakan deskripsi film itu dengan film yang terkenal adalah makan-makan" ],
                        ["studio_id" => 5, "name" => "Java Studio" , "accept" => false, "pending" => false, "reject" => false, "description" => "Deskripsi ini merupakan deskripsi film itu dengan film yang terkenal adalah makan-makan" ],
                        ["studio_id" => 6, "name" => "Rizky Studio" , "accept" => true, "pending" => false, "reject" => false, "description" => "Deskripsi ini merupakan deskripsi film itu dengan film yang terkenal adalah makan-makan" ],
                        ["studio_id" => 7, "name" => "Abdillah Studio" , "accept" => false, "pending" => false, "reject" => false, "description" => "Deskripsi ini merupakan deskripsi film itu dengan film yang terkenal adalah makan-makan" ],
                        ["studio_id" => 8, "name" => "Rasyid Studio" , "accept" => false, "pending" => false, "reject" => true, "description" => "Deskripsi ini merupakan deskripsi film itu dengan film yang terkenal adalah makan-makan" ],
                        ["studio_id" => 9, "name" => "Golang Studio" , "accept" => false, "pending" => true, "reject" => false, "description" => "Deskripsi ini merupakan deskripsi film itu dengan film yang terkenal adalah makan-makan" ],
                    ];

                    $data['countPage'] = 2;
                    $data['currPage'] = $page;

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
                    $movies = $movie->getPaginate($movie_page);
                    $data['movies'] = array_slice($movies, 5);
                    $data['movie_count'] = $movie->getCountAll();
                    $data['movie_page'] = $movie_page;
                    
                    $post = [
                        ["post_id" => 1, "title" => "Konten Menarik Nih Konten", 
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
                        "updated_at" => "2023-11-13 19:14:36", "img_path" => "Abang2an.png"],
                        // =======
                        ["post_id" => 2, "title" => "Konten Kurang Nih Konten", 
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
                        "updated_at" => "2023-11-13 19:14:36", "img_path" => "Abang2an.png"],
                        // =======
                        ["post_id" => 3, "title" => "Ada Leak Volem Baru", 
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
                        "updated_at" => "2023-11-13 19:14:36", "img_path" => "Abang2an.png"],
                        // =======
                        ["post_id" => 4, "title" => "Konten Volem Krennnn", 
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
                        "updated_at" => "2023-11-13 19:14:36", "img_path" => "Abang2an.png"],
                        // =======
                    ];

                    $data['posts'] = $post;
                    $data['post_count'] = 2;
                    $data['post_page'] = $post_page;
                    
                    $data['studio_id'] = $id;
                    $data['studio_name'] = "Disney Studio";

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
                    $movies = $movie->getPaginate($movie_page);
                    $data['movies'] = array_slice($movies, 5);
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
                    $post = [
                        ["post_id" => 1, "title" => "Post Menarik Nih Konten", 
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
                        "updated_at" => "2023-11-13 19:14:36", "img_path" => "Abang2an.png"],
                        // =======
                        ["post_id" => 2, "title" => "Post Kurang Nih Konten", 
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
                        "updated_at" => "2023-11-13 19:14:36", "img_path" => "Abang2an.png"],
                        // =======
                        ["post_id" => 3, "title" => "Ada Leak PostVolem Baru", 
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
                        "updated_at" => "2023-11-13 19:14:36", "img_path" => "Abang2an.png"],
                        // =======
                        ["post_id" => 4, "title" => "Konten Volem PostKrennnn", 
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
                        "updated_at" => "2023-11-13 19:14:36", "img_path" => "Abang2an.png"],
                        // =======
                    ];

                    $data['posts'] = $post;
                    $data['post_count'] = 2;
                    $data['post_page'] = $post_page;

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
}