<?php 
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require (MODEL_PATH."mdlProcesarPagos.php");


$mesActual = date("m");
$anioActual =date("y");
$fecha=$mesActual."-".$anioActual;


procesarPagos ($fecha);

echo "<script>window.close();</script>";
?>
