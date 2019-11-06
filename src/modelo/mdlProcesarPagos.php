<?php 
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require_once('clases/GestionadorCobranza.php');




function procesarPagos ($fecha) {
	  $fechaRes= explode("-",$fecha) ;
	 $mes= $fechaRes[0];
	$anio= $fechaRes[1];
	
	
	$Cobranzas=	new GestionadorCobranza($mes,$anio);
	$Cobranzas->calcularSaldo($mes, $anio);
	//$Cobranzas->compararSALconGW($mes, $anio);
	
  echo "Pagos ".$fecha." Procesados con exito"."\r\n"; 
}






?>
