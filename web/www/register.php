<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $passwd = $_POST["passwd"];

        // Validar los datos (puedes añadir más validaciones si es necesario)
        if (empty($nombre) || empty($email) || empty($passwd)) {
            echo "Todos los campos son obligatorios.";
        } else {
            // Conexión a la base de datos
            $conn = new mysqli('mysql', 'admin', 'admin', 'pfcdlk');

            // Hashear la contraseña
            $hashed_passwd = password_hash($passwd, PASSWORD_DEFAULT);

            // Consulta SQL de inserción
            $sql = "INSERT INTO Cuentas (Nombre, Passwd, Email) VALUES ('$nombre', '$passwd', '$email')";
            
            // Ejecutar la consulta
            if ($conn->query($sql) === TRUE) {
                    header("Location: index.php");
                exit;
            } else {
                echo "Error al registrar: " . $conn->error;
            }

            $conn->close();
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container" id="loginForm">
        <h1>Registrarse</h1>
    <form action="register.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="passwd">Contraseña:</label>
        <input type="password" id="passwd" name="passwd" required><br><br>

        <input type="submit" value="Registrarse">
    </form>
</body>
</html>