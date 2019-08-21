<?php
require_once('auxiliares/gestionarArchivos.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require (API_PATH."cobroDigitalApi.php");

// set de variables


$diaActual = date('d');
$primerDia = 01 ;
$ultimoDia = 0; 
$mesActual = date("m");
$anioActual =date("Y");
$diaHasta=$diaActual;


function ingresarPagosCD($mes, $anio, $configDM, $auto, $flagSum) {

global $diaActual,$diaHasta,$primerDia, $mesActual;


if($auto==1 && $diaActual==$primerDia){
	$diaHasta = date('d',mktime(0, 0, 0, $mes, 0, $anio));
		if($mesActual==01)obtenerPagosCD(12 ,31, $anio-1, $configDM);
		else obtenerPagosCD($mes-1 ,$diaHasta, $anio, $configDM,$flagSum);
  }

if ($mes !== $mesActual && $anio !== $anioActual ) {
	$diaHasta=date('d',mktime(0, 0, 0, $mes+1, 0, $anio));
}		
		
		obtenerPagosCD($mes,$diaHasta, $anio, $configDM, $flagSum);
	
}

function obtenerPagosCD($mes, $diaHasta, $anio, $configDM, $flagSum) {
	global $primerDia;
	
	$envios=array();
		
	 $fechaDesde=obtenerFecha ( $mes, $primerDia, $anio);
	 $fechaHasta=obtenerFecha($mes, $diaHasta, $anio);

	$envios = envios($configDM->comercio, $configDM->sidd, $fechaDesde, $fechaHasta);
	$pagosHtml = obtenerPagos ($envios);
	
	//caso gw 
	if($flagSum===0)$archivoPagosCvs=obtenerRutaCarpetaCsv($configDM->ruta, $mes, $anio ,$configDM->archivoPagosCvs);
	if($flagSum!==0)$archivoPagosCvs=obtenerRutaCarpetaBaseDatosCsv($configDM->ruta, $mes, $anio ,$configDM->archivoPagosCvs);
	
	
	procesarPagos($pagosHtml,$archivoPagosCvs, $mes);

}


function procesarPagos($pagosHtml,$archivoPagosCvs, $mes){
$tags = $pagosHtml->getElementsByTagName('td');
$vec=array();
$vec2=array();


	foreach ($tags as $tag) {
		
		if(is_string($tag->nodeValue)){
			
		 $vec = explode("},", $tag->nodeValue);
			
		}
		
	}	
	/*
			foreach ($vec as $element){
				echo $element;
			$vec2 = explode(",", $element);	
			
				
					 $fecha= explode(":",$vec2[1]) ;
					 $tarjeta=explode(":", $vec2[2]);
					 $email=explode('":"', $vec2[4]);
					 $entidad=explode(":", $vec2[6]);
					 $importe=explode(":", $vec2[8]);
					 $importe= str_replace(".","",$importe);
					 
					
					if(is_string($fecha[1])&& $tarjeta[1] !='null'){
						
						$email2=substr($email[1],5,30);
						
						if(strlen($email2)>3){
							$tarjeta2=substr($email[1],5,30);
							$tarjeta=str_replace('"','',$tarjeta2);
							$tarjetaTab3=substr($tarjeta,0,25); 
							$email55=explode("@", $tarjetaTab3);
							$tarjetaTab=$email55[0]."@";
					
							}else{
							$tarjeta2=$tarjeta[1];
							$tarjeta=str_replace('"','',$tarjeta2);
							$tarjetaTab2=substr($tarjeta,0,15); 
							$tarjetaTab=$tarjetaTab2;
							}
					
					$fecha2=str_replace('"','',$fecha[1]);
					
					$fecha=str_replace('\/','-',$fecha2);
					
					$importe=str_replace('"','',$importe[1]);
					$entidad=str_replace('"','',$entidad[1]);
				
					$comprobarMes=explode("-",$fecha);
					
					if($comprobarMes[1]===$mes){
					echo $linea=$fecha.",".$importe.",".$entidad.",".$tarjetaTab;
					grabarEnArchivo($archivoPagosCvs, $linea);
					}
					
					}
			}
		*/	

}



?>