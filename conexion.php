<?php
//Abrir una conexión al manejador de BD:
$con = pg_connect("port=5432 dbname=prueba1 user=alumno1 password=hola123.,") or die (pg_last_error());
if($con){
	echo "se conectó a la BD";
}
else{
	echo "hubo un problema al conectar a la BD";
}

?>
