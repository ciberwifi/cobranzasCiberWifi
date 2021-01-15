<?php

?>

<html>
<script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

			
				<nav >
				
                    <ul  >
					<div >
					<li><a href="#resumenCta" id="btnResumenDeCuenta"> Resumen Cta</a></li>
					<li><a href="#descargarPagos" id="btnDescargarPagos"> Bajar Pagos</a></li>
					<li><a href="#pagoManual" id="btnPagoManual">Pago Manual  </a></li>
					<li><a href="#planPagos" id="btnPlanPagos">Plan Pagos </a></li>
					<li><a href="#procesarPagos" id="btnProcesarPagos">Procesar Pagos </a></li>
					<li><a href="#avisoMora" id="btnAvisoMora">Aviso Mora </a></li>
					<li><a href="#corteServicio" id="btnCorte">Corte Servicio </a></li>
					<li><a href="#descorte" id="btnDescorte">Reconeccion </a></li>
					 
					</div>
					</ul>
                </nav>
				
				<div id="ajaxpr"> 
				</div>
				
 <script src="js/vendor/jquery-1.9.1.js"></script>
<script src="js/vendor/jquery-ui-1.10.2.custom.min.js"></script>
 <script src="js/main.js"></script>
        <script>
           $.ajaxSetup ({  
				cache: false  
			});
			
			//var ajax_load = "<img src='img/indicator_white_small' alt='loading...' />"; 
			
			
			
			$("#btnDescargarPagos").click(function(){
					
					var loadUrl = "src/vista/vistaDescargarPagos.php"; // paso parametro accion e id
					$("#ajaxMainContenedor").load(loadUrl); // ejecuto
					
			});	
			$("#btnPagoManual").click(function(){
					var loadUrl = "src/vista/vistaPagoManual.php"; // paso parametro accion e id
					$("#ajaxMainContenedor").load(loadUrl); // ejecuto
					
			});	
			$("#btnPlanPagos").click(function(){
					var loadUrl = "src/vista/vistaPlanPagos.php"; // paso parametro accion e id
					$("#ajaxMainContenedor").load(loadUrl); // ejecuto
					
		});	
		$("#btnProcesarPagos").click(function(){
					var loadUrl = "src/vista/vistaProcesarPagos.php"; // paso parametro accion e id
					$("#ajaxMainContenedor").load(loadUrl); // ejecuto
					
		});
		$("#btnAvisoMora").click(function(){
					var loadUrl = "src/vista/vistaAvisoMora.php"; // paso parametro accion e id
					$("#ajaxMainContenedor").load(loadUrl); // ejecuto
					
		});
		$("#btnCorte").click(function(){
					var loadUrl = "src/vista/vistaCorteServicio.php"; // paso parametro accion e id
					$("#ajaxMainContenedor").load(loadUrl); // ejecuto
					
		});		
		$("#btnDescorte").click(function(){
					var loadUrl = "src/vista/vistaReconeccion.php"; // paso parametro accion e id
					$("#ajaxMainContenedor").load(loadUrl); // ejecuto
					
		});
		
		$("#btnResumenDeCuenta").click(function(){
					var loadUrl = "src/vista/vistaResumenDeCuenta.php"; // paso parametro accion e id
					$("#ajaxMainContenedor").load(loadUrl); // ejecuto
					
		});
		
		
		
        </script>
				

</html>



