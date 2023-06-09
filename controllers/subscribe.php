<?php
require_once("PayPal-PHP-SDK/autoload.php");
require_once("models/paypal/paypalConfig.php");
require_once("models/billingDetails.php");
require_once("models/users.php");
require_once("auth.php");

$model = new Users();
$user = $model->getUser($userId);


if (isset($_GET['success']) && $_GET['success'] == 'true') {
    $token = $_GET['token'];
    $agreement = new \PayPal\Api\Agreement();



    try {
        $agreement->execute($token, $apiContext);
        $billingDetails = new BillingDetails;
        $result = $billingDetails->insertDetails($agreement, $token, $userId);

        $result = $result && $model->setIsSubscribed(1, $userId);

        if ($result) {
            $user["isSubscribed"] = true;
        }


    } catch (PayPal\Exception\PayPalConnectionException $ex) {
        $wrongMessage = "Something went wrong";
    } catch (Exception $ex) {
        die($ex);
    }
} else if (isset($_GET['success']) && $_GET['success'] == 'false') {
    $cancelledMessage = "User cancelled or something went wrong";
}



require("views/subscribe.php");