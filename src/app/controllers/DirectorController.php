<?php

class DirectorController
{
    public function catalog() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Authetication
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

                    // Model
                    $data["isAdmin"] = $isAdmin;
                    $data["datatype"] = "director";
                    $directorView = Utils::view("lists", "DirectorListView", $data);
                    $directorView->render();
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
    
    public function insert() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                // Authentication
                $auth = Utils::middleware("Authentication");
                $auth->isUserLogin();
                $data['isLogin'] = true;

                // Director Model
                    $directorModel = Utils::model('Director');
                    $data["director"] = $directorModel->getAllDirectors();
                    $data["datatype"] = "director";

                    $data["isEdit"] = false;

                    $addDirectorView = Utils::view("addData", "AddDataView", $data);
                    $addDirectorView->render();
                    break;

                case 'POST':
                    $directorModel = Utils::model('Director');
                    // var_dump($_POST['photo']);
                    
                    // Copy file to directory
                    if (isset($_FILES["photo"])) {
                        $file = $_FILES["photo"];

                        if ($file["error"] == UPLOAD_ERR_OK) {
                            $uploadDir = "media/img/director";
                            $name = basename($file["name"]);

                            $uploadFile = $uploadDir .'/'. $name;
                            // var_dump($uploadFile);
                
                            if (move_uploaded_file($file["tmp_name"], $uploadFile)) {
                                // echo "File is valid and was successfully uploaded.";

                                // Add director
                                if ($directorModel -> addDirector($_POST, $name) > 0){
                                header('Location: ' ."http://$_SERVER[HTTP_HOST]".  '/home');
                                exit;
                                break;
                    }

                            } else {
                                echo "Error uploading the file.";
                            }
                        } else {
                            echo "Upload error: " . $file["error"];
                        }
                    }

                    
                    
                    
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

    public function update() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Authentication
                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();
                    $data['isLogin'] = true;

                    $directorModel = Utils::model('Director');
                    $data["director"] = $directorModel->getDirectorByID($_GET['director_id']);
                    $data["datatype"] = "director";

                    $data["isEdit"] = true;

                    $addDirectorView = Utils::view("addData", "AddDataView", $data);
                    $addDirectorView->render();
                    break;
                case 'POST':
                    $directorModel = Utils::model('Director');

                    $photoName = "";

                    if(isset($_FILES['photo'])) {
                        $photo = $_FILES['photo'];
                        if ($photo['error'] == UPLOAD_ERR_OK) {
                            $uploadPhotoDir = "media/img/director";
                            $photoName = basename($photo['name']);
                            $uploadPhoto = $uploadPhotoDir . '/' . $photoName;
                            
                            if (!move_uploaded_file($photo['tmp_name'], $uploadPhoto)) {
                                throw new Exception('Internal Server Error', STATUS_INTERNAL_SERVER_ERROR);
                            } 
                        } else {
                            throw new Exception('Internal Server Error', STATUS_INTERNAL_SERVER_ERROR);
                        }
                    }
                    
                    if ($directorModel->updateDirector($_POST, $photoName) > 0) {
                        header('Location: ' ."http://$_SERVER[HTTP_HOST]".  '/home');
                        break;
                        exit;
                    }
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

    public function detail($directorID) {
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

                    // Direction
                    // $directorChosen = $_GET['name'];
                    $data['title'] = 'Director';
                    $data['people'] = Utils::model("Director")->getDirectorByID($directorID);
            
                    //pagination for movies
                    $moviePerPage = 6;
                    $data['totalPage'] = ceil(Utils::model("Director")->getCountMovieByDirectorID($data['people']['director_id'])/$moviePerPage);
                    $currentPage = $_GET['page'] ?? 1;
                    $data['page'] = $currentPage;
                    $initialMovie = ($moviePerPage * $currentPage) - $moviePerPage;
            
                    $data['movieID'] = Utils::model("Director")->getMovieByDirectorIDWithLimit($data['people']['director_id'], $initialMovie, $moviePerPage);
                    foreach ($data['movieID'] as $movieID) {
                        $movieID = $movieID['movie_id'];
                        $data['movie'][] = Utils::model("Movie")->getMovieByID("$movieID");
                    };
            
                    $directorView = Utils::view("about", "AboutPeopleView", $data);
                    $directorView->render();
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

    public function fetch($page) {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();
                    $directorModel = Utils::model("Director");
                    
                    $directors = $directorModel->getPaginate($page);
                    $count = $directorModel->getCountAllPage();

                    header('Content-Type: application/json');
                    echo json_encode(['directors' => $directors, 'page' => $count]);
                    exit;
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

    public function delete() {
        try {
            // var_dump($_SERVER['REQUEST_METHOD']);
            switch ($_SERVER['REQUEST_METHOD']) {
                case "DELETE":
                    $auth = Utils::middleware("Authentication");
                    $auth->isAdminLogin();

                    $directorModel = Utils::model('Director');
                    if ($directorModel->deleteDirector($_GET['director_id']) > 0){
                        // var_dump($_POST);
                        // header('Location: ' ."http://$_SERVER[HTTP_HOST]".  '/movie/catalog');
                        header('Content-Type: application/json');
                        echo json_encode(['error' => null ]);
                    }
                    exit;
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