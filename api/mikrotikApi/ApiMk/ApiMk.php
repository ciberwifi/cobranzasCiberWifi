<?php 
require_once('api_mt_include2.php'); 
//include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require_once ("ConfigMk.php");
//require_once (MODEL_PATH."logicaNegocio/auxiliares/gestionarArchivos.php");

Class ApiMk {

private $configMk;
private $API;
private $USUARIOS;
private $ACTIVES;
public $error;
private $logg;
public function __construct()
  {

$this->configMk= new ConfigMk();
$this->API = new routeros_api();
$this->API->debug = false;
$this->USUARIOS=$this->obtenerUsers();	
$this->ACTIVES=$this->obtenerActives();			
$this->error=-1;
$this->logg="loginfo.csv"; 
  
  }
  
  public function __destruct()
  {
	  unset($this->configMk);
	  unset($this->API);
	  unset($this->USUARIOS);
	  unset($this->ACTIVES);
	  unset($this);
	  
  }
  
   function grabarEnArchivo($nombreArchivo, $mensaje){
	 
    if($archivo = fopen($nombreArchivo, "a"))
    {
        fwrite($archivo, $mensaje. "\r\n");
        fclose($archivo);
    }
 }


//busca usuario , si encuentra retorna usuario y asigna 0 a error , caso contrario asigna 1 a error
function  buscarUser($ip, $nombre,  $apellido){
	
$encontre=0;
	
		foreach($this->USUARIOS as $key=>$usuario){
		
	
		$pos1 = stripos($usuario["comment"], $ip);
		$pos2 = stripos($usuario["comment"], $apellido." ".$nombre);
		$pos3 = stripos($usuario["comment"], $nombre." ".$apellido);
		

			if($pos1 !==false and ($pos2 !==false or $pos3!==false) ){
			$encontre=1;
			$this->error=0;
			}else{
			$this->error=1;
			}
			if($encontre==1)break;
			}
	if($this->error==1)	{	
	$mensaje="Usuario no encontrado: " .$ip." ".$nombre." ".$apellido;
	$this->grabarEnArchivo($this->logg, $mensaje);
    }	
	return $usuario;		
}
	
	
function  buscarActive($macAddress){
	
$encontre=0;
echo "hola";
		foreach($this->ACTIVES as $key=>$active){
		
				$pos1 = stripos($active["user"], $macAddress);
		echo "api:".$active["user"];
				if($pos1 !==false){
			echo "id:".	$idApiActive = $active[".id"];
				$encontre=1;
				$this->error=0;
				}else{
				$this->error=-1;
				$idApiActive=-1;
				}

			if($encontre==1)break;
}
	return $idApiActive;	
		
}
		
function  cambiarPerfilUserAndRemove($idApiUser,  $macAddress, $profile){
	
	
	 $idApiActive=$this->buscarActive($macAddress);
		echo $idApiActive;
		
		if ($this->API->connect($this->configMk->ip , $this->configMk->username , $this->configMk->pass, $this->configMk->api_puerto)) {	
		
		$this->API->write("/ip/hotspot/user/set",false);
		$this->API->write('=profile='.$profile,false);
		$this->API->write("=.id=".$idApiUser,true);
		$READ = $this->API->read(false);
		$ARRAY = $this->API->parse_response($READ);
		if($idApiActive!==-1){
			echo "p";
		$this->API->write("/ip/hotspot/active/remove",false);
		$this->API->write("=.id=".$idApiActive,true);
		$READ = $this->API->read(false);
		$ARRAY = $this->API->parse_response($READ);
		}
		$this->API->disconnect();

	}

}

function obtenerUsers(){
			if ($this->API->connect($this->configMk->ip , $this->configMk->username , $this->configMk->pass, $this->configMk->api_puerto)) {	
			$this->API->write("/ip/hotspot/user/getall",true);
			$READ = $this->API->read(false);
			$USUARIOS = $this->API->parse_response($READ);
			$this->API->disconnect();
			return $USUARIOS;
			}
		}
		
function obtenerActives(){	
	if ($this->API->connect($this->configMk->ip , $this->configMk->username , $this->configMk->pass, $this->configMk->api_puerto)) {		
			$this->API->write("/ip/hotspot/active/getall",true);
			$READ = $this->API->read(false);
			$ACTIVES = $this->API->parse_response($READ);
			$this->API->disconnect();
			return $ACTIVES;
		}
			}



 
}
?>