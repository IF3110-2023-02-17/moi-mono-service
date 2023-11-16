<?php

class PhpinfoController 
{
    public function index() 
    {
        try 
        {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':

                    // handle access
                    phpinfo();

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
    public function test() 
    {
        try 
        {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':

                    $client = Utils::client("SoapServiceClient");

                    $result = $client->invoke("getSubscriptionStudio", "Subscription", 
                    [
                        "studioID" => 1,
                    ]);

                    header("Content-Type: application/json");
                    echo json_encode($result);

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
    public function arrayToXml($array, &$xml){
        foreach ($array as $key => $value) {
            if(is_int($key)){
                $key = "e";
            }
            if(is_array($value)){
                $label = $xml->addChild($key);
                $this->arrayToXml($value, $label);
            }
            else {
                $xml->addChild($key, $value);
            }
        }
    }
    
}