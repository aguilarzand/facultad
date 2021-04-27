<?php
/*consulta_alumno.php
 *Abre una conexión a la BD, consulta los registros de alumnos y los muestra en una tabla
 *author: aaguilar
 *date: 23 03 2021
 */
//abrir conexión al manejador
//Verificar que exista el registro de acceso para este usuario, desde este equipo, a esta BD en el archivo pg_hba.conf
$con = pg_connect("port=5432 dbname=prueba1 user=alumno1 password=hola123.,") or die (pg_last_error());
if($con){
	//genera la consulta
	$query = "select id_profesor,nombre_profesor,apaterno_profesor,amaterno_profesor,tel_profesor,correoe_profesor from profesores order by apaterno_profesor asc";
	$query = pg_query($con,$query) or die (pg_last_error());
	if($query){
		echo "<p>Lista de profesores</p>";
?>
<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Apellido paterno</th>
			<th>Apellido materno</th>
			<th>Correo electrónico</th>
			<th>Teléfono</th>
		</tr>
	</thead>
	<tbody>
<?php
		while($row = pg_fetch_array($query)){
			//echo "el nombre: ".$row['nombre_alumno']." el apaterno: ".$row['apaterno_alumno']." el materno: ".$row['amaterno_alumno'];
			echo "<tr>";
			echo "<td>".$row['id_profesor']."</td>";
			echo "<td>".$row['nombre_profesor']."</td>";
			echo "<td>".$row['apaterno_profesor']."</td>";
			echo "<td>".$row['amaterno_profesor']."</td>";
			echo "<td>".$row['correoe_profesor']."</td>";
			echo "<td>".$row['tel_profesor']."</td>";
			echo "</tr>";
		}
?>
	</tbody>
</table>
<?php
		echo "<a href='index.php'>Volver al inicio</a><br/>";
		echo "<a href='form_alumno.php'>Volver al formulario de registro</a>";
	}
	else{
		echo "No se pudo ejecutar la sentencia SQL";
	}
}
else{
	echo "hubo un error al intentar conectar a la BD";
}
?>
