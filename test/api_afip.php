<?php
/*
Habilitar extension=php_soap.dll en php.ini
Laura AFIP 
Sucursal electronica: 6
Sucursal web service: 7
Tipo de comprobante: 011 Factura C
Ultimo numero de comprobante Suc 6: 208
*/
include_once($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require_once(API_PATH.'AfipWsass/src/Afip.php'); 
include_once (CONFIG_PATH.'configBaseDeDatos.php');
include_once (CONFIG_PATH.'configBaseDeDatos.php');
require_once(MODEL_PATH.'clases/FacturaElectronica.php');


$afip_res=$rutaBD.$rutaDT."Afip/Laura/Afip_res/";





$afip = new Afip(array(
				'CUIT' => 27350882273,
				'res_folder' =>$afip_res,
				'cert'=>'cert.pem',
			    'key'=>'key',
				));

$server_status = $afip->ElectronicBilling->GetServerStatus();

echo 'Este es el estado del servidor:';
echo '<pre>';
print_r($server_status);
echo '</pre>';




?>