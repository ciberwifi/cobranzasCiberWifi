<?php 

require_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
include (CONFIG_PATH."configBaseDeDatos.php");

 function grabarEnArchivo($nombreArchivo, $mensaje){
	 
    if($archivo = fopen($nombreArchivo, "a"))
    {
        fwrite($archivo, $mensaje. "\r\n");
        fclose($archivo);
    }
 }
 
 function destruirArchivo($nombreArchivo) {
	 
  if(file_exists($nombreArchivo))
    {
        unlink($nombreArchivo);
    }
 }
 
   function obtenerRutaCarpetaTxt($ruta, $mes, $anioArch, $nombreArchivo) {
	   global $rutaBD;
 $anio=substr($anioArch,2, 3);
$rutaArchivo=$rutaBD.$ruta.$mes.'-'.$anio.'/'.$mes.'-'.$anio.$nombreArchivo;
 return $rutaArchivo ;
}

function obtenerRutaCarpetaCsv($ruta, $mes, $anioArch, $nombreArchivo) {
	   global $rutaBD;
 $anio=substr($anioArch,2, 3);
$rutaArchivo=$rutaBD.$ruta.$mes.'-'.$anio.'/CSV/'.$mes.'-'.$anio.$nombreArchivo;
 return $rutaArchivo ;
}

function obtenerRutaCarpetaBaseDatosCsv($ruta, $mes, $anioArch, $nombreArchivo) {
	   global $rutaBD;
 $anio=substr($anioArch,2, 3);
$rutaArchivo=$rutaBD.$ruta.$anioArch.'/'.$mes.'/'.$mes.'-'.$anio.$nombreArchivo;
 return $rutaArchivo ;
}

function obtenerFecha ($mes, $dia, $anio){

return date('Ymd',mktime(0, 0, 0, $mes, $dia, $anio));

}
/*
function fliltrarRegistrosPorFecha ($dia, $archivo, $archivoSalida){

$vec= file($archivo);

foreach($archivo as $linea ) {
	
	$dato = explode(",", $linea);
	$fecha=explode("-", $dato[0]);
	$diaArch=$fecha[0];

				if($diaArch==$dia){
				grabarEnArchivo($archivoSalida, $linea);	
					}
			}


} 
 */
 
 ?>