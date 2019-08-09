<?php 


require_once('../modelo/mdlDescargarPagos.php');
 
 $fecha= htmlspecialchars($_POST['impFech']);
 $socio1="";
 $socio2="";
 
 if (isset($_POST['checkbox-1'])){
  $socio1= htmlspecialchars($_POST['checkbox-1']); 
	
 	}
	
 if (isset($_POST['checkbox-2'])){
  $socio2= htmlspecialchars($_POST['checkbox-2']); 
 	
	}
	$auto=0;
	descargarPagos($fecha,$socio1, $socio2, $auto);


 




?>





