<?php
// Incluye el archivo de configuración de la base de datos que contiene la conexión
include_once '../../config/config.php';
$objConn = new Connection();
$conn = $objConn->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $nombre_usuario = $_POST["nombre_usuario"];
    $contrasena = $_POST["contrasena"];

    // Consulta a la base de datos para verificar el usuario
    $consulta = "SELECT p_Id, rol FROM usuarios WHERE p_username = '$nombre_usuario' AND p_pass = '$contrasena'";
    $resultado = mysqli_query($conn, $consulta);

    if ($resultado) {
        // Obtén el valor de 'p_Id' y 'rol' de la consulta
        $fila = mysqli_fetch_assoc($resultado);

        // Verifica si el usuario es válido (p_Id = 13 y rol = 2)
        if ($fila && ($fila['p_Id'] == 13 || $fila['p_Id'] == 1) && $fila['rol'] == 2) {
            echo 'Inicio de sesión exitoso para el usuario con rol 2.';
        } else {
            echo 'Usuario no autorizado.';
        }
        
        // Libera el resultado
        mysqli_free_result($resultado);
    } else {
        // Maneja el error de la consulta
        echo 'Error en la consulta: ' . mysqli_error($conn);
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="nombre_usuario">Nombre de Usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br>

        <button type="submit"><a href="../admin/Admin.php">Bienvenido</a></button>
    </form>
</body>
</html>
