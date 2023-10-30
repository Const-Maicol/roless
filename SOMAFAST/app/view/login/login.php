<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>INICIAR SESION</title>
<!-- Incluir estilos CSS -->
<?php include ('../assets/css/css.php');
?>


<div class="preloder" id="preloder">
  <div class="spinner-border text-warning spinenrBtn" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>

</div>

<!-- Incluir el encabezado -->
<?php include('../assets/view/header.php'); ?>

<?php

class LoginForm {
    private $username;
    private $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function renderForm() {
        // The HTML code for the login form
        echo "
        <section class='vh-100'>
          <div class='container-fluid h-custom'>
            <div class='row d-flex justify-content-center align-items-center h-100'>
               <div class='col-md-9 col-lg-6 col-xl-5'>
                <img src='https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp'
                  class='img-fluid' alt='Sample image'>
              </div>
              <div class='col-md-8 col-lg-6 col-xl-4 offset-xl-1'>
                <form method='POST' action='../../controller/login.php' id='login' autocomplete='off'>
                  <p class='lead fw-normal mb-0 me-3 text-center'>Iniciar Sesion</p>
                  <div class='divider d-flex align-items-center my-4'>
                  </div>
                  <!-- Email input -->
                  <div class='form-outline mb-4'>
                    <input type='text' id='p_username' name='p_username' class='form-control form-control-lg'
                      placeholder='Enter a valid username' />
                    <label class='form-label' for='p_username'>Username</label>
                  </div> 
                  <!-- Password input -->
                  <div class='form-outline mb-3'>
                    <input type='password' id='p_pass' name='p_pass' class='form-control form-control-lg'
                      placeholder='Enter password' />
                    <label class='form-label' for='p_pass'>Password</label>
                  </div>
                  <div  class='d-flex justify-content-between align-items-center'>
                    <a href='../../view/login/recuperar.php' class='text-body'>Forgot password?</a>
                  </div>
                  <div class='text-center text-lg-start mt-4 pt-2'>
                    <button type='submit' class='btn btn-primary btn-lg'
                      style='padding-left: 2.5rem; padding-right: 2.5rem;'>Login <a href='../../view/home/home.php'></a></button>
                    <p class='small fw-bold mt-2 pt-1 mb-0'>Don't have an account? <a href='../../view/login/register.php'
                        class='link-danger'>Register</a></p>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
        ";
    }
}

// Example usage:
$username = $_POST['p_username'] ?? '';
$password = $_POST['p_pass'] ?? '';

$loginForm = new LoginForm($username, $password);
$loginForm->renderForm();

?>

</section>


<?php
    include('../../view/assets/js/js.php');
?>