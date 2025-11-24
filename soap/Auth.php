<?php

class Auth
{
    private $API_KEY = "SECRET_API_KEY_12345";
    
    public function __construct()
    {

        if (!isset($GLOBALS['SOAP_HEADERS']['ApiKey'])) {
            throw new SoapFault("Auth", "Missing API Key");
        }

        $clientKey = $GLOBALS['SOAP_HEADERS']['ApiKey'];

        if ($clientKey !== $this->API_KEY) {
            throw new SoapFault("Auth", "Invalid API Key");
        }
    }

    public function mySoapHeaderHandler($headers)
    {
        foreach ($headers as $h) {
            $GLOBALS['SOAP_HEADERS'][$h->name] = $h->data;
        }
    }
    
}