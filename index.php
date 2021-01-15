<!DOCTYPE html>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
 <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="test api mikrotik">
        <meta name="viewport" content="width=device-width">

   <link rel="stylesheet" href="css/normalize.min.css"> 
        <link rel="stylesheet" href="css/main.css">
	
  <script src="js/jquery.min.js"></script>	
  <script src="js/jquery-ui.min.js"></script>
		
                     
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">Estas usando una version <strong>desactualizada</strong> del navegador. Por favor <a href="http://browsehappy.com/">actualizalo</a> o <a href="http://www.google.com/chromeframe/?redirect=true">o habilite Google chrome Frame</a> para mejorar su experiencia.</p>
        <![endif]-->
	
        <div class="header-container">
	
             <header class="wrapper clearfix"> 
         
		 <img src="img/logo.png" width="80" height="80" border="0"  >
		 
				<h1 class="title"  >CiberWifi</h1> 
				
                <nav>
                    <ul >
					 <li><a href="#Cobranzas" id="btnCobranzas">Cobranzas</a></li>  
                       <li><a href="#AFIP" id="btnAfip">Facturacion</a></li>  
                    <li><a href="#" id="btnCortar">Administracion</a></li>  
                       <li><a href="#" id="btnCortar">Ventas</a></li>  
                     <li><a href="#" id="btnCortar">Soporte Tecnico</a></li> 
					<li><a href="#" id="btnCortar">Infraestructura</a></li>
					<li><a href="#Clientes" id="btnClientes"  >Clientes</a></li>
					</ul>
                </nav>
            </header> 
        </div>
	
        <div class="main-container">
            <div class="main wrapper clearfix">
				
				
				
                <article>
                  <section>
				  
				 
	
	
                    <div id="ajaxMainContenedor"> 
					 
                 </div> 
				 
                  </section>

                </article>
				 <aside >
					
						
					
                    <div id="ajaxBotoneraLateral" ></div>  
              
                </aside>

    
            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
                <h3>CiberWifi@</h3>
            </footer>
        </div>

	

      
       
        <script>
           $.ajaxSetup ({  
				cache: false  
			});
			var ajax_load = "<img src='img/indicator_white_small' alt='loading...' />"; 
			
			$("#btnCobranzas").click(function(){
			var loadUrl = "src/vista/botonerasLaterales/vistaBotoneraLateralCobranzas.php"; // paso parametro accion e id
					$("#ajaxBotoneraLateral").load(loadUrl); // ejecuto
			});	
				$("#btnAfip").click(function(){
					var loadUrl = "src/vista/vistaFacturacionElectronica.php"; // paso parametro accion e id
					$("#ajaxMainContenedor").load(loadUrl); // ejecuto
					
			});	
			$("#btnClientes").click(function(){
					var loadUrl = "src/vista/vistaBuscarCliente.php"; // paso parametro accion e id
					$("#ajaxMainContenedor").load(loadUrl); // ejecuto
					
			});	
			
			
        </script>

    </body>
</html>
