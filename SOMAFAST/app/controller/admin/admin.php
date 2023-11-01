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
// ...

// Realizar la consulta a la base de datos para verificar las credenciales
$query = "SELECT * FROM usuarios WHERE p_username = '$username' AND p_pass = '$contrasena'";
$resultado = mysqli_query($conn, $query);

if (mysqli_num_rows($resultado) > 0) {
    // Obtener los datos del usuario
    $userData = $resultado->fetch_assoc();

    // Verificar el rol del usuario
    $userRole = $userData['rol'];

    // Comprobar si el rol es 2
    if ($userRole == 2) {
        // Login exitoso, redireccionar al usuario a la página de inicio o a donde desees
        session_start();
        $_SESSION["newsession"] = $userData['p_Id'];
        header('Location: ../view/home/home.php');
    } else {
        echo "Acceso no permitido para este rol.";
    }
} else {
    echo "Usuario no encontrado o contraseña incorrecta.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);

?>
