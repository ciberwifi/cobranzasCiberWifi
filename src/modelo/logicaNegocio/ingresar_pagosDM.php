<?php


require('auxiliares/gestionarArchivos.php');
ini_set('max_execution_time', 600);

//El ultimo dia del mes anterior es el dia 0 del mes actual



$diaActual = date('d');
$primerDia = 01 ;
$mesActual = date("m");
$anioActual =date("Y");
$diaHasta=$diaActual;
$arrayTransacciones=array();

function ingresarPagosDM($mes, $anio, $configDM, $auto, $flagSum){
	
	global $diaActual,$diaHasta,$primerDia, $mesActual,$anioActual, $arrayTransacciones;
	
	
if($auto==1 && $diaActual==$primerDia){
	$diaHasta = date('d',mktime(0, 0, 0, $mes, 0, $anio));
		if($mesActual==01)obtenerPagosDM(12 ,31, $anio-1, $configDM);
		else obtenerPagosDM($mes-1 ,$diaHasta, $anio, $configDM, $flagSum);
  }
	
if ($mes !== $mesActual && $anio !== $anioActual ) {
	$diaHasta = date('d',mktime(0, 0, 0, $mes+1, 0, $anio));

}
	echo "Descargando pagos mes: ".$mes."-".$anio."\r\n";  
	
	 obtenerPagosDM($mes,$diaHasta, $anio, $configDM, $flagSum);
	
	
	$cantTrans=count($arrayTransacciones);
	for ($i=0; $i < $cantTrans ; $i++){
		array_pop($arrayTransacciones);
		}

}
function obtenerXML ($email, $cuenta, $pin, $fechaDesde, $fechaHasta) {

$xml="https://argentina.dineromail.com/Vender/ConsultaPago.asp?Email=$email&Acount=$cuenta&Pin=$pin&StartDate=$fechaDesde&EndDate=$fechaHasta&XML=1";

return $xml;

}


function obtenerPagosDesdeXML ($xml,$archivoProcesable){
	
	global $arrayTransacciones;

	$pagos= simplexml_load_file($xml); 
	
	if($pagos ===  FALSE){ 
	echo "error en xml"; 
	}else{ 

 $nTransaccionArray=array();
	
foreach ($pagos->Collections->Collection as $pago):
			
		 $tarjeta=$pago['Trx_id'];
		 $importe=$pago->Trx_Payment;
		 $nTransaccion=$pago->Trx_Number;
		 $importe=explode(".", $importe);
		 $importe=$importe[0];
		 $entidad=substr($pago->Trx_PaymentMean,0,8); 
         $fecha=explode("-", substr($pago->Trx_Date,0,10)); 
		 
		 array_push($nTransaccionArray, $nTransaccion);
		 
		$result = array_intersect($arrayTransacciones, $nTransaccionArray);
		
		if(count($result)==0){
		 
		 $linea=$fecha[2]."-".$fecha[1]."-".$fecha[0].",".$importe.",".$entidad.",".$tarjeta;
					grabarEnArchivo($archivoProcesable, $linea);
			array_push($arrayTransacciones, $nTransaccion);
			}	
			array_pop($nTransaccionArray);
		
endforeach;
}
}

function obtenerPagosDM($mes, $diaActual, $anio, $configDM, $flagSum){
			global $primerDia;
	//gw comun	
	if($flagSum===0){
		$archivoProcesable=obtenerRutaCarpetaCsv($configDM->ruta, $mes, $anio, $configDM->archivoPagosCvs);
		destruirArchivo($archivoProcesable);
		}
	
	if($flagSum!==0)$archivoProcesable=obtenerRutaCarpetaBaseDatosCsv($configDM->ruta, $mes, $anio, $configDM->archivoPagosCvs);
	if($flagSum===1)destruirArchivo($archivoProcesable);
	
		$cantidadIteraciones=floor($diaActual/5);
		
		  
		  $diaHasta=0;
		  
		for ($i=0; $i < $cantidadIteraciones; $i++){

			$diaDesde=01+($i*5);
			$diaHasta=$diaDesde+04;
			
		 $fechaDesde=obtenerFecha ( $mes, $diaDesde, $anio);
		 $fechaHasta=obtenerFecha($mes, $diaHasta, $anio);
	
		 $xml = obtenerXML ($configDM->email, $configDM->cuenta, $configDM->pin, $fechaDesde, $fechaHasta);
		 obtenerPagosDesdeXML ($xml, $archivoProcesable);

	
		}
		
		if($diaActual > $diaHasta){
				if($cantidadIteraciones==0){
					$fechaDesde=obtenerFecha ( $mes, $primerDia, $anio);
					$fechaHasta=obtenerFecha($mes, $diaActual , $anio);
				}else{
					$diaDesde=$diaHasta;
					$fechaDesde=obtenerFecha ( $mes, $diaDesde , $anio);
					$fechaHasta=obtenerFecha($mes, $diaActual, $anio);
				}
		$xml = obtenerXML ($configDM->email, $configDM->cuenta, $configDM->pin, $fechaDesde, $fechaHasta);
		obtenerPagosDesdeXML ($xml,$archivoProcesable);
	}
}



?>
