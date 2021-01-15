
  
   
   </br>
   <form method="post" action="enviar.php" class="vista-formGeneral">

  
  
   <h3 >Datos Cliente:</h3> 
  <section> 
	
	
	<ul>
		<li>Nombre:</li>
		<li><input autofocus type="text" placeholder="Juan" > </li>
	</ul>
	<ul>	
		<li>Apellido:</li>
		<li> <input  type="text" placeholder="Perez"> </li>
	</ul>
	<ul>
		<li>DNI:</li>
		<li><input  type="text" placeholder="30255446" ></li>
		
	</ul>
	<ul>
		<li>TEL:</li>
		<li><input type="number" placeholder="541146962339"></li>
		
	</ul>
	
	<ul>
		<li>Cel1</li>
		<li><input  type="number" placeholder="541160083133"></li>
		
	</ul>
	<ul>
		<li>Cel2:</li>
		<li><input  type="number" placeholder="541195723147"></li>
		
	</ul>
	<ul>
		<li>Email:</li>
		<li><input  type="text" placeholder="alguien@example.com"></li>
		
	</ul>
	
<div>
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
	<ul >
		<li>Calle:</li>
		<li><input  type="text"></li>
		
	</ul>
	<ul >
		<li>Altura:</li>
		<li><input class="inputform" type="text"></li>
		
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
	
	
		<ul >
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
	<ul >
		<li>EntreCalle 1:</li>
		<li><input  type="text" placeholder="charcas"></li>
		
	</ul>
	<ul >
		<li>EntreCalle2:</li>
		<li><input  type="text" placeholder="masa" ></li>
		
	</ul>
	
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
	
	<ul >
		<li>Detalle Domicilio:</li>
		<li><input  type="text" placeholder="pb perciana marron"></li>
		
	</ul>
	
	</div>
	
</div>	

</section>




	 <h3 >Datos Coneccion:</h3> 


<section>
		
	<ul>
		<li>Tipo Instalacion</li>
	<li>
	<select name="tipoInstalacion" id="tipoInstalacionSelect"  >
	<option value="">Seleccione </option>
	<option value="OptIndv"> Individual </option>
	<option value="OptColectiva">Colectiva</option>
	</select>
	</li>
	</ul>
	
	<ul>
		<li>Zona:</li>
	<li>
	<select name="tipoInstalacion" id="tipoInstalacionSelect"  >
	<option value="">Seleccione </option>
	<option value="OptIndv"> LafeL </option>
	<option value="OptColectiva">Luzu</option>
	</select>
	</li>
	</ul>
	
	<div id="OptIndv" class="hidden">
	
	

	<ul>
		<li>MacAddress Antena:</li>
		<li><input  type="text" placeholder=" 27:E1:D2:C3:B4:A5"></li>
		
	</ul>
	
	<ul>
		<li>Ip Antena:</li>
		<li><input  type="text" placeholder="192.168.8.100"></li>
		
	</ul>
	
	<ul>
		<li>Modelo Antena:</li>
	<li>
	<select required>
	<option value="">Seleccione </option>
	<option value=""> Aigrid 23 </option>
	<option value=""> Aigrid 27 </option>
	</select>
	</li>
	</ul>
	
	<ul>
		</br>
		<li><input type="checkbox" checked > Comodato</li>
		
	</ul>
	

	<ul>
		<li>Modelo Router:</li>
	<li>
	<select required>
	<option value="">Seleccione </option>
	<option value=""> Tp-Link 740N </option>
	<option value=""> Tp-Link 840N </option>
	</select>
	</li>
	</ul>
		<ul >
		</br>
		<li><input type="checkbox" checked > Comodato</li>
		
		</ul>
	</br>
	<ul>
		<li>Modelo Estabilizador:</li>
	<li>
	<select required>
	<option value="">Seleccione </option>
	<option value=""> AtomLuxH500 </option>
	<option value=""> AtomLuxH1000 </option>
	</select>
	</li>
	</ul>
		<ul>
		</br>
		<li><input type="checkbox" checked > Comodato</li>
		
	</ul>
	<ul>
		<li>AP SSID IP:</li>
	<li>
	<select required >
	<option value="">Seleccione </option>
	<option value=""> Wifi Laferrere 4-68 4.66 </option>
	<option value="">Wifi Laferrere 4-68 4.69</option>
	</select>
	</li>
	</ul>
	
	<ul>
		<li>Señal/Ruido:</li>
		<li><input class="inputform"  type="text" placeholder="57/98"></li>
		
	</ul>
	
	<ul>
		<li>Altura:</li>
		<li><input class="inputform"  type="text" placeholder="9"></li>
		
	</ul>
	
	
	<ul>
		<li>Metros Cable</li>
		<li><input class="inputform" type="text" placeholder="45"></li>
		
	</ul>
	
	</div>
	
