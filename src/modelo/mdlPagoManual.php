<?php 
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require_once(MODEL_PATH.'clases/GestionadorCobranza.php');


function ingresarPagoManual ($dni,$importe, $socio,$detalle) {
	
$Cobranzas=	new GestionadorCobranza();

$arrayBusqueda=array();
array_push($arrayBusqueda,$dni);

$result=$Cobranzas->GestionadorTablas->buscarEnTabla($Cobranzas->GestionadorTablas->tablaClientes,$arrayBusqueda, 7);
if(count($result)==0)$result=$Cobranzas->GestionadorTablas->buscarEnTabla($Cobranzas->GestionadorTablas->tablaClientes,$arrayBusqueda, 9);

$fecha="10-05-2019";
$Cobranzas->ingresarPagoManual($fecha,$socio, $importe, $result, $detalle);

echo "Pago Ingresado Por: $". $importe. " Cliente ".$result[3]." ".$result[4];
  
}






?>
