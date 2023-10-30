<?php
require_once('../config/constats.php');
// Conexión a la base de datos
class Connection {
    private $host ;
    private $user;
    private $pass;
    private $db;

    protected $conn;

    public function __construct(){
       $this->host = SERVER;
       $this->user = USER;
       $this->pass = PASS;
       $this->db = DB;
       $this->conn = null;
   
    }
    public function getConnection() { 
       try {
           $this->conn = new mysqli($this->host,$this->user,$this->pass,$this->db);
           if (!$this->conn) {
               die('Error al conectar a la base de datos: ' . mysqli_connect_error());
           } else {
               echo"";
           } 
           return new mysqli($this->host, $this->user, $this->pass, $this->db);
       } catch (Exception $e){
           echo "error" . $e->getMessage();
       } 
       return  $this->conn;

    }
public function closeConnection() {
   $this->conn->close();   
} 
    
} 



class UserController {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getUsers() {
        $sql = "SELECT * FROM usuarios";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addUser($nombre, $username, $pass, $email, $numberofdocument, $numbercellphone, $typeofdocument, $gender, $status) {
        $sql = "INSERT INTO usuarios (p_nombre, p_username, p_pass, p_email, p_numberofdocument, p_numbercellphone, p_typeofdocument, p_gender, Status) VALUES ('$nombre', '$username', '$pass', '$email', $numberofdocument, $numbercellphone, $typeofdocument, $gender, $status)";
        return $this->conn->query($sql);
    }

    public function editUser($userId, $nombre, $username, $pass, $email, $numberofdocument, $numbercellphone, $typeofdocument, $gender, $status) {
        $sql = "UPDATE usuarios SET p_nombre='$nombre', p_username='$username', p_pass='$pass', p_email='$email', p_numberofdocument=$numberofdocument, p_numbercellphone=$numbercellphone, p_typeofdocument=$typeofdocument, p_gender=$gender, Status=$status WHERE p_Id=$userId";
        return $this->conn->query($sql);
    }

    public function deleteUser($userId) {
        $sql = "DELETE FROM usuarios WHERE p_Id=$userId";
        return $this->conn->query($sql);
    }
}
?>
