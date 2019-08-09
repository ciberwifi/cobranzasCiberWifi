<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);


 

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
$view=new DOMDocument('1.0','UTF-8');
$table=$view->createElement('table');
$view->appendChild($table);


foreach ($envios as $envio) {
	$tr=$view->createElement('tr');
	$tr->appendChild($view->createElement('td',$envio['resultado_buscado']));
	unset($envio['resultado_buscado']);

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
		$context = stream_context_create($opts);
		$result = file_get_contents($url, false, $context);
	}
	
	
	
	if(is_array($result)){
		error_log(json_encode($result));
		exit();
	}
	$datos=json_decode($result);
	if(isset($envio['metodo_webservice'])){
		$tr->appendChild($view->createElement('td',$envio['metodo_webservice']));
	}
	else{
		$tr->appendChild($view->createElement('td','No hay método.'));
	}
	foreach ($datos as $key => $value) {
		if(!is_string($value)){
			foreach ($value as $a => $b) {
				
				$tr->appendChild($view->createElement('td',$a.'=>'.$b));
			}
		}
		else{
			
			$tr->appendChild($view->createElement('td',$key.'=>'.$value));
		}
	}
	$table->appendChild($tr);
}
 $view->saveHTML();


 return $view;
 
}















?>