<?php

class SoapServiceClient 
{
    private $wsdl;
    private $headers;
    private $post;

    public function invoke($endpoint, $namespace, $params) {
        try {
            $client = curl_init();

            $content = $this->buildMessage($endpoint, $namespace, $params);
            
            curl_setopt($client, CURLOPT_URL, "http://host.docker.internal:8002/ws/api?wsdl");
            curl_setopt($client, CURLOPT_POST, 1);
            curl_setopt($client, CURLOPT_POSTFIELDS, $content);
            curl_setopt($client, CURLOPT_HTTPHEADER, array(
                'Content-Type: text/xml',
                'Api-Key: ' . SOAP_API_KEY, 
            ));
            curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($client);
            $httpCode = curl_getinfo($client, CURLINFO_HTTP_CODE);

            curl_close($client);

            if ($httpCode == 200) {
                return array (
                    'result' => $this->parseSuccessResponse($response, $endpoint),
                    'status_code' => 200,
                );
            } else {
                return $this->parseExceptionResponse($response, $endpoint);
            }
    
        } catch (Exception $e) {
            throw $e;
        }

    }
    public function parseExceptionResponse($xml_raw, $endpoint) {
        $namespaces = [
            'S' => 'http://schemas.xmlsoap.org/soap/envelope/',
            'ns2' => 'Subscription'
        ];
        foreach ($namespaces as $prefix => $namespace) {
            $xml_raw = str_replace($prefix . ':', '', $xml_raw);
        }
        $xml_raw = preg_replace('/xmlns[^=]*="[^"]*"/', '', $xml_raw);

        $xml = simplexml_load_string($xml_raw, 'SimpleXMLElement', 0, "", false);

        $data = json_decode(json_encode($xml), true);
        $json = $data['Body']['Fault']['faultstring'];
        $result = json_decode($json);

        return array (
            "result" => $result->message,
            "status_code" => $result->status,
        );
    }
    public function parseSuccessResponse ($xml_raw, $endpoint) {
        $namespaces = [
            'S' => 'http://schemas.xmlsoap.org/soap/envelope/',
            'ns2' => 'Subscription'
        ];
        foreach ($namespaces as $prefix => $namespace) {
            $xml_raw = str_replace($prefix . ':', '', $xml_raw);
        }
        $xml_raw = preg_replace('/xmlns[^=]*="[^"]*"/', '', $xml_raw);
        
        $xml = simplexml_load_string($xml_raw, 'SimpleXMLElement', 0, "", false);
        $data = json_decode(json_encode($xml), true);
        $json = $data['Body'][$endpoint . "Response"]["result"];

        return $json;
    }

    public function buildMessage($endpoint, $namespace, $params) {
        if (isset($params["subscriberIDs"]) || isset($params["studioIDs"]) || isset($params["input"])) {
            echo "teshhh";

            $xml = new SimpleXMLElement("<Envelope/>");
            $xml->addAttribute("xmlns", "http://schemas.xmlsoap.org/soap/envelope/");
            
            $body = $xml->addChild("Body", "");
            $message = $body->addChild($endpoint, "");
            $message->addAttribute("xmlns", $namespace);

            if (isset($params["subscriberIDs"])) {
                foreach ($params["subscriberIDs"] as $value) {
                    $input = $message->addChild("subscriberIDs", $value);
                    $input->addAttribute('xmlns', '');
                }
            }
            if (isset($params["studioIDs"])) {
                foreach ($params["studioIDs"] as $value) {
                    $input = $message->addChild("studioIDs", $value);
                    $input->addAttribute('xmlns', '');
                }
            }
            if (isset($params["input"])) {
                foreach ($params["input"] as $value) {
                    $input = $message->addChild("input", $value);
                    $input->addAttribute('xmlns', '');
                }
            }

            return $xml->asXML();

        } else {
            $message = array (
                'Body' => [ $endpoint => $params ],
            );
            $xml = new SimpleXMLElement('<Envelope/>');
            $xml->addAttribute("xmlns", "http://schemas.xmlsoap.org/soap/envelope/");
            
            $this->arrayToXml($message, $xml);
            
            $end = $xml->Body->$endpoint;
            $end->addAttribute("xmlns", $namespace);

            if (isset($end->studioID)) {
                $studio = $end->studioID; 
                $studio->addAttribute("xmlns", "");
            }
            if (isset($end->subscriberID)) {
                $subscriber = $end->subscriberID; 
                $subscriber->addAttribute("xmlns", "");
            }
            if (isset($end->status)) {
                $status = $end->status; 
                $status->addAttribute("xmlns", "");
            }

            return $xml->asXML();
        }
    }

    public function arrayToXml($data, &$xmlData)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if (is_numeric($key)) {
                    $key = 'item' . $key;
                }

                $subnode = $xmlData->addChild($key);
                $this->arrayToXml($value, $subnode);
            } else {                
                $xmlData->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }



}