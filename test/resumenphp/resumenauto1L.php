<?php
//<a href="#" onclick="document.resumen.submit()">Click aqui</a> 
date_default_timezone_set('America/Argentina/Buenos_Aires');
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
echo "<font size='3' face='Arial'><tr>";
			if(strlen($_REQUEST['Tarjeta'])<6)
			{
			echo "<br>";
			exit("Tarjeta incorrecta ");
		
			}	



$MAF=date("m-y");
$MAI=$MAF;
$MAI= disminuirmes($MAI);
//Echo $MAF."-".$MAI;
$us="L";
$existe=-1;
$unidad="E://RAintercambio/redes.bas/";
$user="system.lau/";
$Path=$unidad.$user;
$cliente2="";
$_REQUEST['Tarjeta']=(strtolower($_REQUEST['Tarjeta']));
$cli=(trim($_REQUEST['Tarjeta']));
//---
$ruta=$Path.$MAF."/";////barra derecha otra unidadad
	echo $MAF; echo "<br>";
	echo $MAI; echo "<br>";
//-------------------------
if (file_exists($ruta."cli".$MAF.".csv")) {
    //echo "El fichero fichero existe";
} else {
    //echo "El fichero fichero no existe";
	$MAF=$MAI;//mes anterior
	$ruta=$Path.$MAF."/";
}

//------------------------------
	
