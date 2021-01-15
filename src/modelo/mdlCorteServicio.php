<?php 
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require_once('clases/GestionadorCobranza.php');




function corteServicio () {
	  
	 $mes= date('m');
	 $anio= date('y');
	
	
	$Cobranzas=	new GestionadorCobranza($mes,$anio);
	$Cobranzas->cortePorMora($mes, $anio);
	
	
  echo "Servicio interrumpido con exito! Puede verificar resultado en RaIntercambio/redes.bas/BaseDatos/SalidaDatos/cortados"."\r\n"; 
}






?>
