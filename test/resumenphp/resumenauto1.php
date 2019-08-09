<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
echo "<font size='3' face='Arial'><tr>";
			if(strlen($_REQUEST['Tarjeta'])<7   )
			{
			echo "<br>";
			exit("Tarjeta incorrecta ");
		
			}	

?>

<?php
$MAF=date("m-y");
$MAI=$MAF;
$MAI= disminuirmes($MAI);
//Echo $MAF."-".$MAI;
$us="R";
$existe=-1;
$unidad="Z:/redes.bas/";
$user="system.new/";
$Path=$unidad.$user;
$cliente2="";
$_REQUEST['Tarjeta']=(strtolower($_REQUEST['Tarjeta']));
$cli=(trim($_REQUEST['Tarjeta']));
//---



$ruta=$Path.$MAF."/";////barra derecha otra unidadad

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
		require_once('resumenauto1L.php');
	}	
//echo"-------------------------------------------------------------";
function disminuirmes($MA)
 {
$ME=substr($MA,0,2); $AO=substr($MA,3,2);
IF ($ME=="01") {  $AO=$AO-1;  }
IF ($ME=="01") { $ME1="12"; }
elseIF ($ME=="02") { $ME1="01"; }
elseIF ($ME=="03") { $ME1="02"; }
elseIF ($ME=="04") { $ME1="03"; }
elseIF ($ME=="05") { $ME1="04"; }
elseIF ($ME=="06") { $ME1="05"; }
elseIF ($ME=="07") { $ME1="06"; }
elseIF ($ME=="08") { $ME1="07"; }
elseIF ($ME=="09") { $ME1="08"; }
elseIF ($ME=="10") { $ME1="09"; }
elseIF ($ME=="11") { $ME1="10"; }
elseIF ($ME=="12") { $ME1="11"; }
$mes_año=$ME1."-".$AO;
return $mes_año;
}	
//-------------------------------------------------------------
function incremetarmes($MA)
 {
$ME=substr($MA,0,2); $AO=substr($MA,3,2);
IF ($ME=="12") {  $AO=$AO+1;  }
IF ($ME=="01") { $ME1="02"; }
elseIF ($ME=="02") { $ME1="03"; }
elseIF ($ME=="03") { $ME1="04"; }
elseIF ($ME=="04") { $ME1="05"; }
elseIF ($ME=="05") { $ME1="06"; }
elseIF ($ME=="06") { $ME1="07"; }
elseIF ($ME=="07") { $ME1="08"; }
elseIF ($ME=="08") { $ME1="09"; }
elseIF ($ME=="09") { $ME1="10"; }
elseIF ($ME=="10") { $ME1="11"; }
elseIF ($ME=="11") { $ME1="12"; }
elseIF ($ME=="12") { $ME1="01"; }
$mes_año=$ME1."-".$AO;
return $mes_año;
}
//------------------------------------------------
//saldo anterior
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

