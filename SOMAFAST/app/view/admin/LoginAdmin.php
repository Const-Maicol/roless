<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<style>
.gradient-custom-2 {
/* fallback for old browsers */
background: #fccb90;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
}

@media (min-width: 768px) {
.gradient-form {
height: 100vh !important;
}
}
@media (min-width: 769px) {
.gradient-custom-2 {
border-top-right-radius: .3rem;
border-bottom-right-radius: .3rem;
}
}

</style>
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
        <section class='h-100 gradient-form' style='background-color: #eee;'>
            <div class='container py-5 h-100'>
                <div class='row d-flex justify-content-center align-items-center h-100'>
                    <div class='col-xl-10'>
                        <div class='card rounded-3 text-black'>
                            <div class='row g-0'>
                                <div class='col-lg-6'>
                                    <div class='card-body p-md-5 mx-md-4'>
                                        <div class='text-center'>
                                            <img src='../../../public/assets/icons/logo.png'
                                                style='width: 185px;' alt='logo'>
                                            <h4 class='mt-1 mb-5 pb-1'>Somos grupo SOMAFAST(ADMIN)</h4>
                                        </div>

                                        <form method='POST' action='../../controller/login.php' id='login' autocomplete='off'>
                                            <p>Please login to your account</p>

                                            <div class='form-outline mb-4'>
                                                <input type='text' id='p_username' name='p_username' class='form-control' />
                                                <label class='form-label' for='p_username'>Nombre de usuario
                                                </label>
                                            </div>

                                            <div class='form-outline mb-4'>
                                                <input type='password' id='p_pass' name='p_pass' class='form-control' />
                                                <label class='form-label' for='p_pass'>Constraseña</label>
                                            </div>

                                            <div class='text-center pt-1 mb-5 pb-1'>
                                                <button class='btn btn-primary btn-block fa-lg gradient-custom-2 mb-3' type='submit'><a href='../admin/Admin.php' style='text-decoration: none; color: white;'>Ingresar</a></button>
                                                <a class='text-muted' href='../login/recuperar.php' style='text-decoration: none;'>Forgot password?</a>
                                            </div>

                                            
                                        </form>
                                    </div>
                                </div>
                                <div class='col-lg-6 d-flex align-items-center gradient-custom-2'>
                                    <div class='text-white px-3 py-4 p-md-5 mx-md-4'>
                                        <h4 class='mb-4'>Somos más que una simple empresa</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<a href="../../../public/assets/icons/logo.png"></a>