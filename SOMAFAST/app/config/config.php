<?php
require_once('constats.php');
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


?>