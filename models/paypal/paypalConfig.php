<?php
require_once("PayPal-PHP-SDK/autoload.php");

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AfeDY2h98viukbZisOnzXLY4ZH-Hve_jUStmUz9vAcXvTe0D6y9rTEGZyZEA6hjZuAhRDsEDHv6MMpps',

        'ELvbtNUcMZvpUNk24BS9KHFOfS1I_UsOZ5DXSnBZhWfBYKZz3ill0FLBA4Mh-dBVJ4SV_AC9Q4QoSWQf'
    )
);
?>