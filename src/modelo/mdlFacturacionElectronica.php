<?php 
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require_once('clases/FacturaElectronica.php');




function nuevaFactura($socio, $cantFacturas, $montoTotal) {

	
	if(strcmp($socio, "la")==0){
	echo "Facturacion LA"."\n" ;
	require(CONFIG_PATH.'configuracionAfip-'.$socio.'.php');
	}
	
	if(strcmp($socio, "ra")==0){
	echo "\n"."Facturacion RA"."\n" ;
	require(CONFIG_PATH.'configuracionAfip-'.$socio.'.php');
	}

echo $CUIT;
$facturaElectronica= New FacturaElectronica($CUIT, $sucursal, $codigoFactura, $afip_res,$montoTotal, $importes);

if ($cantFacturas==0)$facturaElectronica->facturarMes($montoTotal);
if ($cantFacturas==1)$facturaElectronica->facturar($montoTotal);

$numFac=$facturaElectronica->ultimoNumeroFactura();
$facturaElectronica->verDatosFactura($numFac);

}

?>
