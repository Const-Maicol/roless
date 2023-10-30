
<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die('Error al conectar a la base de datos: ' . mysqli_connect_error());
}

?>

<?php

function verificarCorreo($correo)
{
    global $servername, $username, $password, $dbname;
  
    // Establecer conexión con la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar si hay un error de conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Escapar el correo electrónico para evitar ataques de inyección de SQL
    $correo = $conn->real_escape_string($correo);

    // Consulta para verificar la existencia del correo electrónico en la tabla de usuarios (reemplaza 'usuarios' con el nombre real de tu tabla)
    $sql = "SELECT * FROM usuarios WHERE p_email = '$correo'";

    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Si el resultado tiene al menos una fila, significa que el correo existe en la base de datos
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }

    // Cerrar la conexión
    $conn->close();
}

// Ejemplo de uso
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener el correo electrónico enviado desde el formulario
    $correo = $_POST["p_email"];

    // Verificar si el correo electrónico existe en la base de datos
    if (verificarCorreo($correo)) {
        // El correo electrónico existe en la base de datos, aquí puedes realizar las acciones necesarias para enviar el enlace de recuperación de contraseña por correo electrónico.
        echo "Este Usuario si existe, Verifica el enlace para cambiar tu contraseña";
    } else {
        // El correo electrónico no existe en la base de datos, puedes mostrar un mensaje de error o redireccionar al formulario nuevamente.
        echo "El correo electrónico no existe en la base de datos. Por favor, verifica tu correo e inténtalo nuevamente.";
    }
}
?>