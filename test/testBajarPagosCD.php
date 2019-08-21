<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/PATH/pathSistemaCobranza.php');
require(MODEL_PATH.'logicaNegocio/ingresar_pagosCD.php');
require (CONFIG_PATH."ConfiguracionDM.php");

require(CONFIG_PATH.'configuracionDM-'."ra".'.php');
	$configDM= NEW ConfiguracionDM ("ra", $archivoPagosTxt, $archivoPagosCvs, $email, $cuenta, $pin, $ruta, $comercio, $sid);
	ingresarPagosCD(08, 2019,$configDM, 2,2 );



?>