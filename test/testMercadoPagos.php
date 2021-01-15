<?php 

include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
//require_once(ROOT_PATH.'AfipWsass/src/Afip.php'); 

require_once(ROOT_PATH.'/vendor/autoload.php');


include(ROOT_PATH.'/vendor/rmccue/requests/library/Requests.php');
Requests::register_autoloader();
$headers = array();
$response = Requests::get('https://api.mercadopago.com/v1/account/settlement_report/:file_name?access_token=ENV_ACCESS_TOKEN', $headers);

?>
