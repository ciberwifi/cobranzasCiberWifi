<?php 
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require_once('logicaNegocio/ingresar_pagosDM.php');
require_once('logicaNegocio/ingresar_pagosCD.php');
require (CONFIG_PATH."ConfiguracionDM.php");


function descargarPagos ($fecha, $socio1, $socio2, $auto) {
	  $fechaRes= explode("-",$fecha) ;
	 $mes= $fechaRes[0];
	$anio= $fechaRes[1];
	
	
	
	if(strcmp($socio1, "la")==0){
	echo "Pagos LA"."\n" ;
	require(CONFIG_PATH.'configuracionDM-'.$socio1.'.php');
	$configDM= NEW ConfiguracionDM ($socio1, $archivoPagosTxt, $archivoPagosCvs, $email, $cuenta, $pin, $rutaGW, "" , "");
	ingresarPagosDM($mes, $anio,$configDM, $auto,0 );

		}
		
	if(strcmp($socio2, "ra")==0){
		echo "\n"."Pagos RA"."\n" ;
	require(CONFIG_PATH.'configuracionDM-'.$socio2.'.php');
	$configDM= NEW ConfiguracionDM ($socio2, $archivoPagosTxt, $archivoPagosCvs, $email, $cuenta, $pin, $rutaGW, $comercio, $sid);
	//ingresarPagosDM($mes, $anio,$configDM, $auto,0 );
	ingresarPagosCD($mes, $anio,$configDM, $auto,0 );
	
		}
	/*
	require(CONFIG_PATH.'configuracionDM-'.$socio1.'.php');
	$configDM= NEW ConfiguracionDM ($socio1, $archivoPagosTxt, $archivoPagosCvs, $email, $cuenta, $pin, $ruta, "" , "");
	ingresarPagosDM($mes, $anio,$configDM, $auto,1 );
	require(CONFIG_PATH.'configuracionDM-'.$socio2.'.php');
	$configDM= NEW ConfiguracionDM ($socio2, $archivoPagosTxt, $archivoPagosCvs, $email, $cuenta, $pin, $ruta, $comercio, $sid);
	ingresarPagosDM($mes, $anio,$configDM, $auto,2 );
	ingresarPagosCD($mes, $anio,$configDM, $auto,2 );

  echo "Pagos descargados a BASE de DATOS"."\r\n"; 
}

*/


}

?>
