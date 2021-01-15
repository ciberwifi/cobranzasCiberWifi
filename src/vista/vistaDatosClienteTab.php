 
				
<div  class="vista-formDatosCliente cliente" >

			
			 <nav>
			
                    <ul >
					<li><a href="#verDatosCliente" id="btnVerDatosCliente">Ver</a></li> 
					 <li><a href="#modificarCliente" id="btnModificarCliente" >Modificar</a></li>  
                       <li><a href="#" id="btnCortar">Soporte</a></li>  
                     <li><a href="#" id="btnCortar">Baja</a></li> 
					</ul>
				
				
				</nav>			
	

<div id="ajaxDatosCliente">

  
   
  </div>
  
  
  </div>
 
  
   <script>
          
			
			$("#btnVerDatosCliente").click(function(){
					var loadUrl = "src/vista/vistaClienteDatosVer.php"; // paso parametro accion e id
					$("#ajaxDatosCliente").load(loadUrl); // ejecuto
					
			});	
			
				$("#btnModificarCliente").click(function(){
					var loadUrl = "src/vista/vistaClienteDatosModificar.php"; // paso parametro accion e id
					$("#ajaxDatosCliente").load(loadUrl); // ejecuto
					
			});	
			
			
		
			
			
			
        </script>
			
					
			
			



        
			
		
			
			
			
    
	