$fila = 1;
if (($gestor = fopen($ruta."cli".$MAF.".csv", "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
        $numero = count($datos);
       //echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
        $fila++;
        for ($c=0; $c < $numero; $c++) {
            //echo $datos[$c] . "<br />\n";
			$cliente[$c]=$datos[$c];
			//echo $c.$datos[$c]; echo "<br>";
        }
			if (strlen($cli)>6)
			{
			If ($datos[8]==""){$datos[8]="--------------";}		
			$pos = strpos($datos[8], $cli);//tarjeta
			If ($datos[4]==""){$datos[4]="--------------";}	
			$pos1 = strpos($datos[4], $cli);//celu
			If ($datos[6]==""){$datos[6]="--------------";}	
			$pos2 = strpos($datos[6], $cli);// documento
			//echo $pos."pos".$datos[8]; echo "<br>";
			}
					if ($pos>-1 or $pos1>-1 or $pos2>-1)					
					{
						$ip=$us.$cliente[1];
						$Tar= $cliente[8];//por q lee todo
						//echo "<table border=6 cellspacing=10 cellpading=0>
						//<tr> <td><font color=blue>Apellido</td> <td>Nombre</font><td>Tarjeta</font ><td>Plan</font></td></tr> 
						//<tr> <td><font color=blue>$cliente[2]</td> <td>$cliente[3]</font><td>$cliente[8]</font><td>$cliente[10].$cliente[11]</font></td></tr> 
						//</table>";
						$cliente2=substr($cliente[2]."-".$cliente[3],0,15);
						$pos=-1; $pos1=-1; $pos2=-1;
						$existe=$existe+1;
							for ($c=0; $c < $numero; $c++) {//borrar variable
							//echo $datos[$c] . "<br />\n";
							$cliente[$c]="";}							
						//Exit("Fin");
					}				
	}			
    fclose($gestor);
}
if ($existe==-1)
	{
		//include('prb.php'); 
		
		exit("Tarjeta no encontrada fin ");
	}	

//echo "<br>";
$MAI= disminuirmes($MAI);
$MAI= disminuirmes($MAI);
$MAI= disminuirmes($MAI);
$MAI= disminuirmes($MAI);
$ancho=700;//ancho lista
//echo $MAI; echo "<br>";
$listado[][]="";
$saldo[2]="-";
$saldo[3]=0;
$po=-1;
$ruta=$Path.$MAI."/csv/";	
$existe=0;
$SA=0 ;//* ámbito global */
$L=1;
//unset($datos);	
$fila = 1;
if (($gestor = fopen($ruta.$MAI."sal.csv", "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
        $numero = count($datos);
       //echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
        $fila++;
        for ($c=0; $c < $numero; $c++) {
            //echo $datos[$c] . "<br />\n";
			$saldo[$c]=substr(trim("$datos[$c]"),0,15);
			//echo $c."--  ".$datos[$c]; echo "<br>";
			//echo $saldo[2]."!";echo "<br>";
        }
			//echo $fila."_".$saldo[2]; echo "<br>";
			if (strlen($saldo[2])>6)
			{
			//echo $fila."_".$tar."___".$saldo[2]; echo "<br>";
	
			$po=strpos($Tar,$saldo[2]);
			
			//echo "-----------------".$po."POS";
			//echo "<br>";
			}
			//echo $pos."pos".$datos[8]; echo "<br>";
			
					if ($po===0 )
					
					{
					$SA=$saldo[3];
					//echo "<table border=6 cellspacing=10 cellpading=0 width=$ancho>
						//<tr> <td><font color=blue>Usuario</td> <td>Tarjeta-OBS</font><td>- </font ><td>-</font><td>-</font><td>-</font><td>-</font></td></tr> 
						//<tr> <td><font color=blue>$saldo[1]</td> <td>$saldo[2]</font><td>$MAI </font ><td>Saldo</font><td>Anterior</font><td>$saldo[3]</font><td>-</font></td></tr> 
						//</table>";
					
					$listado[0][0]=$saldo[1];
					$listado[0][1]=$saldo[2];
					$listado[0][2]=$MAI;
					$listado[0][3]="Saldo";
					$listado[0][4]="Anterior";
					$listado[0][5]="$".$SA;
					$listado[0][6]=$ip;
					$L=1;
					$listado[$L][0]="Usuario";$listado[$L][1]="Tarjeta-OBS";$listado[$L][2]="Fecha ";$listado[$L][3]="Pago";$listado[$L][4]="Debe";$listado[$L][5]="Saldo";$listado[$L][6]="Plan";	
						$existe=$existe+1;
							for ($c=0; $c < $numero; $c++) {//borrar variable
							//echo $datos[$c] . "<br />\n";
							$saldo[$c]="";}						
						//Exit("Fin");
					}				
	}			
    fclose($gestor);
}
if ($existe==0)
	{		
	//echo $_REQUEST['Tarjeta']." Saldo anterior no encontrado-".$MAI;
					$SA=0;					
					$listado[0][0]=$cliente2;
					$listado[0][1]="";
					$listado[0][2]=$MAI;
					$listado[0][3]="Saldo";
					$listado[0][4]="Anterior";
					$listado[0][5]="$".$SA;
					$listado[0][6]=$ip;
					$L=1;
					$listado[$L][0]="Usuario";$listado[$L][1]="Tarjeta-OBS";$listado[$L][2]="Fecha ";$listado[$L][3]="Pago";$listado[$L][4]="Debe";$listado[$L][5]="Saldo";$listado[$L][6]="Plan";	
	}
//------------------------------------------
$mes_año=incremetarmes($MAI);
//echo "mes".$mes_año;echo "<br>";
//echo "saldo".$SA;echo "<br>";
//echo "tarjeta".$Tar;echo "<br>";
//$Tar=" 995862001477021  995862001011043 ";
//$mes_año="11-18";
//$SA=-110;


//-------------------
debecli($Tar,$mes_año,$SA);
//----------------------------------------------------------
//echo "mes".$mes_año;echo "<br>";
//echo "saldo".$SA;echo "<br>";
//echo "tarjeta".$Tar;echo "<br>";

//-------------------
SUM($Tar,$mes_año,$SA);
//-----------------------

//-------------------
MA($Tar,$mes_año,$SA);
while($MAF<>$mes_año)
//echo $Tar.$mes_año."PPPP".$SA;	
{ 
$mes_año=incremetarmes($mes_año);
debecli($Tar,$mes_año,$SA);
SUM($Tar,$mes_año,$SA);
MA($Tar,$mes_año,$SA);
//echo $mes_año."-".$MAF; echo "<br>";
}
//--------------------------------------------
$rows = 10; // amout of tr 
$cols = 10;// amjount of td 
$cu[0][0]="Cul ne";
$rows = 10; // amout of tr 
$cols = 10;// amjount of td 
$cu[0][0]="Cul ne";
function drawTable($rows, $cols){
	global $cu,$listado;
	echo "<table border='6' table width='750' cellspacing=5  >"; 
			echo "<tr>"; 
			for($td=0;$td<=$cols;$td++){ 
            echo "<td align='center'>".$listado[0][$td]."</td>";
			} 
			echo "</tr>"; 
	echo "<br>";
	echo "<table border='6' table width='750' cellspacing=5 bgcolor='silver' >"; 
for($tr=1;$tr<=$rows;$tr++){ 

    echo "<tr>"; 
        for($td=0;$td<=$cols;$td++){ 
               echo "<td align='center'>".$listado[$tr][$td]."</td>";
        } 
    echo "</tr>"; 
} 

echo "</table>";
}
drawTable($L, 6);
//exit();
$to="E://WWW-apache/visitas-comentarios/";
	$ar=fopen($to."Mes.txt","w+") or
    die("Problema mes");
	fputs($ar,"\n");
	fputs($ar,$MAF.$us);
	fputs($ar,"\n");
	fclose($ar);
//-----------------------
$carpeta = $to.$MAF."/";
if (!file_exists($carpeta)) {
    mkdir($carpeta, 0777, true);
}
$to="E://WWW-apache/visitas-comentarios/".$MAF."/";
//----------------------------------
$ar="";
//$listado[$L][2]
$ar=fopen($to."L-visitas comentarios resumen.txt","a") or
    die("Problemas en la creacion de comentarios");
	fputs($ar,"--------------............--------------------");
	fputs($ar,"\r\n");
	fputs($ar,date("d-m-y g:i a"));
	fputs($ar,"\r\n");
	fputs($ar,$ip."--".$Tar."-".$cliente2);
	fputs($ar,"\r\n");
	fclose($ar);
	echo "Estado del servicio -";
	echo $MAF;
		//"\r\n" para windows
	
?>

<form   action="resumenauto2.php" method="post">
<textarea name="comentarios" rows="3" cols="80" placeholder="Comentarios" >
</textarea>
<input value="Guardar" name="tu_input" class="input" type="submit" id="tu_input" size="10" maxlength="30">
<?php exit();?>

