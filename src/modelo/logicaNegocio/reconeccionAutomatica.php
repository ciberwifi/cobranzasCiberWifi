<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
include (CONFIG_PATH.'configBaseDeDatos.php');
require_once(API_PATH.'mikrotikApi/ApiMk.php'); 

require(MODEL_PATH.'logicaNegocio/auxiliares/gestionarArchivos.php');
ini_set('max_execution_time', 600);



//entrada datos
$tablaHospot=$rutaBD.$rutaDT.$tablaHospot;
$archMora=$rutaBD.$rutaDT.$archMora;
$archMoraDescortar=$rutaBD.$rutaDT.$archMoraDescortar;

//salida datos
$archDescortados=$rutaBD.$rutaDT.$archDescortados;
$logDescortados=$rutaBD.$rutaDT.$logDescortados;

$vecDescortar= file($archMoraDescortar);
$vecMora= file($archMora);
$vecHostpot= file($tablaHospot);


$ApiMk= new ApiMk();

foreach($vecDescortar as $linea ) {
	
	$dato = explode(",", $linea);
	echo "pk: ".$pk=$dato[0];
	$fk=-1;
	$saldoDeudor=$dato[7];
	$encontre=0;
	$pago=-1;		
			
			foreach($vecMora as $linea2 ) {
				$dato2 = explode(",", $linea2);
				$pk2=$dato2[0];
		
		
				
				if($pk2==$pk){
				$pago=-1;
				echo "NO pago pk: " .$pk ;

				}else{
				
					echo "pago pk: " .$pk ;
				 $pago=1; //Si no lo encuentro significa que pago
				}

			if($pago==-1)break;
			
		
		}
		
		
			
			if($pago==1){
			
			foreach($vecHostpot as $linea2 ) {
				$hostpotCli = explode(",", $linea2);
				$fk=$hostpotCli[0];
		
				if($fk==$pk){
				$encontre=1;
				}else{
				$encontre=-1;
				}

			if($encontre==1)break;
						
			}

		
		
		
		
	
		
	if ($encontre==1) {
				
				$linea=$fk.",".$dato[1].",".$dato[2].",".$dato[3].",".$dato[4];
				grabarEnArchivo($archDescortados, $linea);
				
				$count=substr_count($hostpotCli[3], "cortado");
				if($count==1){
				$perfil=str_replace("cortado","",$hostpotCli[3]);
				
				$ApiMk->cambiarPerfilUserAndRemove ($hostpotCli[2], $hostpotCli[5], $perfil);
				}


		}
		
			}
		
		
		}
	
	
	
	
	


?>