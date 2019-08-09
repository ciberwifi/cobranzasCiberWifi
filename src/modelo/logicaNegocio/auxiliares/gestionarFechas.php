
<?php 

function obtenerFecha ($mes, $dia){

return date('Ymd',mktime(0, 0, 0, $mes, $dia, date("Y")));

}





?>


