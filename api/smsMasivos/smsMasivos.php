<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require (CONFIG_PATH."configSmsMasivos.php");


function enviarSms($tel, $mensaje) {
global $usuario, $clave ;

$parametros="";

$url = 'http://servicio.smsmasivos.com.ar/enviar_sms.asp?api=1';
$fields = array(
'usuario' => urlencode($usuario),
'clave' => urlencode($clave),
'tos' => urlencode($tel),
'texto' => urlencode($mensaje),

);
 
//Poner los parámetros en el formato correcto
foreach($fields as $key=>$value) {  $parametros .= $key.'='.$value.'&'; }

$parametros2=rtrim($parametros, "&");

$url = $url . '&' . $parametros2;
//abrir conexión
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//Si lo deseamos podemos recuperar la salida de la ejecución de la URL
echo $resultado = curl_exec($ch);
//cerrar conexión
curl_close($ch);

}

?>