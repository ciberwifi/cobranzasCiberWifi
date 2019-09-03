<?php

//error_reporting(E_ERROR | E_WARNING | E_PARSE);


 

function envios ($comercio, $sid, $fechaDesde, $fechaHasta){
	
	 $envios[]=array('idComercio'=>$comercio,
					'sid'=>$sid,
					'metodo_webservice'=>'consultar_transacciones',
					'desde'=>$fechaDesde,
					'hasta'=>$fechaHasta);

					return $envios;
}


function obtenerPagos ($envios){
	
	
	
$url='https://www.cobrodigital.com:14365/ws3/';
$conexion='get'; # Opciones: 'post','get','nusoap'



foreach ($envios as $envio) {
	

	$postdata = http_build_query($envio);
	
	if($conexion=='get'){
		# CONEXION GET
		$url=explode('?', $url)[0];
		$opts = array('https' =>
		    array(
		        'method'  => 'GET'
		    )
		);
		$url.='?'.$postdata;
		//var_dump ($postdata);
		$context = stream_context_create($opts);
		$result = file_get_contents($url, false, $context);
	}
	
	
	
	if(is_array($result)){
		error_log(json_encode($result));
		exit();
	}
	
	$datos=json_decode($result);
	//var_dump($datos);
	$transaccion=array();
	$vec=array();
		foreach ($datos as $dato){
		//	echo "DATO", "\n";
			//var_dump ($dato);
				if(is_array($dato)){
					//echo "is array", "\n";
					
						if(is_string($dato[0])){
						//echo $dato[0];
						//var_dump ($dato);
						}else{
						
						$vec=$dato[0];	
						
					}
					}
					
				if(is_string($dato)){
					//echo "is string", "\n";
					//var_dump ($dato);
					}
			
		}
}

return $vec;
}













?>