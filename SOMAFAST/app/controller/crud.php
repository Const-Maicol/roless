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

class Crud {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createProduct($data) {
        // Otras variables
        $name = $data['name'];
        $description = $data['description'];
        $images = $data['images'];
        $description_detailed = $data['description_detailed'];
        $category = $data['category'];
        $due_date = $data['due_date'];
    
        // Verificar si la categoría existe en typeproduct
        $categoryExists = $this->isCategoryExists($category);
    
        if ($categoryExists) {
            $sql = "INSERT INTO `products` (`Name`, `Description`, `Images`, `description_detailed`, `category`, `due_date`)
                    VALUES ('$name', '$description', '$images', '$description_detailed', $category, '$due_date')";
    
            return $this->conn->query($sql);
        } else {
            // Manejar el caso en que la categoría no existe
            return false;
        }
    }
    
    private function isCategoryExists($categoryId) {
        $sql = "SELECT * FROM `typeproduct` WHERE `typeProduct_id` = $categoryId";
        $result = $this->conn->query($sql);
        return $result->num_rows > 0;
    }

    public function readProducts() {
        $sql = "SELECT * FROM `products`";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateProduct($id, $data) {
        $name = $data['name'];
        $description = $data['description'];
        $images = $data['images'];
    
        $sql = "UPDATE `products`
                SET `Name` = '$name', `Description` = '$description', `Images` = '$images'
                WHERE `Id` = $id";
    
        return $this->conn->query($sql);

        
    }
    

    public function deleteProduct($id) {
        $sql = "DELETE FROM `products` WHERE `Id` = $id";
        return $this->conn->query($sql);
    }

    // Método para obtener detalles de un producto por ID
    public function getProductById($id) {
        if ($id === null) {
            return false; // O maneja el caso de ID nulo de acuerdo a tus necesidades
        }
    
        $sql = "SELECT * FROM `products` WHERE `Id` = $id";
        $result = $this->conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
}

$objCrud = new Crud($conn);

// Lógica para manejar formularios
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Agregar Producto
    if (isset($_POST['name'])) {
        $data = [
            'name' => $_POST['name'],
            'description' => isset($_POST['description']) ? $_POST['description'] : '',
            'images' => isset($_POST['images']) ? $_POST['images'] : '',
            'description_detailed' => isset($_POST['description_detailed']) ? $_POST['description_detailed'] : '',
            'category' => isset($_POST['category']) ? $_POST['category'] : 0,
            'due_date' => isset($_POST['due_date']) ? $_POST['due_date'] : '2023-08-31'
        ];
        $objCrud->createProduct($data);
    }

    // Actualizar Producto
  // Lógica para manejar formularios
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $crud = new Crud($conn);

    // Actualizar Producto
    if (isset($_POST['id'])) {
        $data = [
            'name' => isset($_POST['name']) ? $_POST['name'] : '',
            'description' => isset($_POST['description']) ? $_POST['description'] : '',
            'images' => isset($_POST['images']) ? $_POST['images'] : ''
        ];
        $crud->updateProduct($_POST['id'], $data);
    }
}


    // Eliminar Producto
    if (isset($_POST['id_delete'])) {
        $objCrud->deleteProduct($_POST['id_delete']);
    }
}

?>
