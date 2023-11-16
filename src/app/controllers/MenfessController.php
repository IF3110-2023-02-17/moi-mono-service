<?php

class MenfessController
{
    public function index() {
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
                    //var_dump($client);
                    $client->invoke("Example", array('input' => [12, 13, 14]));

                    $menfessView = Utils::view("menfess", "MenfessView", $data);
                    $menfessView->render();
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