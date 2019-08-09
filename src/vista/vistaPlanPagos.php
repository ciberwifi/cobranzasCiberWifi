<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title> </title>
  <link rel="stylesheet" href="js/jquery-ui.css">
  <link rel="stylesheet" href="js/jquery-ui.theme.css">
  <link rel="stylesheet" href="js/jquery-ui.structure.css">
  
  <style>
    .ui-controlgroup-vertical {
      width: 300px;
	  border: 1px solid #5E8CAE   ;
	  border-radius: 4px;
	  box-shadow: 0 5px 5px #aaa ;
	  padding:1%;
	
	  
    }
    .ui-controlgroup.ui-controlgroup-vertical > button.ui-button,
    .ui-controlgroup.ui-controlgroup-vertical > .ui-controlgroup-label {
      width:150px;
	  text-align: center;
	  margin :1% 0 5% 0;
	  
	  
    }
	
	
	
    .ui-controlgroup-horizontal .ui-spinner-input {
      width: 20px;
	  
	  
	  
    }
	
	
	.ui-progressbar {
    position: relative;
  }
  .progress-label {
    position: absolute;
    left: 50%;
    top: 4px;
    font-weight: bold;
    text-shadow: 1px 1px 0 #fff;
  }
  
  </style>
  
 
  <script>
  $( function() {
    $( ".controlgroup" ).controlgroup()
    $( ".controlgroup-vertical" ).controlgroup({
      "direction": "vertical"
    });
  } );
  
	$( function() {
    $( "input" ).checkboxradio({
      icon: false
    });
  } );
  
  function stopDefAction(evt) {
	evt.preventDefault();
	}
	
	 $( function() {
    var progressbar = $( "#progressbar" ),
      progressLabel = $( ".progress-label" );
 
    progressbar.progressbar({
      value: false,
      change: function() {
        progressLabel.text( progressbar.progressbar( "value" ) + "%" );
      },
      complete: function() {
        progressLabel.text( "Complete!" );
      }
    });
 
    function progress() {
      var val = progressbar.progressbar( "value" ) || 0;
 
      progressbar.progressbar( "value", val + 2 );
 
      if ( val < 99 ) {
        setTimeout( progress, 800 );
      }
    }
 
    setTimeout( progress, 2000 );
  } );
  
  </script>
</head>
<body>


<div class="widget">
  
  <fieldset>
	
	
   <form id="formConsultaSaldo"> 
    <div class="controlgroup-vertical">

	
 
      <h2>Ingrese DNI o Tarjeta para identificar Cliente:</h2>
      <input id="impDni" name="impDni" placeholder="39228775" type="text-align:center">
	 
	 <h4>Ingrese Capital Adeudado:</h2>
      <input id="impCapital" name="impCapital" placeholder="2500" type="text-align:center">
	 
	 <h4>Ingrese Importe Cuota:</h2>
      <input id="impImporteCuota" name="impImporteCuota" placeholder="400" type="text-align:center">
	 
	 <h4>Ingrese Cantidad Cuotas:</h2>
      <input id="impCantCuotas" name="impCantCuotas" placeholder="3" type="text-align:center">
	 
	 
	  </br>
	  </br>
	    <fieldset>
    
    <label for="checkbox-1">LA</label>
    <input type="checkbox" name="checkbox-1" id="checkbox-1" value="la" >
    <label for="checkbox-2">RA</label>
    <input type="checkbox" name="checkbox-2" id="checkbox-2" value="ra">
   </fieldset>
   </br>
<button id="btnBuscar" onclick="stopDefAction(event)"; >Aceptar!</button>
</div>
	
	  </form> 
	
	
	<div id="RsltContenedor" class="hidden"  >
	<div  id ="RsltConsultaSaldo" class="controlgroup-vertical">
	<div id="progressbar"><div class="progress-label">Loading...</div>
	 
	</div>
	 </div>
	 


</div>
 </fieldset>  

</div>

	
        <script>

	
		
	
		$("button[id=btnBuscar]").click(function(){
	    document.querySelector("#" + "RsltContenedor").className = "visibility";
		
			var data = $("#formConsultaSaldo").serialize();
			$.post("src/controlador/ctrlPlanPagos.php", data ,function(result) {	
				 $("#RsltConsultaSaldo").html(result);
			});
		  
		});


	
</script>
 
</body>
</html>