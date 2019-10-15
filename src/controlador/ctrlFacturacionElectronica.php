<?php 


require_once('../modelo/mdlFacturacionElectronica.php');
 
 $cantFacturas= htmlspecialchars($_POST['impCantFacturas']);
 $montoFacturacion= htmlspecialchars($_POST['impMontoFactura']);

 $socio1="";
 $socio2="";
 $socio="";
 $desdeArchivo=0;
 
 if (isset($_POST['checkbox-1'])){
  $socio1= htmlspecialchars($_POST['checkbox-1']); 
	
 	}
	
 if (isset($_POST['checkbox-2'])){
  $socio2= htmlspecialchars($_POST['checkbox-2']); 
 	
	}
if (isset($_POST['checkbox-3'])){
  $socio2= htmlspecialchars($_POST['checkbox-3']); 
 	
	}
if (isset($_POST['checkbox-4'])){
  $socio1= htmlspecialchars($_POST['checkbox-4']); 
 	$desdeArchivo=1;
	}
if (isset($_POST['checkbox-5'])){
  $socio2= htmlspecialchars($_POST['checkbox-5']); 
 	$desdeArchivo=1;
	}	
	
	if($desdeArchivo!==1){
	if(strcmp($socio1, "la")==0)$socio=$socio1;
	if(strcmp($socio2, "ra")==0)$socio=$socio2;
	if(strcmp($socio2, "is")==0)$socio=$socio2;
	
	nuevaFactura($socio, $cantFacturas, $montoFacturacion);
	}else{

	facturarDesdeArchivo($socio1, $socio2);
	}



?>





