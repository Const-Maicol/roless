<?php
include('../../../config/config.php');
include('../../../controller/crud.php');

$objCrud = new Crud($conn);

// Obtener el ID del producto de la URL
$productId = isset($_GET['id']) ? $_GET['id'] : null;

// Obtener los detalles del producto por ID
$productData = $objCrud->getProductById($productId);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <?php if ($productData): ?>
        <h1>Detalles del Producto</h1>
        <table>
            <tr>
                <th>Atributo</th>
                <th>Valor</th>
            </tr>
            <tr>
                <td><strong>Nombre:</strong></td>
                <td><?php echo $productData['Name']; ?></td>
            </tr>
            <tr>
                <td><strong>Descripción:</strong></td>
                <td><?php echo $productData['Description']; ?></td>
            </tr>
            <!-- Agrega más detalles según tu estructura de datos -->
        </table>
    <?php else: ?>
        <p>El producto no existe o no se ha proporcionado un ID válido.</p>
    <?php endif; ?>
</body>
</html>
