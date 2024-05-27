<?php
session_start();

// Verifica si el usuario ya está autenticado y redirige si es necesario
if (isset($_SESSION['id_Cuenta'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['name'];
    $passwd = $_POST['password'];

    $mysqli = mysqli_connect("mysql", "admin", "admin", "pfcdlk");

    // Consulta SQL para verificar las credenciales
    $query = "SELECT * FROM Cuentas WHERE Nombre = '$user' AND Passwd = '$passwd'";
    $res = $mysqli->query($query);

    if ($res && $res->num_rows > 0) {
        $user = $res->fetch_assoc();

        // Inicia la sesión y almacena la información del usuario
        $_SESSION['id_Cuenta'] = $user['id_Cuenta'];
        $_SESSION['nombre'] = $user['Nombre'];
        $_SESSION['password'] = $user['Passwd'];

        // Redirige a la página principal
        header("Location: index.php");
        exit();
    } else {
        $error = "Credenciales incorrectas. Inténtalo de nuevo.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Iniciar sesión</title>
</head>
<body>
    
    <form action="" method="post">
        <div class="login-container" id="loginForm">
        <h1>Iniciar sesión</h1>
        <?php if (isset($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <label for="name">Nombre usuario:</label>
        <input type="text" name="name" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        <br>
        
        <br>
        <input type="submit" value="Iniciar sesión">
        <a href=register.php>Registrarse</a>
    </form>
</body>
</html>