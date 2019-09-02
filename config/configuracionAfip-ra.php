<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require (CONFIG_PATH."ConfigBaseDeDatos.php");
$afip_res=$rutaBD.$rutaDT."Afip/Raul/Afip_res/";
$CUIT=23125491979;
$sucursal=6;
$codigoFactura=11;
$importes=array(390,490,590,440,540,640,700,750);

?>