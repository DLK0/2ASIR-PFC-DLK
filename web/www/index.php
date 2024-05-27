<?php
	session_start();

	// Verifica si el usuario está autenticado y redirige en caso de que no este logeado
	if (!isset($_SESSION['id_Cuenta'])) {
		header("Location: login.php");
		exit();
	}

    $idc = $_SESSION['id_Cuenta'];

	//Conexion a la base de datos
	$link = mysqli_connect('mysql', 'admin', 'admin', 'pfcdlk');

	//Consulta que me devuelve todos los registros de la tabla "usuarios"
	$query = "SELECT Cuentas.*, Juegos.* FROM Cuentas
    INNER JOIN Biblioteca ON Biblioteca.id_Cuenta = Cuentas.id_Cuenta 
    INNER JOIN Juegos ON Juegos.id_Juego = Biblioteca.id_juego
    WHERE Biblioteca.id_Cuenta = $idc";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div id="wrapper">
		<h2><h1>Bienvenido, <?php echo $_SESSION['nombre']; ?>!</h1></h2>
		<a href="logout.php" class='btn btn-primary'>Cerrar sesión</a>
		<h3>Biblioteca</h3>
		<a href="create.php" class='btn btn-primary'>Agregar Juego</a>
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre_Juego</th>
					<th>Desarrollador</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				//Ejecuto la query para obtener los resultados de la cadena de consulta en la variable $query
				if($result = mysqli_query($link, $query)):  
			?>
				<?php 
					//la variable $user contiene el contenido de $result en un array asociativo
					while($juego = mysqli_fetch_assoc($result)): 
				?>
					<tr>
						<td width="5%" class="text-center"><?php echo $juego['id_Juego']; ?></td>
						<td width="20%"><?php echo $juego['Nombre_Juego']; ?></td>
						<td width="15%"><?php echo $juego['Desarrollador']; ?></td>
						<td width="15%" class="text-center">
							<a href="update.php?id=<?php echo $juego['id_Juego'] ?>" class='btn btn-success'>Editar</a> <a href="delete.php?id=<?php echo $juego['id_Juego'] ?>" class='btn btn-danger'>Eliminar</a>
						</td>
					</tr>
				<?php endwhile; ?>
				<?php mysqli_free_result($result); ?>
			<?php endif; ?>
			</tbody>		
		</table>
	</div>
</body>
</html>
<?php 
//cierro conexion a bbdd
mysqli_close($link); 
?>