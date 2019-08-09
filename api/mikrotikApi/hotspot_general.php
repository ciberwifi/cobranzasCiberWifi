<?php require_once('api_mt_include2.php'); ?>
<?php require_once('cargarClientes.php'); ?>
<?php require_once('gestionarSalidas.php'); ?>
<?php require_once('ConfigMk.php'); ?>
<?php require_once('ApiMk.php'); ?>
<?php


$ApiMk =new ApiMk ();

	
	function cortar () {
			
			$cargarClientes = New CargarClientes ();
			$cargarClientes->cargarClientes();
			
			destruirArchivoSalida($archivoCortados);
			destruirArchivoSalida($archivoDebug);
			destruirArchivoSalida($archivoMenos150);
		
			foreach($cargarClientes->clientesMorososStorage as $clienteMoroso){
				if ($clienteMoroso->idApiUser > -1) {
					if($clienteMoroso->deuda > 150){
						$cortado="cortado".$clienteMoroso->perfil;
						
					$ApiMk->cambiarPerfilUserAndRemove($clienteMoroso->idApiUser, $clienteMoroso->idApiActive, $cortado);
					
					$linea=$clienteMoroso->ip." ".$clienteMoroso->nombreApellido." ".$clienteMoroso->deuda;
					grabarEnArchivo($archivoCortados, $linea);
					}
				}
			
					
			}
			
		
				foreach($cargarClientes->clientesMorososStorage as $clienteMoroso){
					if ($clienteMoroso->idApiUser < 0){
					$linea=$clienteMoroso->ip." ".$clienteMoroso->nombreApellido." ".$clienteMoroso->deuda;
					grabarEnArchivo($archivoDebug, $linea);
					}
		
				}
			foreach($cargarClientes->clientesMorososStorage as $clienteMoroso){
					if ($clienteMoroso->deuda < 151){
					$linea=$clienteMoroso->ip." ".$clienteMoroso->nombreApellido." ".$clienteMoroso->deuda;
					grabarEnArchivo($archivoMenos150, $linea);
					
					}
			}
			echo "El corte fue procesado con exito!.<br/>";
			echo "Archivos de Salida:.<br/>";
			echo "cortados--------- clientes cortados con exito.<br/>";
			echo "clientesDebug---- clientes NO cortados por diferencia entre hospot comment y exel.<br/>";
			echo "clientesMenos150---- clientes NO por deber menos de 150$.<br/>";
			unset ($cargarClientes);
			
			}
			

	


?>