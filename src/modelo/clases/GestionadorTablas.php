<?php

include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
include_once (CONFIG_PATH.'configBaseDeDatos.php');
require_once(MODEL_PATH.'logicaNegocio/tablas/cargarTablaClientes.php');
require_once(MODEL_PATH.'logicaNegocio/tablas/cargarTablaHospot.php');
require_once(MODEL_PATH.'logicaNegocio/auxiliares/gestionarArchivos.php');

Class GestionadorTablas {
    // Declaración de una propiedad
    public $archClientes;
	public $tablaClientes;
    public $tablaHospot;
    public $tablaSaldos;
	public $tablaCortados;
	public $tablaMora;
	public $debugHospot;
	public $logtablaSaldos;
	public $error;
    // Declaración de un método
	
	
	 public function __construct($mes, $anio) {
		 global $rutaBD, $rutaDT, $archClientes, $tablaClientes, $tablaHospot,
		 $tablaSaldos, $debugHospot, $logtablaSaldos, $tablaCortados, $tablaMora;
		echo $mes;
	$this->archClientes=$rutaBD.$rutaDT.$archClientes.$mes."-".$anio.".csv";
	$this->tablaClientes=$rutaBD.$rutaDT.$tablaClientes.$mes."-".$anio.".csv";
	$this->tablaHospot=$rutaBD.$rutaDT.$tablaHospot;
	$this->tablaSaldos=$rutaBD.$rutaDT.$tablaSaldos;
	$this->debugHospot=$rutaBD.$rutaDT.$debugHospot;
	$this->logtablaSaldos=$rutaBD.$rutaDT.$logtablaSaldos;
	$this->tablaCortados=$rutaBD.$rutaDT.$tablaCortados;
	$this->tablaMora=$rutaBD.$rutaDT.$tablaMora;
	$this->error=-1;
	$this->gCargarTablaClientes();
	}
	
	
	public function __destruct()
  {

	  unset($this);
  }
	
	
    public function gCargarTablaClientes() {
        cargarTablaClientes($this->archClientes,$this->tablaClientes);
    }
	
	public function gCargarTablaHospot() {
        cargarTablaHospot($this->tablaClientes,$this->tablaHospot,$this->debugHospot);
	}
	
	

	public function gGuardarTablaCortados($linea) {
        grabarEnArchivo($this->tablaCortados, $linea);
		}

		
	public function gGuardarTabla($tabla, $linea) {
       grabarEnArchivo($tabla, $linea);
		}
	
	public function gDestruirTabla($tabla) {
		destruirArchivo($tabla);
        
		}

	public function buscarTablaPorPk ($tabla,$pk, $posReturn, $pospk) {
	$fk=-1;
	$datoBuscado=-1;
	$encontre=0;
	$vecTabla=file($tabla);
	$this->error=0;
	
	foreach($vecTabla as $linea ) {
				$dato = explode(",", $linea);
				$fk=$dato[$pospk];
				
				if($pk==$fk){
				$encontre=1;
					if($posReturn>=0){
					$datoBuscado=$dato[$posReturn];
					}else{
					$datoBuscado=$dato;
					}
				}else{
				$encontre=-1;
				$this->error=1;
				}

			if($encontre==1)break;
			}
	
	return $datoBuscado;
		
	}
	

	
	public	function buscarEnTabla($tabla, $arrayBusqueda, $posSearch){
	
	$dato =0;
	$arrayDatos=array();
	$arrayDatoBuscado=array();

	$vecTabla=file($tabla);
	
	foreach($vecTabla as $linea ) {
		$dato = explode(",", $linea);
		$datoSearch=trim($dato[$posSearch]);
		$vecDatoSearch=explode(" ", $datoSearch);
			foreach($vecDatoSearch as $datoS ){
			 array_push($arrayDatos, trim($datoS));
				}
	$result = array_intersect($arrayBusqueda, $arrayDatos);
		
	if(count($result)==1){
	$arrayDatoBuscado=$dato;
	
	$this->vaciarArray($arrayDatos);
	break;
		}
	}
			
return $arrayDatoBuscado;		
}
	
private function vaciarArray($array){
$cant=count($array);
	for ($i=0; $i < $cant ; $i++){
		array_pop($array);
		}				
	}	
	
}

?>