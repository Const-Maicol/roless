<?php
include_once '../../config/config.php';
$objConn = new Connection();
$conn = $objConn->getConnection();

class Crud {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function readUsers() {
        $sql = "SELECT * FROM `usuarios`";
        $result = $this->conn->query($sql);

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        return $users;
    }

    public function createUser($data) {
        // Otras variables
        $name = $data['p_nombre'];
        $username = $data['p_username'];
        $password = $data['p_pass'];
        $email = $data['p_email'];
        $rol = $data['rol'];
        $documentType = isset($data['p_typeofdocument']) ? $data['p_typeofdocument'] : null;

        // Verificar si la categoría y el tipo de documento existen
        $categoryExists = $this->isCategoryExists($rol);
        $documentTypeExists = $this->isDocumentTypeExists($documentType);

        if ($categoryExists && $documentTypeExists) {
            $sql = "INSERT INTO `usuarios` (`p_nombre`, `p_username`, `p_pass`, `p_email`, `rol`, `p_typeofdocument`)
                    VALUES ('$name', '$username', '$password', '$email', $rol, $documentType)";

            return $this->conn->query($sql);
        } else {
            // Manejar el caso en que la categoría o el tipo de documento no existan
            return false;
        }
    }

    private function isCategoryExists($categoryId) {
        $sql = "SELECT * FROM `typeproduct` WHERE `typeProduct_id` = $categoryId";
        $result = $this->conn->query($sql);
        return $result->num_rows > 0;
    }

    private function isDocumentTypeExists($documentTypeId) {
        if ($documentTypeId !== null) {
            $sql = "SELECT * FROM `document_type` WHERE `DocumentType_id` = $documentTypeId";
            $result = $this->conn->query($sql);
            return $result->num_rows > 0;
        } else {
            // Handle the case where $documentTypeId is NULL
            return false;
        }
    }


}

$objCrud = new Crud($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Agregar o actualizar Usuario
    if (isset($_POST['submit'])) {
        $data = [
            'p_nombre' => isset($_POST['p_nombre']) ? $_POST['p_nombre'] : '',
            'p_username' => isset($_POST['p_username']) ? $_POST['p_username'] : '',
            'p_pass' => isset($_POST['p_pass']) ? $_POST['p_pass'] : '',
            'p_email' => isset($_POST['p_email']) ? $_POST['p_email'] : '',
            'rol' => isset($_POST['rol']) ? $_POST['rol'] : 0,
        ];

        // Verificar si se proporcionó un ID para actualizar
        if (isset($_POST['p_Id']) && !empty($_POST['p_Id'])) {
            $objCrud->updateUser($_POST['p_Id'], $data);
        } else {
            $objCrud->createUser($data);
        }
    }

    // Eliminar Usuario
    if (isset($_POST['p_Id_delete'])) {
        $objCrud->deleteUser($_POST['p_Id_delete']);
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }
    </style>
</head>
<body>

     <!-- Lista de Usuarios en formato de tabla -->
     <?php 
    $usuarios = $objCrud->readUsers();
    if (!empty($usuarios)) {
        echo '<table class="table-danger">';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Nombre</th>';
        echo '<th>Username</th>';
        echo '<th>Email</th>';
        echo '<th>Rol</th>';
        echo '<th>Acciones</th>';
        echo '</tr>';

        foreach ($usuarios as $usuario) {
            echo '<tr>';
            echo '<td>' . $usuario['p_Id'] . '</td>';
            echo '<td>' . $usuario['p_nombre'] . '</td>';
            echo '<td>' . $usuario['p_username'] . '</td>';
            echo '<td>' . $usuario['p_email'] . '</td>';
            echo '<td>' . $usuario['rol'] . '</td>';
            echo '<td>
                    <form method="post" action="' . $_SERVER["PHP_SELF"] . '">
                        <input type="hidden" name="p_Id_delete" value="' . $usuario['p_Id'] . '">
                        <input type="submit" value="Eliminar">
                    </form>
                    </td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No hay usuarios para mostrar.';
    }
    ?>
</body>
</html>