function debecli($Tar,$mes_año,$SA)
 {
	global $SA ,$mes_año,$Path,$cliente2,$listado,$L,$ancho;
$existe=0;		//separar tarjetas 
$Ta=trim($Tar);
for ($bl=0 ; $bl<10 ; $bl++ ) {
if (strlen($Ta)>10 and strlen($Ta)<20)
{$tar1[$bl]=substr($Ta,0,strlen($Ta));
//print $tar1[$bl];	echo "<br>";
$lb=$bl;
$bl=10;}	
$tar1[$bl]= substr($Ta,0,strpos($Ta," ")); 
$Ta=substr($Ta,strpos($Ta," "));	
//print $tar1[$bl];echo "<br>";
$Ta=trim($Ta);		
}
//echo $lb;echo "<br>";
//echo "-------------------------------------------";echo "<br>";

$ruta=$Path.$mes_año."/";////barra derecha otra unidadad	 
$fila = 1;
if (($gestor = fopen($ruta."cli".$mes_año.".csv", "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
        $numero = count($datos);
       //echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
        $fila++;
        for ($c=0; $c < $numero; $c++) {
            //echo $datos[$c] . "<br />\n";
			$pago[$c]=trim($datos[$c]);
			//echo $c." ".$datos[$c]; echo "<br>";
        }
			if (strlen($Tar)>6)
			{
				for ( $bb=0 ; $bb<$lb+1 ; $bb++) {
				//echo $bb."-".$tar1[$bb]."-"	;echo "<br>";
			If ($pago[8]==""){$pago[8]="--------------";}	
			$pos = strpos("$pago[8]", "$tar1[$bb]");//tarjeta
			If ($pago[4]==""){$pago[4]="--------------";}	
			$pos1 = strpos($pago[4], $tar1[$bb]);//celu
			If ($pago[6]==""){$pago[6]="--------------";}	
			$pos2 = strpos($pago[6], $tar1[$bb]);// documento
			//echo $tar1[$bb].$pos."pos".$pago[8]; echo "<br>";
			//echo $pos."pos";echo "<br>";
			if ( $pos>-1 or $pos1>-1 or $pos2>-1 )	{
			$bb=$lb+1; }
				}
			}
					if ( $pos>-1 or $pos1>-1 or $pos2>-1 )					
					{
						$SA=$SA-$pago[10];
						$pago[8]=substr($pago[8],0,16);
						$cliente2=substr($pago[2]."-".$pago[3],0,15);
						//echo "<table border=6 cellspacing=10 cellpading=0 width=$ancho>
						//<tr> <td><font color=blue>Usuario</td> <td>Tarjeta-OBS</font><td>Fecha </font ><td>Pago</font><td>Debe</font><td>Saldo</font><td>Plan</font></td></tr>
						//<tr> <td><font color=blue>$cliente2</td> <td>$pago[8]</font><td>Cuota$mes_año</font ><td>-</font><td>$pago[10]</font><td>$SA</font><td>$pago[11]</font></td></tr>
						//</table>";
					
						
						$L= $L+1;
						$listado[$L][0]=$cliente2;$listado[$L][1]=$pago[8];$listado[$L][2]="Cuota-".$mes_año;$listado[$L][3]="-";$listado[$L][4]=$pago[10];$listado[$L][5]=$SA;$listado[$L][6]=$pago[11];

						$pos=-1; $pos1=-1;
						$existe=$existe+1;
							for ($c=0; $c < $numero; $c++) {//borrar variable
							//echo $datos[$c] . "<br />\n";
							$pago[$c]="";}						
						//Exit("Fin");
					}				
	}			
    fclose($gestor);
	
}
if ($existe==0)
	{
//	echo $Tar." Tarjeta no encontrada en cli";
	}
//return $mes_año;
//exit;
//$AS=$SA;
//return  $AS;
}
//-------------------
debecli($Tar,$mes_año,$SA);
//----------------------------------------------------------
//echo "mes".$mes_año;echo "<br>";
//echo "saldo".$SA;echo "<br>";
//echo "tarjeta".$Tar;echo "<br>";
function SUM($Tar,$mes_año,$SA)
 {
 global $SA ,$mes_año,$Tar,$Path,$cliente2,$listado,$L,$ancho;//,otras
 $existe=0;		//separar tarjetas 
$ruta=$Path.$mes_año."/CSV/";////barra derecha otra unidadad	 
$fila = 1;
if (($gestor = fopen($ruta.$mes_año."SUM.CSV", "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
        $numero = count($datos);
       //echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
        $fila++;
        for ($c=0; $c < $numero; $c++) {
            //echo $datos[$c] . "<br />\n";
			
			$SUM[$c]=trim($datos[$c]);
			if(strlen($SUM[$c])<3){$SUM[$c]="x";}
			//echo $c." ".$datos[$c]; echo "<br>";
        }
			//echo"-------------------";echo "<br>";
			If ($SUM[3]==""){$SUM[3]="--------------";}
			$pos = strpos($Tar, "$SUM[3]");//tarjeta

			//echo $tar1[$bb].$pos."pos".$pago[8]; echo "<br>";
			//echo $pos."pos";echo "<br>";
					if ( $pos>-1 )					
					{
						$SA=$SA+$SUM[1];
						//$pago[8]=substr($pago[8],0,40);
						//echo "<table border=6 cellspacing=10 cellpading=0 width=$ancho>
						//<tr> <td><font color=blue>Usuario</td> 
						//<td>Tarjeta-OBS</font>
						//<td>Fecha </font >
						//<td>Pago</font>
						//<td>Debe</font>
						//<td>Saldo</font>
						//<td>Plan</font>
						//</td></tr>
						//<tr> <td><font color=blue>$cliente2</td> <td>$SUM[3]</font><td>$SUM[0]</font ><td>$SUM[1]</font><td>-</font><td>$SA</font><td>-</font></td></tr>
						//</table>";
						//$tar= $cliente[8];//por q lee todo
						$L= $L+1;
						$listado[$L][0]=$cliente2;
						$listado[$L][1]=$SUM[3];
						$listado[$L][2]=$SUM[0];
						$listado[$L][3]=$SUM[1];
						$listado[$L][4]="-";
						$listado[$L][5]=$SA;
						$listado[$L][6]="-";
						
						$pos=-1; $pos1=-1;
						$existe=$existe+1;	
							for ($c=0; $c < $numero; $c++) {//borrar variable
							//echo $datos[$c] . "<br />\n";
							$SUM[$c]="";}
						//Exit("Fin");
					}				
	}			
    fclose($gestor);
}
if ($existe==0)
	{
	
	//echo "<table border=6 cellspacing=10 cellpading=0 width=$ancho>
						//<tr> <td><font color=blue>Usuario</td> <td>Tarjeta-OBS</font><td>Fecha </font ><td>Pago</font><td>Debe</font><td>Saldo</font><td>Plan</font></td></tr>
						//<tr> <td><font color=blue>$cliente2</td> <td>-</font><td>Cuota.$mes_año</font ><td>No pago</font><td>-</font><td>$SA</font><td>-</font></td></tr>
						//</table>";
						$L= $L+1;
						$listado[$L][0]=$cliente2;
						$listado[$L][1]="Cuota.$mes_año";
						$listado[$L][2]="No pago";
						$listado[$L][3]="-";
						$listado[$L][4]="-";
						$listado[$L][5]=$SA;
						$listado[$L][6]="-";
	}
//return $mes_año;
//exit;
}
//-------------------
SUM($Tar,$mes_año,$SA);
//-----------------------
function MA($Tar,$mes_año,$SA)
 {
 global $SA ,$mes_año,$Tar,$Path,$cliente2,$listado,$L,$ancho;//,otras
 $existe=0;	$pos=-1;	//separar tarjetas 
//echo $lb;echo "<br>";
//echo "-------------------------------------------";echo "<br>";
$ruta=$Path.$mes_año."/CSV/";////barra derecha otra unidadad	 
$fila = 1;
if (($gestor = fopen($ruta.$mes_año."M.CSV", "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
        $numero = count($datos);
      // echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
	  // echo $mes_año;
        $fila++;
        for ($c=0; $c < $numero; $c++) {
            //echo $datos[$c] . "<br />\n";
			
			$MAN[$c]=trim($datos[$c]);
			//echo $c." ".$datos[$c]; echo "<br>";
        }
			If ($MAN[3]==""){$MAN[3]="--------------";}
			$pos = strpos($Tar,$MAN[3]);   //tarjeta
					if ( $pos>-1 )					
					{
						$SA=$SA+$MAN[1];
						//echo "<table border=6 cellspacing=10 cellpading=0 width=$ancho>
						//<tr> <td><font color=blue>Usuario</td> 
						//<td>Tarjeta-OBS</font>
						//<td>Fecha </font >
						//<td>Pago</font>
						//<td>Debe </font>
						//<td>Saldo</font>
						//<td>Plan</font>
						//</td></tr>
						//<tr> <td><font color=blue>$cliente2</td> <td>$MAN[3]</font><td>$MAN[0]</font ><td>$MAN[1]</font><td>Manual</font><td>$SA</font><td>-</font></td></tr>
						//</table>";
						$L= $L+1;
						$listado[$L][0]=$cliente2;
						$listado[$L][1]=$MAN[3];
						$listado[$L][2]=$MAN[0];
						$listado[$L][3]=$MAN[1];
						$listado[$L][4]="Manual";
						$listado[$L][5]=$SA;
						$listado[$L][6]="-";
						$pos=-10; 
						$existe=$existe+1;	
							for ($c=0; $c < $numero; $c++) {//borrar variable
							//echo $datos[$c] . "<br />\n";
							$MAN[$c]="";}
						//Exit("Fin");
					}
							
	}			
    fclose($gestor);
}

}
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
if ($_REQUEST['tu_input']=="seguir" ){$_REQUEST['servidor']="";}
if ($_REQUEST['servidor']==""){
//--------------------------------------------
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
$to="visitas-comentarios/";
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
$to="visitas-comentarios/".$MAF."/";
//----------------------------------
$ar="";
//$listado[$L][2]
$ar=fopen($to."R-visitas comentarios resumen.txt","a") or
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
<?php } ?>

