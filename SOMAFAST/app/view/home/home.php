<!DOCTYPE html>
<html>

<head>
  <title>Ventas en Línea</title>
  <?php include('../assets/css/css.php'); ?>
  <style>
  body {
    background: linear-gradient(to bottom, #a6c0fe, #fbc2eb); /* Gradiente de azul claro a morado claro */
    margin: 0; /* Elimina el margen predeterminado del cuerpo */
    padding: 0; /* Elimina el relleno predeterminado del cuerpo */
  }
</style>

  <?php include('../assets/js/js.php'); ?>
</head>

<body>

  <?php include('../assets/view/header.php'); ?>


  <main>
    <br>
    <section class="banner">
      <br>
      <br>
      <div style="text-align: center; color: #3498db;">
      <br>
        <h1>Bienvenido a nuestra tienda en línea</h1>
      </div>
      <p>Compra tus productos favoritos ahora mismo</p>
    </section>

    <!-- Products -->
    <section class="products">
      <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">

        <div class="row">
         
    <?php include('../../controller/home.php'); ?>



        </div>
      </div>
    </section>
  </main>

</body>

</html>