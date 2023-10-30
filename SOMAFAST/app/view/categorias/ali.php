<?php
require('../../config/config.php'); // Requiere el archivo de configuración de la base de datos

// Filtra los productos por la categoría de electrodomésticos (categoría 1)
$categoryID = 2; // Ajusta esto según la categoría que representa electrodomésticos en tu base de datos
$sql = "SELECT Id, Name, Description, Images, description_detailed FROM products WHERE Category = $categoryID";
$result = $conn->query($sql);

$products = array(); // Almacena los productos en un array

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row; // Agrega cada fila al array de productos
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tienda de Electrodomésticos</title>
  <link rel="stylesheet" href="styles.css">
  <?php include('../assets/css/css.php'); ?>
</head>
<body>
  <?php include('../assets/view/header.php'); ?>

  <div class="container mt-5">
    <h2 class="text-center" style="font-size:50px; color:red;">Productos Destacados</h2>
        <!-- Carrusel (Carousel) -->
        <div class="d-flex justify-content-center">
    <div id="myCarousel" class="carousel slide mb-3" data-bs-ride="carousel" style="max-width: 600px; ">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../../assets/icons/img_products/mer.jpeg" class="d-block w-100" alt="Alimento 1">
    </div>
    <div class="carousel-item">
      <img src="../../assets/icons/img_products/mer1.jpeg" class="d-block w-100" alt="Alimento 2">
    </div>
    <div class="carousel-item">
      <img src="../../assets/icons/img_products/mer2.jpeg" class="d-block w-100" alt="Alimento 3">
    </div>
  </div>


  <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    </div>
    <div class="container">


      <?php
      foreach ($products as $product) {
          echo '<div class="row mt-3">';
          echo '  <div class="col-md-4 mb-4">';
          echo '    <div class="card">';
          echo '      <img src="' . $product["Images"] . '" class="card-img-top" alt="' . $product["Name"] . '">';
          echo '      <div class="card-body">';
          echo '        <h5 class="card-title">' . $product["Name"] . '</h5>';
          echo '        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProducto' . $product["Id"] . '">Ver Detalles</a>';
          echo '      </div>';
          echo '    </div>';
          echo '  </div>';
          echo '  <div class="col-md-8">';
          echo '    <p>' . $product["Description"] . '</p>';
          echo '  </div>';
          echo '</div>';
      }
      ?>
    </div>
  </div>

  <!-- Modales de productos -->
  <?php
  foreach ($products as $product) {
      echo '<div class="modal fade" id="modalProducto' . $product["Id"] . '" tabindex="-1" aria-labelledby="modalProducto' . $product["Id"] . 'Label" aria-hidden="true">';
      echo '  <div class="modal-dialog">';
      echo '    <div class="modal-content">';
      echo '      <div class="modal-header">';
      echo '        <h5 class="modal-title" id="modalProducto' . $product["Id"] . 'Label">Detalles del Producto</h5>';
      echo '        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
      echo '      </div>';
      echo '      <div class="modal-body">';
      echo '        <p>' . $product["description_detailed"] . '</p>';
      echo '      </div>';
      echo '      <div class="modal-footer">';
      echo '        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
      echo '      </div>';
      echo '    </div>';
      echo '  </div>';
      echo '</div>';
  }
  ?>

  <?php include('../assets/js/js.php') ?>
</body>
</html>
