<?php

class StudioController 
{
    public function index() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    var_dump(SOAP_API_URL);

                    $client = Utils::client("SoapServiceClient");
                    var_dump($client);
                    $client->invoke("Example", array('input' => [12, 13, 14]));

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