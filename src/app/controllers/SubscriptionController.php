<?php

class SubscriptionController
{
    public function callback() 
    {
        try 
        {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':

                    $subscriber_id = $_POST['subscriberID'];
                    $studio_id = $_POST['studioID'];
                    $status = $_POST['status'];

                    if (!$subscriber_id || !$studio_id || !$status) {
                        throw new Exception('Param Invalid', 400);
                    }

                    $subscription = Utils::model("Subscription");
                    $subscription->change($studio_id, $subscriber_id, $status);
                    
                    header('Content-Type: application/json');
                    http_response_code(200);
                    echo json_encode([ "message" => "success!" ]);

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

    public function name($studio_id, $status) {
        try 
        {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':

                    if (!$studio_id || !$status) {
                        throw new Exception('Param Invalid', 400);
                    }

                    $subscription = Utils::model("Subscription");
                    $result = $subscription->getNameSubscriber($studio_id, $status);
                    
                    header('Content-Type: application/json');
                    http_response_code(200);
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
}