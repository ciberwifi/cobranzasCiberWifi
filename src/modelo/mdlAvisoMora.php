<?php 
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require_once('clases/GestionadorCobranza.php');




function avisoMora () {
	  
	 $mes= "03";
	$anio= "20";
	
	
	$Cobranzas=	new GestionadorCobranza($mes,$anio);
	
	$Cobranzas->avisoFalla();
	
	
  echo "Avisos Enviados con exito! Puede verificar resultado en RaIntercambio/redes.bas/BaseDatos/SalidaDatos"."\r\n"; 
}






?>
