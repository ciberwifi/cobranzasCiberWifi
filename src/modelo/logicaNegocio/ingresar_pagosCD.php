<?php
require_once('auxiliares/gestionarArchivos.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require (API_PATH."cobroDigitalApi.php");
require_once(CONFIG_PATH."configBaseDeDatos.php");
// set de variables


$diaActual = date('d');
$primerDia = 01 ;
$ultimoDia = 0; 
$mesActual = date("m");
$anioActual =date("Y");
$diaHasta=$diaActual;


function ingresarPagosCD($mes, $anio, $configDM, $auto, $flagSum) {

global $diaActual,$diaHasta,$primerDia, $mesActual, $anioActual;

/*
if($auto==1 && $diaActual==$primerDia){
	$diaHasta = date('d',mktime(0, 0, 0, $mes, 0, $anio));
		if($mesActual==01)obtenerPagosCD(12 ,31, $anio-1, $configDM);
		else obtenerPagosCD($mes-1 ,$diaHasta, $anio, $configDM,$flagSum);
  }
*/
if ($mes !== $mesActual  ) {
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
	$vecTransacciones = obtenerPagos ($envios);
	
	//caso gw 
	if($flagSum===0)$archivoPagosCvs=obtenerRutaCarpetaCsv($configDM->ruta, $mes, $anio ,$configDM->archivoPagosCvs);
	if($flagSum!==0)$archivoPagosCvs=obtenerRutaCarpetaBaseDatosCsv($configDM->ruta, $mes, $anio ,$configDM->archivoPagosCvs);
	
	
	procesarPagos($vecTransacciones,$archivoPagosCvs, $mes);

}


function procesarPagos($vecTransacciones,$archivoPagosCvs, $mes){
	global $rutaBD, $rutaDT;
	$archPagosEmail=$rutaBD.$rutaDT.'pagos/PagosCorreo.csv';
	$vec=array();
	
	foreach ($vecTransacciones as $dat){
	
		$vec = json_decode(json_encode($dat), True);
							
		//echo $vec["Fecha"].",".$vec["Bruto"].",".$vec["Código de barras"].",".$vec["Info"].",".$vec["Nombre"]."\n";
					
		 $fecha= $vec["Fecha"] ;
		 $tarjeta=$vec["Código de barras"];
		 $nombre=$vec["Nombre"];
		 $info=$vec["Info"];
		 $importe=$vec["Bruto"];
		 $importe2=explode(",",$importe);	
		 $importe3 = str_replace(".", "", $importe2[0]);	
		
		$tarjetaTab=substr($tarjeta,0,15); 
		$fecha2=str_replace('/','-',$fecha);
					
		$comprobarMes=explode("-",$fecha2);
		
			if(strlen($nombre)>3){
			$vecPagosEmail=file($archPagosEmail);
			foreach ($vecPagosEmail as $linea){
				$dato = explode(",", $linea);
				$datoSearch=trim($dato[1]);
				if(strcmp(trim($nombre),$datoSearch)===0)$tarjetaTab2=$dato[0];
				$tarjetaTab3=explode("@",$tarjetaTab2);
				$tarjetaTab=$tarjetaTab3[0]."@";
				}
			}				
		if($comprobarMes[1]===$mes && $tarjeta!==null){
		 $linea=$fecha2.",".$importe3.",".$info.",".$tarjetaTab.",".$nombre;
		grabarEnArchivo($archivoPagosCvs, $linea);
			}
					
	}
}
		





?>