
 
 <div  class="vista-formDatosCliente" >
		<div class="cliente">
			<nav >
                    <ul >
					<li><a href="#VerPlanCliente" id="btnVerPlanCliente">Ver</a></li>  
					 <li><a href="#ModificarPlanCliente" id="btnModificarPlanCliente">Modificar</a></li>  
					 <li><a href="#" id="btnCortar">Resumen</a></li>  
                       <li><a href="#" id="btnCortar">P Manual</a></li>  
					    <li><a href="#" id="btnCortar">Aviso Pago</a></li>  
                     
					
					
					</ul>
			<nav>
			
			</div>
		
 
 
 
<div id="ajaxDatosClientePlan">

  
   
  </div>
  
 

  </div>
  
<script>
          
			
			$("#btnVerPlanCliente").click(function(){
					var loadUrl = "src/vista/vistaDatosClienteVerPlan.php"; // paso parametro accion e id
					$("#ajaxDatosClientePlan").load(loadUrl); // ejecuto
					
			});	
			
				$("#btnModificarPlanCliente").click(function(){
					var loadUrl = "src/vista/vistaDatosClienteModificarPlan.php"; // paso parametro accion e id
					$("#ajaxDatosClientePlan").load(loadUrl); // ejecuto
					
			});	
			
			
		
			
			
			
        </script>