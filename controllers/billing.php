<?php

require_once("PayPal-PHP-SDK/autoload.php");
require_once("models/paypal/paypalConfig.php");
require_once("models/paypal/billingPlan.php");

$id = $plan->getId();


use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\Plan;
use PayPal\Api\ShippingAddress;


$agreement = new Agreement();
$agreement->setName('Subscription to Ductape')
    ->setDescription('Free Trial for 7 days, recurring payments of 9.99€ to Ductape at the end of the trial Period')
    ->setStartDate(gmdate("Y-m-d\TH:i:s\Z", strtotime("+7 days", time())));


$plan = new Plan();
$plan->setId($id);
$agreement->setPlan($plan);


$payer = new Payer();
$payer->setPaymentMethod('paypal');
$agreement->setPayer($payer);

try {

    $agreement = $agreement->create($apiContext);

    $approvalUrl = $agreement->getApprovalLink();
    header("Location: $approvalUrl");
} catch (PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getCode();
    echo $ex->getData();
    die($ex);
} catch (Exception $ex) {
    die($ex);
}
?>