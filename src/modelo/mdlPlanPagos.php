<?php 
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require_once(MODEL_PATH.'clases/GestionadorCobranza.php');


function ingresarPlanPagos($dni,$capitalAdeudado,$importeCuota,$cantCuotas,$socio){
	
$Cobranzas=	new GestionadorCobranza();

$arrayBusqueda=array();
array_push($arrayBusqueda,$dni);

$result=$Cobranzas->GestionadorTablas->buscarEnTabla($Cobranzas->GestionadorTablas->tablaClientes,$arrayBusqueda, 7);
if(count($result)==0)$result=$Cobranzas->GestionadorTablas->buscarEnTabla($Cobranzas->GestionadorTablas->tablaClientes,$arrayBusqueda, 9);

$fecha="10-04-2019";
$interesTotal=($importeCuota*$cantCuotas)-$capitalAdeudado;

$Cobranzas->ingresarPlanPagos($fecha, $capitalAdeudado, $interesTotal, $importeCuota, $cantCuotas, $result,$socio);

echo "Plan de Pagos Ingresado por: $". $capitalAdeudado. " Cliente ".$result[3]." ".$result[4];
  
}






?>
