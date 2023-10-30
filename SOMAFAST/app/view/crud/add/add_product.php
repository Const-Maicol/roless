<?php include('../../../config/config.php'); 
$objConn=new Connection();
$conn=$objConn->getConnection();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">   
</head>
<body>
<style>
        body {
            font-family: Arial, sans-serif;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, textarea, button {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
<form method="POST">
    <label for="name">Nombre:</label>
    <input type="text" name="name" required>

    <label for="description">Descripción:</label>
    <textarea name="description"></textarea>

    <label for="images">Imágenes:</label>
    <input type="text" name="images">

    <label for="description_detailed">Descripción Detallada:</label>
    <textarea name="description_detailed"></textarea>

    <label for="category">Categoría:</label>
    <input type="text" name="category">

    <label for="due_date">Fecha de Vencimiento:</label>
    <input type="date" name="due_date" value="2023-08-31">

    <button type="submit"><a href="../../home/home.php">Agregar Producto</a></button>
</form>

<h2>Lista de Productos</h2>
<table border="1" class="table table-info">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Imágenes</th>
        <th>Descripción Detallada</th>
        <th>Categoría</th>
        <th>Fecha de Vencimiento</th>
    </tr>
    <?php
    include('../../../controller/crud.php');
    // Obtener la lista de productos
    $products = $objCrud->readProducts();

    // Mostrar los productos en la tabla
    foreach ($products as $product) {
        echo "<tr>
                <td>{$product['Id']}</td>
                <td>{$product['Name']}</td>
                <td>{$product['Description']}</td>
                <td>{$product['Images']}</td>
                <td>{$product['description_detailed']}</td>
                <td>{$product['category']}</td>
                <td>{$product['due_date']}</td>
                </tr>";   
 } 
    ?>
  
</table>
</body>
</html>