<div id="OptColectiva" class="hidden">
	
	<ul>
		<li>MacAddress Cliente:</li>
		<li><input  type="text" placeholder=" 27:E1:D2:C3:B4:A5"></li>
		
	</ul>
	
	<ul>
		<li>Ip Cliente:</li>
		<li><input  type="text" placeholder="192.168.8.100"></li>
		
	</ul>
	
	<ul>
		<li>Modelo Router:</li>
	<li>
	<select required>
	<option value="">Seleccione </option>
	<option value=""> Tp-Link 740N </option>
	<option value=""> Tp-Link 840N </option>
	</select>
	</li>
	</ul>
		<ul >
		</br>
		<li><input type="checkbox" checked > Comodato</li>
		
		</ul>
	</br>
	<ul>
		<li>Modelo Estabilizador:</li>
	<li>
	<select required>
	<option value="">Seleccione </option>
	<option value=""> AtomLuxH500 </option>
	<option value=""> AtomLuxH1000 </option>
	</select>
	</li>
	</ul>
		<ul>
		</br>
		<li><input type="checkbox" checked > Comodato</li>
		
	</ul>
	<ul>
		<li>ID Nodo</li>
	<li>
	<select required >
	<option value="">Seleccione </option>
	<option value=""> Edif12 4.65 </option>
	<option value="">Edif15 ent1 4.79</option>
	</select>
	</li>
	</ul>
	
	<ul>
		<li>Metros Cable</li>
		<li><input class="inputform" type="text" placeholder="45"></li>
		
	</ul>
	
</div>


</section>

	
     
      
  

 </form>
 

        <script>
		
		
	document.querySelector("#tipoDomicilioSelect").addEventListener("change", function(){
		 
    if (this.value.length){
		document.querySelector("#"+"OptCasa").className = "hidden";
		document.querySelector("#"+"OptEdif").className = "hidden";
        document.querySelector("#" + this.value).className = "visibility";
		
    }
   
	}, false);
	
	document.querySelector("#tipoInstalacionSelect").addEventListener("change", function(){
		 
    if (this.value.length){
		document.querySelector("#"+"OptIndv").className = "hidden";
		document.querySelector("#"+"OptColectiva").className = "hidden";
        document.querySelector("#" + this.value).className = "visibility";
		
    }
   
	}, false);

	document.querySelector("#OptTjCobr").addEventListener("change", function(){
		 
	if( $(this).is(':checked') ) {  
		 document.querySelector("#"+"DivOptTjCobr").className = "visibility";
    } else {
         document.querySelector("#"+"DivOptTjCobr").className = "hidden";
    }
	}, false);
    
	document.querySelector("#OptEmail").addEventListener("change", function(){
		 
	if( $(this).is(':checked') ) {  
		 document.querySelector("#"+"DivOptEmail").className = "visibility";
    } else {
         document.querySelector("#"+"DivOptEmail").className = "hidden";
    }
	}, false);
	
	document.querySelector("#OptDebito").addEventListener("change", function(){
		 
	if( $(this).is(':checked') ) {  
		 document.querySelector("#"+"DivOptDebito").className = "visibility";
    } else {
         document.querySelector("#"+"DivOptDebito").className = "hidden";
    }
	}, false);
		
    
   

 </script>
 
