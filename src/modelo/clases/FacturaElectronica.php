<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require_once(API_PATH.'AfipWsass/src/Afip.php'); 
include_once (CONFIG_PATH.'configBaseDeDatos.php');
require_once(MODEL_PATH.'logicaNegocio/auxiliares/gestionarArchivos.php');

Class FacturaElectronica {
    // Declaración de una propiedad
    private $CUIT;
	public $Afip;
	private $sucursal;
	private $codigoFactura; //tipo C = 011
	private $montoTotal;
	private $importes;
    // Declaración de un método
	
	
	 public function __construct($CUIT, $sucursal, $codigoFactura, $afip_res,$montoTotal, $importes) {
		
		 
	$this->CUIT=$CUIT;
	$this->sucursal=$sucursal;
	$this->codigoFactura=$codigoFactura;
	$this->montoTotal=$montoTotal;
	$this->importes=$importes;
	$this->Afip=new Afip(array(
				'CUIT' => $CUIT,
				'res_folder' =>$afip_res,
				'cert'=>'cert.crt',
			    'key'=>'key',
				'production'=>TRUE,
				
				));

	}
	
	
  

public function serverStatus(){

$server_status = $this->Afip->ElectronicBilling->GetServerStatus();

echo 'Este es el estado del servidor:';
echo '<pre>';
print_r($server_status);
echo '</pre>';

if($server_status->AppServer=="OK")return (1);

}


public function facturarMes($montoTotal){
		
		$acum=0;
	while ( $acum < $montoTotal){
		
		$acum=$acum+$this->facturar(0);

}
}


//ingresar 0 para importe aleatorio, factura con la fecha de hoy , tipo servicios	
public function facturar($importe){
	global $rutaBD, $rutaDT;
	
	$fecha=date('Y-m-d');
	$hoy=date('Ymd');
	$mes=date('m');
	$anio=date('Y');
	
	$archFacturacion=$rutaBD.$rutaDT."pagos/".$anio."/".$mes."/"."Facturacion".$this->CUIT.".csv";
	
if($importe==0){
	$claveRand=array_rand($this->importes,1);
	 $importe=$this->importes[$claveRand];
	}
	 $importeNeto=round($importe/1.21,2);
	 $iva=round($importeNeto*0.21,2);
	
$data = array(
	'CantReg' 	=> 1,  // Cantidad de comprobantes a registrar
	'PtoVta' 	=> $this->sucursal,  // Punto de venta
	'CbteTipo' 	=> $this->codigoFactura,  // Tipo de comprobante (ver tipos disponibles) 
	'Concepto' 	=> 2,  // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
	'DocTipo' 	=> 99, // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
	'DocNro' 	=> 0,  // Número de documento del comprador (0 consumidor final)
	'CbteDesde' 	=> 1,  // Número de comprobante o numero del primer comprobante en caso de ser mas de uno
	'CbteHasta' 	=> 1,  // Número de comprobante o numero del último comprobante en caso de ser mas de uno
	'CbteFch' 	=> intval(date('Ymd')), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
	'ImpTotal' 	=> $importe, // Importe total del comprobante
	'ImpTotConc' 	=> 0,   // Importe neto no gravado
	'ImpNeto' 	=> $importe, // Importe neto gravado
	'ImpOpEx' 	=> 0,   // Importe exento de IVA
	'ImpIVA' 	=> 0,  //Importe total de IVA
	'ImpTrib' 	=> 0,   //Importe total de tributos
	'MonId' 	=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos) 
	'MonCotiz' 	=> 1,     // Cotización de la moneda usada (1 para pesos argentinos)  
	'FchServDesde'=> date('Ymd',mktime(0, 0, 0, $mes-1, 10, $anio)), 
	'FchServHasta'=> date('Ymd',mktime(0, 0, 0, $mes, 10, $anio)),
	'FchVtoPago'=> $hoy,
	
		
);

$result = $this->Afip->ElectronicBilling->CreateNextVoucher($data);

if(file_exists($archFacturacion)==FALSE){
	$linea="Fecha Factura , Numero Factura, Importe , N° CAE, Vencimiento CAE, Direccion, Nombre y Apelido" ;
	grabarEnArchivo($archFacturacion, $linea);
	}
	
$linea=$fecha.",".$result['voucher_number'].",".$importe.",".$result['CAE'].",".$result['CAEFchVto'].",".",";
		grabarEnArchivo($archFacturacion, $linea);	

return $importe;

}

public function ultimoNumeroFactura(){

$last_voucher = $this->Afip->ElectronicBilling->GetLastVoucher($this->sucursal,$this->codigoFactura); //Devuelve el número del último comprobante creado para el punto de venta 1 y el tipo de comprobante 6 (Factura B)

return $last_voucher;

}	

public function verDatosFactura($numeroFactura){
$voucher_info = $this->Afip->ElectronicBilling->GetVoucherInfo($numeroFactura,$this->sucursal,$this->codigoFactura); //Devuelve la información del comprobante 1 para el punto de venta 1 y el tipo de comprobante 6 (Factura B)

if($voucher_info === NULL){
    echo 'El comprobante no existe';
}
else{
    echo 'Esta es la información del comprobante:';
    echo '<pre>';
    print_r($voucher_info);
    echo '</pre>';
}

}



}


?>