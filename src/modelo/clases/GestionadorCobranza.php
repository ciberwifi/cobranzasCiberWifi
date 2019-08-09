<?php
error_reporting(E_ALL ^ E_NOTICE);
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require_once(MODEL_PATH.'clases/GestionadorTablas.php');
include_once (CONFIG_PATH.'configBaseDeDatos.php');
require_once(API_PATH.'mikrotikApi/ApiMk.php'); 
require_once(API_PATH.'smsMasivos/smsMasivos.php'); 
require_once(MODEL_PATH.'logicaNegocio/auxiliares/gestionarArchivos.php');



Class GestionadorCobranza {
    // Declaración de una propiedad
    public  $GestionadorTablas;
	private $ApiMK;
	private $logMora;
	private $archCortados;
	private $archAvisoPago;
	private $archDescortados;
	private $error;
    // Declaración de un método
	
	
	 public function __construct() {
		 global $rutaBD, $rutaDT, $logMora, $archCortados, $archAvisoPago,$archDescortados;
		 
	$this->GestionadorTablas=new GestionadorTablas();
	$this->ApiMk=new ApiMk();
	$this->logMora=$rutaBD.$rutaDT.$logMora;
	$this->archCortados=$rutaBD.$rutaDT.$archCortados;
	$this->archAvisoPago=$rutaBD.$rutaDT.$archAvisoPago;
	$this->archDescortados=$rutaBD.$rutaDT.$archDescortados;
	}
	
	
	public function __destruct()
  {

	  unset($this);
  }
	
	
public function ingresarPagoManual($fecha, $socio, $importe, $arrayCliente, $detalle){	
	global $rutaBD, $rutaDT;
	
	echo $socio;
	
	$fecha2=explode("-", $fecha);
	 $mes=date('m',mktime(0, 0, 0, $fecha2[1], 1, $fecha2[2]));
	 $anio=date('y',mktime(0, 0, 0, $fecha2[1], 1, $fecha2[2]));
	
	 $MANUAL=$rutaBD.$rutaDT."pagos/"."20".$anio."/".$mes."/".$mes."-".$anio."M.csv";
	 
	 $tarjeta=explode(" ",$arrayCliente[9]);
	 $linea=$fecha.",".$importe.",".$detalle.",".$tarjeta[0].",".$arrayCliente[3].",".$arrayCliente[4];
		grabarEnArchivo($MANUAL, $linea);			

	if(strcmp($socio, "la")==0){
		$MANUAL=$rutaBD."/system.LAU/".$mes."-".$anio."/CSV/".$mes."-".$anio."M.csv";
		$linea=$fecha.",".$importe.",".$detalle.",".$tarjeta[0].",".$arrayCliente[3].",".$arrayCliente[4];
		grabarEnArchivo($MANUAL, $linea);
	}
	if(strcmp($socio, "ra")==0){
		$MANUAL=$rutaBD."/system.new/".$mes."-".$anio."/CSV/".$mes."-".$anio."M.csv";
		$linea=$fecha.",".$importe.",".$detalle.",".$tarjeta[0].",".$arrayCliente[3].",".$arrayCliente[4];
		grabarEnArchivo($MANUAL, $linea);
    }

	
	}
	
public function ingresarPlanPagos($fecha, $capitalAdeudado, $interesTotal, $importeCuota, $cantCuotas, $arrayCliente,$socio){	
	global $rutaBD, $rutaDT;
	
	$fecha2=explode("-", $fecha);
	 $mes=date('m',mktime(0, 0, 0, $fecha2[1], 1, $fecha2[2]));
	 $anio=date('y',mktime(0, 0, 0, $fecha2[1], 1, $fecha2[2]));
	
	 $PLAN=$rutaBD.$rutaDT."pagos/"."20".$anio."/"."PlanPagos.csv";
	 
	 $tarjeta=explode(" ",$arrayCliente[9]);
	 $linea=$fecha.",".$capitalAdeudado.",".$interesTotal.",".$importeCuota.",".$cantCuotas.",".$tarjeta[0].",".$arrayCliente[3].",".$arrayCliente[4];
		grabarEnArchivo($PLAN, $linea);			

	$this->ingresarPagoManual($fecha,$socio,$capitalAdeudado, $arrayCliente, "Plan Pagos");
	
	$fecha2=explode("-", $fecha);
	for ($i=0; $i < $cantCuotas ; $i++){
		
		$mes=date('m',mktime(0, 0, 0, $fecha2[1]+$i, 1, $fecha2[2]));
		$anio=date('y',mktime(0, 0, 0, $fecha2[1]+$i, 1, $fecha2[2]));
		$fechaPlan="01-".$mes."-".$anio;
		$this->ingresarPagoManual($fechaPlan,$socio, -$importeCuota, $arrayCliente, "Cuota Plan ".($i+1)."/".$cantCuotas);
		
		}				
	

	}
public function verificarDifieren($SUM,$DIFIEREN){
	$vecSum=file($SUM);
	$arrayTarjetas=array();
	
	
	foreach($vecSum as $linea ) {
		$dato = explode(",", $linea);
		$datoSearch=trim($dato[3]);
		array_push($arrayTarjetas, $datoSearch);
		
		$tablaCli=$this->GestionadorTablas->tablaClientes;
		$pago=$this->buscarTarjeta($tablaCli,$arrayTarjetas,9,3);
		
		if($pago[0]===-1 ){
		$linea="DIFIEREN: ". $dato[0].",".$dato[1].",".$dato[2].",".$datoSearch;
		grabarEnArchivo($DIFIEREN, $linea);		
		}
		array_pop($arrayTarjetas);
	}
}	
	
public function compararSALconGW($mes, $anio){
		global $rutaBD, $rutaDT;
		$mes=date('m',mktime(0, 0, 0, $mes, 1, $anio));
		$SAL=$rutaBD.$rutaDT."pagos/"."20".$anio."/".$mes."/".$mes."-".$anio."SAL.csv";
		$SALGW=$rutaBD.$rutaDT."pagos/"."20".$anio."/".$mes."/".$mes."-".$anio."SALGW.csv";
		$DIFgwWEB=$rutaBD.$rutaDT."pagos/"."20".$anio."/".$mes."/".$mes."-".$anio."DIFwebGw.csv";
		$vecSal= file($SAL);
		destruirArchivo($DIFgwWEB);
		
		
		foreach($vecSal as $linea ) {
			$arrayTarjetas=array();	
			$dato = explode(",", $linea);
			$tarjeta=$dato[3];
			$salWeb=$dato[8];
			
			array_push($arrayTarjetas, $tarjeta);
			
	
		$salGw=$this->buscarTarjeta($SALGW,$arrayTarjetas,2,3);
		
		if(trim($salWeb)!==trim($salGw[1])){
			$lin="hay una diferencia en tar: ".$dato[1].",".$tarjeta.","." salweb: ".trim($salWeb).",". " salGw: ".trim($salGw[1]);
				grabarEnArchivo($DIFgwWEB,$lin);
		}
		//$this->vaciarArray($arrayTarjetas);
		}
}	
private function acortarTj($tarjeta){
	$newtar=$tarjeta;
		if(stripos($tarjeta,"9")===0){
			$newtar=substr($tarjeta,4,-1);	
		}
		
	return $newtar;	
}
private function vaciarArray($array){
$cant=count($array);
	for ($i=0; $i < $cant ; $i++){
		array_pop($array);
		}				
	}
	
private	function buscarTarjeta($tabla, $arrayTarjetas, $posSearch, $posReturn){
	$debug="debug.csv";
	$dato =0;
	$arrayTarjetaSal=array();
	$datoBuscado=array();
	array_push($datoBuscado, -1);
	$arrayResult=array();
	
	$vecTabla=file($tabla);
	foreach($vecTabla as $linea2 ) {
		$dato = explode(",", $linea2);
		$datoSearch=trim($dato[$posSearch]);
					
		//varias tj
		$vecDatoSearch=explode(" ", $datoSearch);// por si hay mas de una tj
					
			if(count($vecDatoSearch)!==1){
				foreach($vecDatoSearch as $datoS ){
				//echo $datoS;					
				array_push($arrayTarjetaSal, trim($datoS));
				}
			$b=array_map(array($this,'acortarTj'),$arrayTarjetaSal);	
			$arrayTarjetaSal=$b;	
			}else{//una sola tj
					
				if(stripos($datoSearch,"6")===0){
				$b=array_map(array($this,'acortarTj'),$arrayTarjetas);
				$arrayTarjetas=$b;
				}
			array_push($arrayTarjetaSal,$datoSearch);
			}	
	$result = array_intersect($arrayTarjetas, $arrayTarjetaSal);
		if(count($result)==1){
		array_push($arrayResult, trim($dato[$posReturn]));
		$datoBuscado[0]=1;
		array_pop($arrayTarjetaSal); // creo que hay que vaciar todo el array para que DIFIEREN funcione
		}
	}
			
array_push($datoBuscado, array_sum($arrayResult));		
return $datoBuscado;		
}
	
public function calcularSaldo($mes, $anio){	
	global $rutaBD, $rutaDT;
	 $mes=date('m',mktime(0, 0, 0, $mes, 1, $anio));
	 
	 
	 $mesAnterior=date('m',mktime(0, 0, 0, $mes-1, 1, $anio));
	 $anioCons=date('y',mktime(0, 0, 0, $mes-1, 1, $anio));
	
	
	 $MANUAL=$rutaBD.$rutaDT."pagos/"."20".$anio."/".$mes."/".$mes."-".$anio."M.csv";
	 $SUM=$rutaBD.$rutaDT."pagos/"."20".$anio."/".$mes."/".$mes."-".$anio."SUM.csv";
	 $SALanterior=$rutaBD.$rutaDT."pagos/"."20".$anioCons."/".$mesAnterior."/".$mesAnterior."-".$anioCons."SAL.csv";
	 $SAL=$rutaBD.$rutaDT."pagos/"."20".$anio."/".$mes."/".$mes."-".$anio."SAL.csv";
	 $DEBUG=$rutaBD.$rutaDT."pagos/"."20".$anio."/".$mes."/".$mes."-".$anio."DEBUG.csv";
	 $DIFIEREN=$rutaBD.$rutaDT."pagos/"."20".$anio."/".$mes."/".$mes."-".$anio."DIFIEREN.csv";
	 destruirArchivo($DIFIEREN);
	 destruirArchivo($SAL);
	 destruirArchivo($DEBUG);
	 
	$vecTablaCli= file($this->GestionadorTablas->tablaClientes);
	
	foreach($vecTablaCli as $linea ) {
	$debug=0;
	$dato = explode(",", $linea);
	$tarjetas=$dato[9];
	$montoPlan=$dato[11];
	$arrayTarjetas=explode(" ", $tarjetas);
	//3.8
	$salAnt=$this->buscarTarjeta($SALanterior,$arrayTarjetas,5,10);
	$pago=$this->buscarTarjeta($SUM,$arrayTarjetas,3,1);
	$manual=$this->buscarTarjeta($MANUAL, $arrayTarjetas,3, 1);
	$pk=$dato[0];
	

		// nuevo o debug 	
		if($salAnt[0]===-1 ){	
			$fechaAlta=	trim($dato[10]);
			$mes1=explode("/", $fechaAlta);
			$mes2=explode("-", $fechaAlta);
			if($mes1[1]===$mes OR $mes2[1]===$mes){
				$salAnt[1]=0;
			}else{
				$debug=1;
			}
		}
		//calcula saldo cliente
		if($debug===0)	{
			$saldo=$salAnt[1]-$montoPlan;
			if($pago[0]!==-1 )$saldo=$saldo+$pago[1];
			if($manual[0]!==-1 )$saldo=$saldo+$manual[1]; 
				
		$linea=$pk.",".$dato[2].",".$dato[3].",".$dato[4].",".$dato[5].",".$arrayTarjetas[0].",".$salAnt[1].",".$montoPlan.",".$pago[1].",".$manual[1].",".$saldo;
		grabarEnArchivo($SAL, $linea);	
		}
	
		if($debug===1){
		$linea="DEBUG: SIN PROCESAR: ". $dato[2].",".$dato[3].",".$dato[4];
		grabarEnArchivo($DEBUG, $linea);	
		}
	}
//$this->verificarDifieren($SUM,$DIFIEREN);	
return $SAL;
}
	
	
 

function avisoMora(){
	
ini_set('max_execution_time', 600);

$mensajeAviso="Presenta saldos vencidos -Evite interrupciones- regularice en las proximas 48hs -Ultimos Mov http://ciberwifi.ddns.net/resumen.php -Saldo a la fecha ";

$this->verificarPagos();

$vecMora= file($this->gestionadorTablas->tablaMora);

destruirArchivo($this->archAvisoPago);

foreach($vecMora as $linea ) {
	
	$dato = explode(",", $linea);
	$pk=$dato[0];
	$saldoPlan=$dato[6];
	$saldoDeudor=$dato[7];
	
			
	if($this->gestionadorTablas->error!==1) {
		
		if( $saldoDeudor > 100  ) {
				
				
			$linea=$fk.",".$dato[2].",".$dato[3].",".$dato[4].",".$saldoPlan.",".trim($saldoDeudor);
			grabarEnArchivo($this->archAvisoPago, $linea);
			$tel=$dato[5];
			enviarSms($tel, $mensajeAviso.abs($saldoDeudor));
			}
		}
	}
}

public function cortePorMora($mes, $anio){
	
global $rutaBD, $rutaDT;

$mes=date('m',mktime(0, 0, 0, $mes, 1, $anio));	

$SAL=$this->calcularSaldo($mes, $anio);
	
ini_set('max_execution_time', 600);

$mensajeCorte="Servicio interrumpido por Mora -Consulte P1an Pagos- Ultimos Mov http://ciberwifi.ddns.net/resumen.php -Reconeccion Automatica- Saldo deudor ";

$vecMora= file($SAL);

$this->GestionadorTablas->gCargarTablaHospot();
$tablaHospot=$this->GestionadorTablas->tablaHospot;

destruirArchivo($this->archCortados);

foreach($vecMora as $linea ) {
	
	$dato = explode(",", $linea);
	$pk=$dato[0];
	$tel=$dato[4];
	$saldoPlan=$dato[7];
	$saldoDeudor=$dato[10];
	$pos=-1; //porque quiero todo el vec
	
if(  -200 > $saldoDeudor  ) {
	
	$hostpotCli=$this->GestionadorTablas->buscarTablaPorPk ($tablaHospot,$pk, $pos, 1);
			
	if(count($hostpotCli)>0) {
		
		//case corte
	
				 $linea2=$pk.",".$dato[1].",".$dato[2].",".$dato[3].",".$saldoPlan.",".trim($saldoDeudor).",".$hostpotCli[2];
				grabarEnArchivo($this->archCortados, $linea2);
				
				//$this->GestionadorTablas->gGuardarTablaCortados($linea);
				
				$this->ApiMk->cambiarPerfilUserAndRemove ($hostpotCli[2], $hostpotCli[5], "cortado".$hostpotCli[3]);
			
				enviarSms($tel, $mensajeCorte.abs($saldoDeudor) );
			}
		}
	}
}

public function reconeccion(){
	
global $rutaBD, $rutaDT;

$dia=date('d');	
$anio=date('y');
$mes=date('m',mktime(0, 0, 0, date('m'), 1, date('y')));	

$SAL=$this->calcularSaldo($mes, $anio);

	
$vecCortados=file($this->archCortados);

$this->GestionadorTablas->gCargarTablaHospot();
$tablaHospot=$this->GestionadorTablas->tablaHospot;

	
	
	foreach($vecCortados as $linea ) {
		$dato = explode(",", $linea);
		$pk=$dato[0];
		$pos=-1; 
	
	
	$saldoCliente=$this->GestionadorTablas->buscarTablaPorPk ($SAL,$pk, $pos,0);
	
	//echo $linea ."saldo ". $saldoCliente;
	
	$saldoCli=$saldoCliente[10];
	if($dia < 11)$saldoCli=$saldoCli+$saldoCliente[7];
	 //echo "  ". $saldoCli.$saldoCliente[2].$saldoCliente[10];
	 
	if(  $saldoCli > -200   ) {
		
		$pos=-1;
		$hostpotCli=$this->GestionadorTablas->buscarTablaPorPk ($tablaHospot,$pk, $pos,1);
			
	if(count($hostpotCli)>0) {
						
						$count=substr_count($hostpotCli[3], "cortado");
						if($count==1){
						$perfil=str_replace("cortado","",$hostpotCli[3]);
						
						$this->ApiMk->cambiarPerfilUserAndRemove ($hostpotCli[2], trim($hostpotCli[5]), $perfil);
						
						}
						$linea2=trim($linea).",".trim($saldoCliente[10]);
						grabarEnArchivo($this->archDescortados, $linea2);
					}
				}
	}
}



}




?>