<?php 


require_once('../modelo/mdlProcesarPagos.php');
 
 $fecha= htmlspecialchars($_POST['impFech']);

	procesarPagos($fecha);


 




?>





