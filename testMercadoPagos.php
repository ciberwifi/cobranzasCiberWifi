<?php 

require __DIR__  . '/vendor/autoload.php';



//MercadoPago\SDK::setAccessToken("TEST-b448ba5a-a881-4bb2-85ce-0bc3455502ed");      // On Production
MercadoPago\SDK::setAccessToken("TEST-8378829026575849-040719-f635c6413998cc40a1e40263b6bf7aad-50484132"); // On Sandbox
//curl -G -X GET \-H "accept: application/json" \"https://api.mercadopago.com/v1/payments/<payment_id>" \-d "access_token=ACCESS_TOKEN" \-d "status=approved" \-d "offset=0" \-d "limit=10"`
		
	require ('mercadopago.php');

    $mp = new MP ("ENV_ACCESS_TOKEN");

    //$payment = $mp->get(
      //  "/v1/payments/". $paymentId
    //);


?>
