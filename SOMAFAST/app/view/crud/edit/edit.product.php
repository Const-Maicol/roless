<?php
include('../../../config/config.php');
include('../../../controller/crud.php');
$objCrud = new Crud($conn);

// Obtener el ID del producto de la URL
$productId = isset($_GET['id']) ? $_GET['id'] : null;

// Verificar si el formulario se envió mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores del formulario
    $productId = isset($_POST['id']) ? $_POST['id'] : null;
    $postData = [
        'name' => isset($_POST['name']) ? $_POST['name'] : '',
        'description' => isset($_POST['description']) ? $_POST['description'] : '',
        'images' => isset($_POST['images']) ? $_POST['images'] : '',
        // Agrega más campos según sea necesario
    ];

    // Actualizar el producto
    $updateResult = $objCrud->updateProduct($productId, $postData);

    if ($updateResult) {
        // Producto actualizado con éxito
        header('Location: ../../home/home.php');
        exit();
    } else {
        // Fallo en la actualización
        echo 'La actualización falló. Por favor, inténtalo de nuevo.';
    }
}

// Obtener los detalles del producto por ID después de haber asegurado $productId tiene un valor
$productData = $objCrud->getProductById($productId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
</head>
<body>
    <?php if ($productData) : ?>
        <?php include('../../assets/css/css.php');
        include('../../assets/js/js.php'); ?>
        <h1>Editar Producto</h1>
        <form action='' method='post'>
            <table class="table table-success table-striped">
                <tr>
                    <td>
                        <input type='hidden' name='id' value='<?php echo $productData['Id']; ?>'>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for='name'>Nombre:</label>
                    </td>
                    <td>
                        <input type='text' name='name' value='<?php echo $productData['Name']; ?>' required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for='description'>Descripción:</label>
                    </td>
                    <td>
                        <input type="text" name='description' value='<?php echo $productData['Description']; ?>'>
                    </td>
                </tr>
                <tr class=''>
                    <td>
                        <label for='description'>Img:</label>
                    </td>
                    <td>
                        <input type="url" name='images' value='<?php echo $productData['Images']; ?>'>
                    </td>
                </tr>
            </table>    
            <button type='submit' class="btn btn-success" style="font-family: cursive; display: flex; justify-content: center; align-items: center;">Actualizar Producto</button>
        </form>
    <?php else : ?>
        <p>El producto no existe o no se ha proporcionado un ID válido.</p>
    <?php endif; ?>
</body>

</html>