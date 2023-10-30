<?php
include('../../../config/config.php');
include('../../../controller/crud.php');

$crud = new Crud($conn);

// Verificar si se envió el formulario de eliminación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_delete'])) {
    $productIdToDelete = $_POST['id_delete'];

    // Llamar al método deleteProduct
    $deleteResult = $crud->deleteProduct($productIdToDelete);

    if ($deleteResult) {
        // Producto eliminado con éxito
        header('Location: ../../home/home.php');
        exit();
    } else {
        // Fallo en la eliminación
        echo 'La eliminación falló. Por favor, inténtalo de nuevo.';
    }
}

// Obtener detalles del producto por ID
$productId = isset($_GET['id']) ? $_GET['id'] : null;
$productData = $crud->getProductById($productId);

// Verificar si $productData está definida y no es nula
if ($productData && isset($productData['Id'])) {
    $productId = $productData['Id'];
    $productName = $productData['Name'];
} else {
    // Definir valores predeterminados o mostrar un mensaje de error
    $productId = '';
    $productName = 'Producto no encontrado';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>
</head>
<body>
    <h1>Eliminar Producto</h1>
    <form action='delete_product.php' method='post'> <!-- Corrige la acción del formulario -->
        <input type='hidden' name='id_delete' value='<?php echo $productId; ?>'>
        <p>¿Estás seguro de que deseas eliminar el producto "<?php echo $productName; ?>"?</p>

        <button type='submit'>Eliminar Producto</button>
        <a href="../../crud/crud.php">Cancelar</a>
    </form>
</body>
</html>
