<?php

class UserController
{
    public function login() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':

                    // Validasi Apakah Sudah Login ? 
                    $auth = Utils::middleware("Authentication");
                    try {
                        $auth->isUserLogin();
                        header("Location: http://localhost:8080/home");
                    } catch (Exception $e) {
                        if ($e->getCode() !== STATUS_UNAUTHORIZED) {
                            throw new Exception($e->getMessage(), $e->getCode());
                        }
                    }

                    $data['isLogin'] = true;

                    $loginView = Utils::view("auth", "AuthView", $data);
                    $loginView->render();
                    break;

                case 'POST':
                    $userModel = Utils::model("User");

                    $user_id = $userModel->login($_POST['username'], $_POST['password']);
                    $_SESSION['user_id'] = $user_id;

                    header('Content-Type: application/json');
                    http_response_code(201);
                    echo json_encode(['redirect' => "http://localhost:8080/home"]);
                    exit;
                    break;
                default:
                    throw new Exception();
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function register() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':

                    // Validasi Apakah Sudah Login ? 
                    $auth = Utils::middleware("Authentication");
                    try {
                        $auth->isUserLogin();
                        header("Location: http://localhost:8080/home");
                    } catch (Exception $e) {
                        if ($e->getCode() !== STATUS_UNAUTHORIZED) {
                            throw new Exception($e->getMessage(), $e->getCode());
                        }
                    }

                    $data['isLogin'] = false;
                    $loginView = Utils::view("auth", "AuthView", $data);
                    $loginView->render();
                    break;

                case 'POST':
                    $userModel = Utils::model("User");
                    $userModel->register($_POST['email'], $_POST['username'], $_POST['password']);

                    header('Content-Type: application/json');
                    http_response_code(201);
                    echo json_encode(['redirect' => "http://localhost:8080/user/login"]);
                    exit;
                    break;
                default:
                    throw new Exception();
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }

    }

    public function logout() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    unset($_SESSION['user_id']);
                    $data['isLogin'] = false;
                    // header('Content-Type: application/json');
                    // http_response_code(STATUS_OK);
                    header("Location: http://localhost:8080/home");
                    exit;
                    break;
                default:
                    throw new Exception();
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function index() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $auth = Utils::middleware("Authentication");
                    $auth->isAdminLogin();

                    $movieView = Utils::view("lists", "UserListView");
                    $movieView->render();
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
        }
    }
}