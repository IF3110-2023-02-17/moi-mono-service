<?php

class RestServiceClient
{
    private $url;
    private $key;

    public function __construct() {
        $this->url = REST_API_URL;
        $this->key = REST_API_KEY;
    }
    
    public function get($endpoint, $body) 
    {
        try {
            return $this->invoke('GET', $endpoint, $body);
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function post($endpoint, $body) 
    {
        try {
            return $this->invoke('POST', $endpoint, $body);
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function put($endpoint, $body) 
    {
        try {
            return $this->invoke('PUT', $endpoint, $body);
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function delete($endpoint, $body) 
    {
        try {
            return $this->invoke('DELETE', $endpoint, $body);
        } catch (Exception $e) {
            throw $e;
        }    
    }
    public function invoke($method, $endpoint, $body = null)
    {
        try {
            $client = curl_init();
            
            // echo $this->url . $endpoint;
            curl_setopt($client, CURLOPT_URL, $this->url . $endpoint);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($client, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Api-Key: ' . REST_API_KEY, 
            ));
            curl_setopt($client, CURLOPT_CUSTOMREQUEST, $method);
            
            if ($method === 'POST' || $method === 'PUT' || $method === 'DELETE') {
                curl_setopt($client, CURLOPT_POSTFIELDS, $body);
            }
            
            $httpCode = curl_getinfo($client, CURLINFO_HTTP_CODE);
            $result = curl_exec($client); 
        
            curl_close($client);

            if ($httpCode >= 400) {
                throw new Exception("Internal Server Error", 500);
            }

            // echo $result;

            return array(
                'result' => $result,
                'status_code' => $httpCode
            );
        } catch (Exception $e) {
            throw $e;
        }
    }
}