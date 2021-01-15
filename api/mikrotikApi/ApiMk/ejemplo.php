<?php
require_once('ApiMk.php'); 

$ApiMk= new ApiMk();

$ApiMk->error ;

//$ip $apellido $nombre tus variables
$ip="3.225";
$apellido="Adrian"; 
$nombre="Roldanz";


$usuario=$ApiMk->buscarUser($ip, $apellido, $nombre);

if($ApiMk->error!=1){
echo $usuario[".id"];
echo $usuario["profile"];
echo$usuario["comment"];
echo $usuario["name"];  //mac address 
}else{
echo "hay un error" ;	
	}
	

?>