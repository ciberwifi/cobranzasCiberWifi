
<html lang="en">


<body>  
 
 
<div id="cliente" class="hidden" >
</div>

  <form id="formBusquedaCliRst" method="post" action="enviar.php" class="vista-formGeneral vista-formBuscar">

  
  
  <h2  >Buscar Cliente:</h2>
  
 <section>
	<div>
	<ul>
		<li>Filtar Por:</li>
	<li>
	<select  autofocus  id="tipoFiltro"  >
	<option   value="">Seleccione </option>
	<option value="OptNombre">Nombre y Apellido </option>
	<option value="OptDni">DNI</option>
	<option value="OptDireccion">Direccion</option>
	<option value="OptIp">IP</option>
	</select>
	</li>
	</ul>
	
	
	<div id="OptNombre" class="hidden">
	
	<ul>
		<li>Nombre:</li>
		<li><input autofocus type="text" placeholder="Juan" > </li>
	</ul>
	<ul>	
		<li>Apellido:</li>
		<li> <input  type="text" placeholder="Perez"> </li>
	</ul>
	</div>
	
	<div id="OptDni" class="hidden">
	<ul>
		<li>DNI:</li>
		<li><input  type="text" placeholder="30255446" ></li>
		
	</ul>
	</div>
	<div id="OptDireccion" class="hidden">
	<ul>
		<li>Tipo Domicilio</li>
	<li>
	<select name="tipoDomicilio" id="tipoDomicilioSelect"  >
	<option value="">Seleccione </option>
	<option value="OptEdif">Edificio </option>
	<option value="OptCasa">Casa</option>
	</select>
	</li>
	</ul>
	
	<div id="OptEdif" class="hidden">
	
	<ul>
		<li>Localidad:</li>
	<li>
	<select required>
	<option value="">Seleccione </option>
	<option value=""> Laferrere</option>
	<option value=""> Isidro Casanova </option>
	</select>
	</li>
	</ul>
	
	<ul>
		<li>Barrio:</li>
	<li>
	<select required>
	<option value="">Seleccione </option>
	<option value=""> B20 Junio </option>
	<option value=""> Terrabuela </option>
	</select>
	</li>
	</ul>
	
	
	<ul>
		<li>Edificio:</li>
	<li>
	<select required>
	<option value="">Seleccione </option>
	<option value=""> Edif 12</option>
	<option value=""> Edif Terrabuela </option>
	</select>
	</li>
	</ul>
	
	
	<ul>
		<li>Entrada/ Palier</li>
	<li>
	<select required>
	<option value="">Seleccione </option>
	<option value=""> 1 </option>
	<option value=""> 2 </option>
	<option value=""> A </option>
	</select>
	</li>
	</ul>
	
	<ul >
		<li>Piso</li>
		<li><input  class="inputform" type="text"></li>
		
	</ul>
	
	
	<ul>
		<li>Depto</li>
		<li><input class="inputform" type="text"></li>
		
	</ul>
	</div> 
	
	<div id="OptCasa" class="hidden">
	<ul >
		<li>Calle:</li>
		<li><input  type="text" placeholder="weisman"></li>
		
	</ul>
	<ul >
		<li>Altura:</li>
		<li><input class="inputform" type="number" placeholder="1141"></li>
		
	</ul >
	
	<ul>
		<li>Localidad:</li>
	<li>
	<select required>
	<option value="">Seleccione </option>
	<option value=""> Laferrere</option>
	<option value=""> Isidro Casanova </option>
	</select>
	</li>
	</ul>
	</div>
	
</div>	
<div id="OptIp" class="hidden">
	<ul >
		<li>IP:</li>
		<li><input id="impIp" name="impIp" type="text" placeholder="3-100"></li>
		
	</ul>

</div>
<div>

<button id="tipoBuscar" class="buttonRelative" type="submit">Buscar</button>
</div>
</div>

</form>

<div id="resultadosTabla"class="hidden"  >

 
	  <table id="tablaClientes">
	  <tr>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>DNI</th>
		<th>Direccion</th>
		
	</tr>
	<tr>
		<td>John</td>
		<td>Doe</td>
		<td>35088778</td>
		<td> Weisman 1141</td>
	</tr>
	
	  </table>
	
   
   </div>
   
   </section>
 
 
 
		<script>
    
  
	$.ajaxSetup ({  
				cache: false  
			});
	
	document.querySelector("#tipoFiltro").addEventListener("change", function(){
		 
    if (this.value.length){
		document.querySelector("#"+"OptNombre").className = "hidden";
		document.querySelector("#"+"OptDni").className = "hidden";
       document.querySelector("#"+"OptDireccion").className = "hidden";
		  document.querySelector("#"+"OptIp").className = "hidden";
	   document.querySelector("#" + this.value).className = "visibility";
		
    }
   
	}, false);
	
	document.querySelector("#tipoDomicilioSelect").addEventListener("change", function(){
		 
    if (this.value.length){
		document.querySelector("#"+"OptCasa").className = "hidden";
		document.querySelector("#"+"OptEdif").className = "hidden";
        document.querySelector("#" + this.value).className = "visibility";
		
    }
   
	}, false);
	
	
	$(document).ready(function(){
	$("button[id=tipoBuscar]").click(function(){
		
	     document.querySelector("#" + "resultadosTabla").className = "visibility";
		 var data = $("#formBusquedaCliRst").serialize();
			$.post("src/controlador/ctrlBuscarCliente.php", data ,function(result) {	
				// $("#tablaClientes").html(result);
	});
});
});
   
   $("#tablaClientes").on('dblclick','tr td', function() {
	  var loadUrl = "src/vista/vistaClienteDialog.php"; // paso parametro accion e id
		$("#cliente").load(loadUrl); // ejecuto
	  });
	  
	  
 

	
	

 </script>
 
 </body>

	</html>