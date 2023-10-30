<?php
class User {
    private $id;
    private $nombre;
    private $username;
    private $pass;
    private $email;
    private $numberofdocument;
    private $numbercellphone;
    private $typeofdocument;
    private $gender;
    private $status;

    // Constructor
    public function __construct($id, $nombre, $username, $pass, $email, $numberofdocument, $numbercellphone, $typeofdocument, $gender, $status) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->username = $username;
        $this->pass = $pass;
        $this->email = $email;
        $this->numberofdocument = $numberofdocument;
        $this->numbercellphone = $numbercellphone;
        $this->typeofdocument = $typeofdocument;
        $this->gender = $gender;
        $this->status = $status;
    }

    // Métodos getters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getUsername() {
        return $this->username;
    }

}

class LoginController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        // Aquí manejarías la lógica del inicio de sesión
        // Verificar las credenciales, autenticar al usuario, establecer sesiones, etc.

        // Ejemplo: Después de verificar las credenciales y autenticar al usuario
        $username = 'ejemplo'; // Reemplaza esto con el nombre de usuario ingresado

        // Obtener información del usuario desde la base de datos
        $usuario = $this->userService->getUserByUsername($username);

        // Iniciar sesión
        session_start();
        
        // Guardar información del usuario en la sesión
        $_SESSION['usuario'] = $usuario;

        // Redirigir a la página principal
        header("Location: index.php");
    }

    public function showUserInfo()
    {
        // Iniciar sesión
        session_start();
        // Verificar si el usuario ha iniciado sesión
        if (isset($_SESSION['usuario'])) {
            // Obtener la información del usuario desde la sesión
            $usuario = $_SESSION['usuario'];
            // Cargar la vista con la información del usuario
            include('views/showUserInfo.php');
        } else {
            // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
            header("Location: login.php");
        }
    }
}


?>

