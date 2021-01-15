<?php 

include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require (MODEL_PATH."logicaNegocio/mdlDescargarPagos.php");


$mesActual = date("m");
$anioActual =date("Y");
$fecha=$mesActual."-".$anioActual;
$auto=1;

descargarPagos ($fecha, "la", "ra", $auto);




?>
