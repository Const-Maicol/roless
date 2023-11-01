<?php require_once('../../view/assets/css/css.php'); ?>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Seleccionar todos los botones de compra
    var botonesCompra = document.querySelectorAll('.btn-comprar');

    // Añadir un evento de clic a cada botón
    botonesCompra.forEach(function (boton) {
      boton.addEventListener('click', function () {
        // Obtener el nombre del producto desde el atributo data-producto
        var nombreProducto = this.getAttribute('data-producto');

        // Llamar a la función para agregar al carrito
        agregarAlCarrito(nombreProducto);
      });
    });

    // Función para agregar al carrito
    function agregarAlCarrito(producto) {
      // Aquí puedes agregar la lógica para almacenar el producto en el carrito
      // Por ahora, solo mostrar un mensaje en la consola
      console.log('Producto agregado al carrito:', producto);
    }
  });
</script>
<?php
          // Crear la conexión
          $servername = "localhost";
          $username = "root";
          $password = "";
          $database = "online_store";

          // Crear la conexión
          $conn = new mysqli($servername, $username, $password, $database);

          // Verificar la conexión
          if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
          }

          // Realizar una consulta SQL (ajusta la consulta según tu estructura de base de datos)
          $sql = "SELECT titulo, url, description FROM img";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // Mostrar los datos en tarjetas
            echo '<div class="row">';
            while ($row = $result->fetch_assoc()) {
              echo '<div class="col-md-4">';
              echo '<h4>' . $row['titulo'] . '</h4>';
              echo '<div class="card custom-card';
          
              // Agregar margen superior solo para la segunda fila
              if ($result->current_field >= 3) {
                echo ' second-row-card';
              }
          
              echo '">'; // Cerrar la clase custom-card
              echo '<img src="' . $row['url'] . '" class="card-img-top custom-img" alt="...">';
              echo '<div class="card-body">';
              echo '<h5 class="card-title">' . $row['titulo'] . '</h5>'; 
              echo '<p class="card-text">' . $row['description'] . '</p>';
              echo '<button class="btn btn-success btn-comprar" data-producto="Producto 1">Comprar</button>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
            echo '</div>'; // Cierra la fila después de mostrar todas las tarjetas
          } else {
            echo "No se encontraron resultados";
          }

          $sql = "SELECT Name, Description, Images FROM products";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // Mostrar los datos en tarjetas
            echo '<div class="row">';
            while ($row = $result->fetch_assoc()) {
              echo '<div class="col-md-4">';
              echo '<h4>' . $row['Name'] . '</h4>';
              echo '<div class="card custom-card';
          
              // Agregar margen superior solo para la segunda fila
              if ($result->current_field >= 3) {
                echo ' second-row-card';
              }
          
              echo '">'; // Cerrar la clase custom-card
              echo '<img src="' . $row['Images'] . '" class="card-img-top custom-img" alt="...">';
              echo '<div class="card-body">';
              echo '<h5 class="card-title">' . $row['Name'] . '</h5>'; 
              echo '<p class="card-text">' . $row['Description'] . '</p>';
              echo '<button class="btn btn-success btn-comprar" data-producto="Producto 1">Comprar</button>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
            echo '</div>'; // Cierra la fila después de mostrar todas las tarjetas
          } else {
            echo "No se encontraron resultados";
          }
          
          // Cerrar la conexión
          $conn->close();
          ?>