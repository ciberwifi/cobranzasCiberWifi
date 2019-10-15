<?php 
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require_once(MODEL_PATH.'clases/GestionadorCobranza.php');


function ingresarPagoManual ($fecha, $dni,$importe, $socio,$detalle) {
	
	$fecha2=explode("-", $fecha);
	$mes=date('m',mktime(0, 0, 0, $fecha2[1], 1, $fecha2[2]));
	$anio=date('y',mktime(0, 0, 0, $fecha2[1], 1, $fecha2[2]));
	
$Cobranzas=	new GestionadorCobranza($mes,$anio);

$arrayBusqueda=array();
array_push($arrayBusqueda,$dni);

$result=$Cobranzas->GestionadorTablas->buscarEnTabla($Cobranzas->GestionadorTablas->tablaClientes,$arrayBusqueda, 7);
if(count($result)==0)$result=$Cobranzas->GestionadorTablas->buscarEnTabla($Cobranzas->GestionadorTablas->tablaClientes,$arrayBusqueda, 9);


$Cobranzas->ingresarPagoManual($fecha,$socio, $importe, $result, $detalle);

echo "Pago Ingresado Por: $". $importe. " Cliente ".$result[3]." ".$result[4];
  
}






?>
