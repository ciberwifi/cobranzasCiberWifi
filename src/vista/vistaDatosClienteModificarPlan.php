</br>
<form method="post" action="enviar.php" class="vista-formGeneral">
<div>	
	 <h3 >Datos Plan:</h3> 
</div>
<section>
	<div>
		<ul>
		<li>Plan Internet</li>
			<li>
			<select  >
			<option value="">Seleccione </option>
			<option value=""> 1M </option>
			<option value="">2M</option>
			<option value="">3M</option>
			</select>
			</li>
		</ul>
		<ul>
		<li>Plan Tv</li>
			<li>
			<select>
			<option value="">Seleccione </option>
			<option value=""> 1 TV </option>
			<option value="">2 TV</option>
			</select>
			</li>
		</ul>
		<ul>
		
		<li>Plan Netflix</li>
			<li>
			<select>
			<option value="">Seleccione </option>
			<option value=""> Cuenta Full </option>
			<option value="">1 Pantalla</option>
			<option value="">2 Pantallas</option>
			</select>
			</li>
		</ul>
		<ul>
		<li>Decos Adicionales</li>
			<li>
			<select>
			<option value="">Seleccione </option>
			<option value=""> 1 </option>
			<option value=""> 2 </option>
			<option value=""> 3 </option>
			</select>
			</li>
		</ul>
		
		<ul>
		</br>
		<li><input type="checkbox" checked > Recargo por Wifi</li>
		
		</ul>
	
		
	</div>

</section>



<div>	
	 <h3 >Datos Pago:</h3> 
</div>
<section>

		<ul>
		<li>Medios de Pago:</li>
		</ul>
		<ul >
			<li><input id="OptTjCobr" type="checkbox"> Tarjeta de cobranza </li>
			<li><input id="OptEmail" type="checkbox" > Email</li>
			<li><input id= "OptDebito" type="checkbox" > Debito CBU</li>
			
		</ul>	
	

		
	<div  id="DivOptTjCobr" class="hidden"> 
	<ul>
	<li>Tarjeta Cobranza:</li>
		<li><input  type="text" placeholder=""></li>
	</ul>	
	
	</div>
	
		
	<div  id="DivOptEmail" class="hidden"> 
	<ul>
	<li>Email:</li>
		<li><input  type="text" placeholder=""></li>
	</ul>	
	
	</div>
	
		
	<div  id="DivOptDebito" class="hidden"> 
	<ul>
	<li>CBU:</li>
		<li><input  type="text" placeholder=""></li>
	</ul>	
	
	</div>
</section>	
</form>