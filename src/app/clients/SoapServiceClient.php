<?php

class SoapServiceClient 
{
    private $client;

    public function __constructor() {
        try {
            $opts = array(
                "http" => array(
                    "header" => "Api-Key: " . SOAP_API_KEY,
                ),
                'ssl' => array(
                    'ciphers' => 'RC4-SHA',
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ),
            );
    
            $params = array(
                'encoding' => 'UTF-8',
                'verifypeer' => false,
                'verifyhost' => false,
                'soap_version' => SOAP_1_2,
                'trace' => 1,
                'exceptions' => 1,
                'connection_timeout' => 180,
                'stream_context' => stream_context_create($opts),
            );
    
            $this->client = new SoapClient(SOAP_API_URL, $params);
    
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