
<nav style="background: linear-gradient(to right, #3498db, #9b59b6); padding: 10px;" class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container-fluid">
  <a class="navbar-brand" href="./../../view/home/home.php"> <img src="../../assets/icons/logo.png" width="80" class="img-fluid" /> </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="./../../view/home/home.php">Inicio</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gestion de Usuarios
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="./../../view/login/register.php">Crear Cuenta</a></li>
            <li><a class="dropdown-item" href="./../../view/login/login.php">Iniciar Sesion</a></li>
            <li><a class="dropdown-item" href="./../../view/login/recuperar.php">Recuperar Contraseña</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gestion de Productos
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="./../../view/crud/crud.php">Todo tipo de funcion para el prodcuto</a></li>
          </ul>
        </li>
      </ul>

    </div>
  </div>
</nav>



<style>
  /* Estilo del fondo del header */
  header {
    background: linear-gradient(to right, #3498db, #9b59b6); /* Degradado de azul a morado */
    padding: 10px; /* Añadimos un poco de relleno al header */
  }

  /* Estilo de la barra de navegación */
  .navbar {
    background-color: transparent; /* Hacemos la barra de navegación transparente */
    box-shadow: none; /* Quitamos la sombra */
  }

  /* Estilo del enlace de la marca (logo) */
  .navbar-brand {
    color: #ffffff; /* Blanco */
    font-weight: bold; /* Texto en negrita */
    text-decoration: none; /* Sin subrayado */
  }

  /* Estilo de los enlaces en la barra de navegación */
  .navbar-nav .nav-link {
    color: #ffffff; /* Blanco */
    font-weight: bold; /* Texto en negrita */
  }

  .navbar-nav .nav-link:hover,
  .navbar-nav .nav-link.active {
    color: #ecf0f1; /* Blanco más claro al pasar el ratón o cuando está activo */
  }

  /* Estilo del botón de búsqueda */
  .btn-outline-success {
    color: #3498db; /* Azul */
  }

  /* Estilo del formulario de búsqueda */
  .form-control {
    border-color: #3498db; /* Azul para el borde del campo de búsqueda */
  }

  /* Estilo del botón de búsqueda */
  .btn-outline-success:hover {
    background-color: #ffffff; /* Blanco al pasar el ratón sobre el botón de búsqueda */
    color: #3498db; /* Cambio de color del ícono de búsqueda al pasar el ratón */
  }

  /* Estilo del menú desplegable */
  .dropdown-menu {
    background-color: #3498db; /* Azul */
  }

  .dropdown-item {
    color: #ffffff; /* Blanco */
  }

  .dropdown-item:hover {
    background-color: #2980b9; /* Azul más oscuro al pasar el ratón sobre el elemento del menú desplegable */
  }
</style>