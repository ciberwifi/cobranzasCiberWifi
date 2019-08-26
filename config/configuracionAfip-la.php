<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require (CONFIG_PATH."ConfigBaseDeDatos.php");
$afip_res=$rutaBD.$rutaDT."Afip/Laura/Afip_res/";
$CUIT=27350882273;
$sucursal=7;
$codigoFactura=011;
$importes=array(390,490,590,440,540,640,700,750);

?>