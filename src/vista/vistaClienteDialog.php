<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
 <link rel="stylesheet" href="jquery-ui-1.12.1/jquery-ui-1.12.1.custom/jquery-ui.css">
 
  <title>jQuery UI Dialog - Animation</title>
		<script src="js/vendor/jquery-1.9.1.js"></script>
		<script src="js/vendor/jquery-ui.js"></script>
		
     
  <script>


  
$( function() {
    $( "#tab" ).tabs();
  } );
  

	  $( function openDialog() { 
  
      $( "#dialog" ).dialog({
	  height: 550,
      width: 800,
	  
	  });
	 
	  
    });
	
			
			
			
	
  
  </script>
  
 </head>
<body>
 
<div id="dialog" title=" Cliente"  >
 <div id="tab">
  <ul>
    <li><a href="#datosCliente">Datos</a> </li>
	<li><a href="#planyPagos">Plan y Pagos</a></li>
    <li><a href="#tabs-3">Historial de Soporte</a></li>
  </ul>
  


 
<div id="datosCliente" >

  <?php
 include ("vistaDatosClienteTab.php");
?>
  
	
  
</div>

<div id="planyPagos" >
<?php
 include ("vistaDatosClientePlanPagosTab.php");
?>
</div>	


 
 </div>

 
 </div>
 
 
</body>
</html>