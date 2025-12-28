<?php

class Auth
{
    public static function check()
    {
        if (
            !isset($_SERVER['PHP_AUTH_USER']) ||
            $_SERVER['PHP_AUTH_USER'] !== 'admin' ||
            $_SERVER['PHP_AUTH_PW'] !== 'admin123'
        ) {
            throw new SoapFault("Server", "Unauthorized");
        }
    }
}