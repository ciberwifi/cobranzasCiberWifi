<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require(MODEL_PATH.'clases/GestionadorCobranza.php');


$Cobranzas=	new GestionadorCobranza();

//$Cobranzas->GestionadorTablas->gCargarTablaClientes();
//$Cobranzas->calcularSaldo(04, 19);
//test case aviso de pago 
//$Cobranzas->compararSALconGW(04, 19);


//$Cobranzas->cortePorMora(04, 19);

$Cobranzas->reconeccion();



?>