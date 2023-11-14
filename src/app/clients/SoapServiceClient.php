<?php

class SoapServiceClient 
{
    private $client;

    public function __constructor() {
        try {
            $option = [
                "exceptions" => 1,
                "trace" => 1,
                "encoding" => 'UTF-8',
                "stream_context" => stream_context_create(array(
                    "http" => array(
                        "header" => "Api-Key: " . SOAP_API_KEY,
                    ),
                )),
            ];
            $this->client = new SoapClient(SOAP_API_URL, array(
                "exceptions" => 1,
                "trace" => 1,
                "encoding" => 'UTF-8',
                "stream_context" => stream_context_create(array(
                    "http" => array(
                        "header" => "Api-Key: " . SOAP_API_KEY,
                    ),
                )),
              ));
    
        } catch (SoapFault $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function invoke($endpoint, $params) {
        $result = null;
        var_dump($this->client);
        if (!isset($params)) {
            $result = $this->client->$endpoint();
        } else {
            $result = $this->client->$endpoint($params);
        }

        var_dump($result);
    }
}