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
//require_once(API_PATH.'AfipWsass/src/Afip.php'); 
include_once (CONFIG_PATH.'configBaseDeDatos.php');
include_once (CONFIG_PATH.'configBaseDeDatos.php');
require_once(MODEL_PATH.'clases/FacturaElectronica.php');


$afip_res=$rutaBD.$rutaDT."Afip/Raul/Afip_res/";
$CUIT=23125491979;
$sucursal=6;
$codigoFactura=011; //tipo C = 011
$montoTotal=30000;
$importes=array(390,490,590,440,540,640,700,750);

   
   

$facturaElectronica= New FacturaElectronica($CUIT, $sucursal, $codigoFactura, $afip_res,$montoTotal, $importes);

$var=$facturaElectronica->serverStatus();

//$facturaElectronica->facturar(1000);
echo $numFac=$facturaElectronica->ultimoNumeroFactura();
$facturaElectronica->verDatosFactura($numFac);

?>