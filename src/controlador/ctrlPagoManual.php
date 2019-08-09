<?php 


require_once('../modelo/mdlPagoManual.php');
 
 $dni= htmlspecialchars($_POST['impDni']);
 $importe= htmlspecialchars($_POST['impImporte']);
 $detalle= htmlspecialchars($_POST['impDetalle']);
 $socio1="";
 $socio2="";
 $socio="";
 if (isset($_POST['checkbox-1'])){
  $socio1= htmlspecialchars($_POST['checkbox-1']); 
	
 	}
	
 if (isset($_POST['checkbox-2'])){
  $socio2= htmlspecialchars($_POST['checkbox-2']); 
 	
	}
	
	if(strcmp($socio1, "la")==0)$socio=$socio1;
	if(strcmp($socio2, "ra")==0)$socio=$socio2;
	
	
	ingresarPagoManual($dni,$importe,$socio,$detalle);


 




?>





