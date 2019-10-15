<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require(MODEL_PATH.'clases/GestionadorTablas.php');


/*
$Tablas=	new GestionadorTablas("06","19");
$Tablas->gCargarTablaClientes();

$arrayBusqueda=array();
array_push($arrayBusqueda,"995862002313791");

$result=$Tablas->buscarEnTabla($Tablas->tablaClientes,$arrayBusqueda, 9);

echo $result[3] ;

$fecha="10-02-2019"
*/

echo $mesPasado=date('m-y',mktime(0, 0, 0, 01-1, 1, date('y')));


?>