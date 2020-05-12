<?php 

require __DIR__  . '../vendor/autoload.php';



MercadoPago\SDK::setAccessToken("ACCESS_TOKEN");      // On Production
MercadoPago\SDK::setAccessToken("TEST_ACCESS_TOKEN"); // On Sandbox


    require ('mercadopago.php');

    $mp = new MP ("ENV_ACCESS_TOKEN");

    $payment = $mp->get(
        "/v1/payments/". $paymentId
    );


?>
