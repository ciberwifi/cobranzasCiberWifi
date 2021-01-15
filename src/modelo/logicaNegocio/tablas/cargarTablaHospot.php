<?php 

include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require_once(API_PATH.'mikrotikApi/ApiMk.php'); 
require_once(MODEL_PATH.'logicaNegocio/auxiliares/gestionarArchivos.php');


function cargarTablaHospot($tablaCli,$tablaHospot,$debugHospot) { 



$arch= file($tablaCli);

	$ai=0;
		
	$ApiMk= new ApiMk();
	
destruirArchivo($tablaHospot);	
destruirArchivo($debugHospot);	
	
  
foreach($arch as $linea ) {
	$dato = explode(",", $linea);
	$fk=$dato[0];
	$ip=$dato[2];
	$apellido=$dato[3];
	$nombre=$dato[4];
	
		$usuario=$ApiMk->buscarUser($ip, $apellido, $nombre);
			if($ApiMk->error==0){
			$idApiUser = trim($usuario[".id"]);
			$perfil= trim($usuario["profile"]);
			$comment=trim($usuario["comment"]);
			$macAddress=trim($usuario["name"]); 
			
			$linea=$ai.",".$fk.",".$idApiUser.",".$perfil.",".$comment.",".$macAddress;
			grabarEnArchivo($tablaHospot, trim($linea));
			$ai=$ai+1;
		
		}else{	
	
		$linea=$fk.",".$dato[2].",".$dato[3].",".$dato[4];
		grabarEnArchivo($debugHospot, $linea);
		
		}	
	}


	
	


}
	


	

?>