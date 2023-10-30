<?php
include('../config/config.php');

$objConn = new Connection();
$conn = $objConn->getConnection();
// Obtener los datos del formulario de login
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['p_username'];
    $contrasena = $_POST['p_pass'];
}

// Verificar que los campos no estén vacíos
if (empty($username) || empty($contrasena)) {
    echo "Todos los campos son obligatorios.";
    exit;
}

// Realizar la consulta a la base de datos para verificar las credenciales
$query = "SELECT * FROM usuarios WHERE p_username = '$username' AND p_pass = '$contrasena'";
$resultado = mysqli_query($conn, $query);

if (mysqli_num_rows($resultado) > 0) {
    // Login exitoso, redireccionar al usuario a la página de inicio o a donde desees

    $getDataUser = $resultado->fetch_all(MYSQLI_ASSOC);
    session_start();
    $_SESSION["newsession"] = $getDataUser[0]['p_Id'];

    header('Location: ../view/home/home.php');
} else {
    echo "Usuario no encontrado o contraseña incorrecta.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
