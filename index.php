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
             <h1 class="title">Cobranzas Ciberwifi</h1> 
                <nav>
                    <ul >
					 <li><a href="#" id=""></a></li>  
                       <li><a href="#" id=""></a></li>  
                     <li><a href="#planPagos" id="btnPlanPagos">Plan Pagos </a></li>
					<li><a href="#pagoManual" id="btnPagoManual">Pago Manual  </a></li>
					<li><a href="#descargarPagos" id="btnDescargarPagos"> Bajar Pagos</a></li>
					
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
			
        </script>

    </body>
</html>
