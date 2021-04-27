<?php
/*eliminar_alumno.php
 *Recibe el id de consulta_alumno.php para eliminar el registro
 *author: aaguilar
 *date: 18 03 2021
 */
//recibe los datos
$id = $_GET['id'];
//abrir conexión al manejador
echo "Importante: una vez que el registro sea borrado, no se podrá recuperar. Favor de verificar que el registro a eliminar es el correcto.";
//Verificar que exista el registro de acceso para este usuario, desde este equipo, a esta BD en el archivo pg_hba.conf
$con = pg_connect("port=5432 dbname=prueba1 user=alumno1 password=hola123.,") or die (pg_last_error());
if($con){
	//Consulta de datos a eliminar
	$query = "select nombre_alumno, apaterno_alumno, amaterno_alumno, correoe_alumno, tel_alumno from alumnos where id_alumno=".$id;
	$query = pg_query($con,$query);
	$consulta = pg_fetch_assoc($query);
?>
<table>
	<tr>
		<th>Nombre</th>
		<th>Apellido paterno</th>
		<th>Apellido materno</th>
		<th>Correo electrónico</th>
		<th>Teléfono</th>
	</tr>
	<tr>
		<td><?php echo $consulta['nombre_alumno']; ?></td>
		<td><?php echo $consulta['apaterno_alumno']; ?></td>
		<td><?php echo $consulta['amaterno_alumno']; ?></td>
		<td><?php echo $consulta['correoe_alumno'];?></td>
		<td><?php echo $consulta['tel_alumno']; ?></td>
	</tr>
</table>
<form name="borrar" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
<input type="submit" name="borrar" value="Eliminar registro">
</form>
<?php
	$borrar = $_POST['borrar'];
	if($borrar){
		//Eliminación del registro:
		$query = "delete from alumnos where id_alumno=".$id;
		$query = pg_query($con,$query) or die (pg_last_error());
		if($query){
			echo "<p>Se eliminó el registro del alumno</p>";
			echo "<a href='index.php'>Volver al inicio</a><br/>";
			echo "<a href='form_alumno.php'>Volver al formulario de registro</a>";
		}	
		else{
			echo "No se pudo ejecutar la sentencia SQL";
		}
	}
	else{
		echo "No se eliminó el registro";
	}
}
else{
	echo "hubo un error al intentar conectar a la BD";
}
?>
