<?php 
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require_once('clases/GestionadorCobranza.php');




function avisoMora () {
	  
	 $mes=date('m');
     $anio= date('y');
	
	
	$Cobranzas=	new GestionadorCobranza($mes,$anio);
	
	$Cobranzas->avisoMora();
	
	
  echo "Avisos Enviados con exito! Puede verificar resultado en RaIntercambio/redes.bas/BaseDatos/SalidaDatos"."\r\n"; 
}






?>
