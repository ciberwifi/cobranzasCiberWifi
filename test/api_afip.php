<?php
/*
Habilitar extension=php_soap.dll en php.ini
Laura AFIP 
Sucursal electronica: 6
Sucursal web service: 7
Tipo de comprobante: 011 Factura C
Ultimo numero de comprobante Suc 6: 208
*/
include_once($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require_once(API_PATH.'AfipWsass/src/Afip.php'); 
//require_once(API_PATH.'AfipWsass/nusoap/lib/nusoap.php');
include_once (CONFIG_PATH.'configBaseDeDatos.php');

$afip_res=$rutaBD.$rutaDT."Afip/Laura/Afip_res/";





$afip = new Afip(array(
				'CUIT' => 27350882273,
				'res_folder' =>$afip_res,
				'cert'=>'cert.pem',
			    'key'=>'key',
				));

$server_status = $afip->ElectronicBilling->GetServerStatus();

echo 'Este es el estado del servidor:';
echo '<pre>';
print_r($server_status);
echo '</pre>';





//Crear y asignar CAE a un comprobante
//testeo con sucursal 7 

$data = array(
	'CantReg' 	=> 1,  // Cantidad de comprobantes a registrar
	'PtoVta' 	=> 7,  // Punto de venta
	'CbteTipo' 	=> 011,  // Tipo de comprobante (ver tipos disponibles) 
	'Concepto' 	=> 1,  // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
	'DocTipo' 	=> 99, // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
	'DocNro' 	=> 0,  // Número de documento del comprador (0 consumidor final)
	'CbteDesde' 	=> 1,  // Número de comprobante o numero del primer comprobante en caso de ser mas de uno
	'CbteHasta' 	=> 1,  // Número de comprobante o numero del último comprobante en caso de ser mas de uno
	'CbteFch' 	=> intval(date('Ymd')), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
	'ImpTotal' 	=> 121, // Importe total del comprobante
	'ImpTotConc' 	=> 0,   // Importe neto no gravado
	'ImpNeto' 	=> 100, // Importe neto gravado
	'ImpOpEx' 	=> 0,   // Importe exento de IVA
	'ImpIVA' 	=> 21,  //Importe total de IVA
	'ImpTrib' 	=> 0,   //Importe total de tributos
	'MonId' 	=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos) 
	'MonCotiz' 	=> 1,     // Cotización de la moneda usada (1 para pesos argentinos)  
	'Iva' 		=> array( // (Opcional) Alícuotas asociadas al comprobante
		array(
			'Id' 		=> 5, // Id del tipo de IVA (5 para 21%)(ver tipos disponibles) 
			'BaseImp' 	=> 100, // Base imponible
			'Importe' 	=> 21 // Importe 
		)
	), 
);

$result = $afip->ElectronicBilling->CreateVoucher($data);

echo $result['CAE']; //CAE asignado el comprobante
echo $result['CAEFchVto']; //Fecha de vencimiento del CAE (yyyy-mm-dd)
echo $result['voucher_number']; // numero de comprobante

//Crear y asignar CAE a un comprobante
$result = $afip->ElectronicBilling->CreateNextVoucher($data);


//Obtener número del último comprobante creado
$last_voucher = $afip->ElectronicBilling->GetLastVoucher(7,11); //Devuelve el número del último comprobante creado para el punto de venta 1 y el tipo de comprobante 6 (Factura B)

echo $last_voucher;

?>