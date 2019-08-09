<?php
$to="visitas-comentarios/";
//------------------
$mes = fopen($to."mes.txt", "r");
while (!feof($mes)){
	$MA = trim(fgets($mes));
	if (strlen($MA)===6){
    $MAF =substr( $MA,0,5);
	$us =substr( $MA,5,1);
	$to="visitas-comentarios/".$MAF."/";	
	}
}
fclose($mes);
echo $MAF.$us;
//-------------------
$BB=$_REQUEST['comentarios'];
$ar=fopen($to.$us."-visitas comentarios resumen.txt","a") or
    die("Problemas en la creacion de comentarios");
//	fputs($ar,"\r\n");
	fputs($ar,$BB);
	fputs($ar,"\r\n");
	fputs($ar,"----------------------------------------"."\n");
	fclose($ar);
?>
<html>
<head>
<meta http-equiv="Refresh" content="5;url=https://www.google.com.ar"> 
</head>

<body>
<p>Gracias por dejar su comentario.  puedes salir haciendo click <a href="https://www.google.com.ar">aquí</a></p>
</body>
</html>