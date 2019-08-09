<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
include (CONFIG_PATH.'configBaseDeDatos.php');
require_once(API_PATH.'mikrotikApi/ApiMk.php'); 



$ApiMk= new ApiMk();


$macAddres="00:15:6D:7B:AE:86";
$macAddres1="20:00:00:00:00:01";
$macAddres2="20:00:00:00:00:02";
$macAddres3="20:00:00:00:00:03";
$ip="4.100";
$nombre="taller";
$apellido="afuera";
$ip1="1.1";
$nombre1="Test1";
$apellido2="Api";
$ip2="1.2";
$nombre2="Test2";
$ip3="1.3";
$nombre3="Test3";


test1($ip, $macAddres, $nombre, $apellido);
test1($ip1, $macAddres1, $nombre1, $apellido2);
test1($ip2, $macAddres2, $nombre2, $apellido2);
test1($ip3, $macAddres3, $nombre3, $apellido2);

function test1 ($ip, $macAddres, $nombre, $apellido){
	global $ApiMk;
echo $idApi=$ApiMk->buscarActive($macAddres);
$user=$ApiMk->buscarUser($ip, $nombre,$apellido);
$idUser=$user[".id"];

$ApiMk->cambiarPerfilUserAndRemove($idUser,  $macAddres, "5M");

}
?>