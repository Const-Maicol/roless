<?php

include('../config/config.php');
$objConn = new Connection();
$conn = $objConn->getConnection();
$routeResut = "Location: ../view/login/login.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del formulario 
    $nombre = $_POST["p_nombre"];
    $username = $_POST["p_username"];
    $password = $_POST["p_pass"];
    $email = $_POST["p_email"];
    $numberofdocument = $_POST["p_numberofdocument"];
    $numbercellphone = $_POST["p_numbercellphone"];
    $typeofdocument = $_POST["p_typeofdocument"];
    $gender = $_POST["p_gender"];

    // Encriptar la contraseña
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Llamada al procedimiento almacenado para insertar un nuevo registro
    $sql = "CALL InsertarUsuario('$nombre', '$username', '$hashedPassword', '$email', '$numberofdocument', '$numbercellphone', '$typeofdocument', '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "Datos guardados exitosamente";
    } else {
        echo "Error al guardar los datos: " . $conn->error;
    }

    $conn->close();
    header($routeResut);
}
?>
