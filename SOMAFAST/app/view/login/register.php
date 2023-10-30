<?php
require_once("../../config/config.php");

$objConn=new Connection();
$conn=$objConn->getConnection();
$sql = "SELECT * FROM `document_type` WHERE 1;";
$sql .= "SELECT * FROM `gendertype` WHERE 1;";
$sql .= "SELECT * FROM `status` WHERE 1;";
$resultArray = array();
if (!$conn->multi_query($sql)) {
  echo "Falló la multiconsulta: (" . $conn->errno . ") " . $conn->error;
}

do {
  if ($result = $conn->store_result()) {


    $resultQuery = $result->fetch_all(MYSQLI_NUM);
    array_push($resultArray, $resultQuery);

    $result->free();
  }
} while ($conn->more_results() && $conn->next_result());
$resultDocumentType = $resultArray[0];
$resultGenderType = $resultArray[1];
$resultStatus = $resultArray[2];

?>

<title>Título de la página</title>
<!-- Incluir estilos CSS -->
<?php include('../assets/css/css.php'); ?>
<link rel="icon" type="image/png" href="../../assets/icons/logo.png">



<!-- Preloder -->
<div class="preloder" id="preloder">
  <div class="spinner-border text-light spinenrBtn" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>
<!-- End Preloder -->

<!-- Incluir el encabezado -->
<?php include('../assets/view/header.php'); ?>
<?php
class Usuario {
    private $id;
    private $username;
    private $password;
    private $email;
    private $numberOfDocument;
    private $numberCellphone;
    private $typeOfDocument;
    private $gender;

    public function __construct($id, $username, $password, $email, $numberOfDocument, $numberCellphone, $typeOfDocument, $gender) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->numberOfDocument = $numberOfDocument;
        $this->numberCellphone = $numberCellphone;
        $this->typeOfDocument = $typeOfDocument;
        $this->gender = $gender;
    }

    // Aquí puedes agregar más métodos según las funcionalidades que desees implementar.
}
?>
<br>
<br><br>
<!-- FORMULARIO -->
<form class="row g-3 container-fluid" id="form" method="POST" autocomplete="off"  action="../../controller/register.php" onsubmit="return validarFormulario()" onclick="vercontraseña()" >

  <p>Registrarse</p>
  <div class="col-md-6">
    <label for="validationDefault01" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="p_nombre" name="p_nombre" required>
  </div>
  <div class="col-md-6">
    <label for="validationDefault02" class="form-label">Username</label>
    <input type="text" class="form-control" id="p_username" name="p_username" required>
  </div>
  <div class="col-md-6">
            <label for="validationDefault03" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="p_pass" name="p_pass" required>
        </div>
        <div class="col-md-6">
            <label for="validationDefault03" class="form-label"> Repita su Contraseña</label>
            <input type="password" class="form-control" id="repeat_pass" name="repeat_pass" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="showPassword1" checked>
                <label class="form-check-label" for="showPassword1">Mostrar Contraseña</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="showPassword2" checked>
                <label class="form-check-label" for="showPassword2">Mostrar Contraseña</label>
            </div>
        </div>
    </div>

  <div class="col-md-6">
    <label for="validationDefaultUsername" class="form-label">Email</label>
    <div class="input-group">

      <input type="text" class="form-control" id="p_email" name="p_email" aria-describedby="inputGroupPrepend2" required>
    </div>
  </div>
  <div class="col-md-6">
    <label for="validationDefault03" class="form-label">Numero de documento</label>
    <input type="number" class="form-control" id="p_numberofdocument" name="p_numberofdocument" required>
  </div>
  <div class="col-md-6">
    <label for="validationDefault05" class="form-label">Numero telefonico</label>
    <input type="number" class="form-control" id="p_numbercellphone" name="p_numbercellphone" required>
  </div>
  <div class="col-md-6">
    <label for="validationDefault04" class="form-label">Tipo de documento</label>
    <select class="form-select" id="p_typeofdocument" name="p_typeofdocument" required>
      <option selected disabled value="">Elija su tipo de documento</option>
      <?php
      for ($i = 0; $i < count($resultDocumentType); $i++) :
      ?>
        <option value="<?= $resultDocumentType[$i][0] ?>"><?= $resultDocumentType[$i][1] ?></option>

      <?php
      endfor;
      ?>
    </select>
  </div>
  <div class="col-md-6">
    <label for="validationDefault04" class="form-label">Genero</label>
    <select class="form-select" id="p_gender" name="p_gender" required>
      <option selected disabled value="">Elija su genero</option>
      <?php
      for ($i = 0; $i < count($resultGenderType); $i++) :
      ?>
        <option value="<?= $resultGenderType[$i][0] ?>"><?= $resultGenderType[$i][1] ?></option>
      <?php
      endfor;
      ?>
    </select>
  </div>
 
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Enviar formulario</button>
  </div>
  <p class="small fw-bold mt-2 pt-1 mb-0">¿Ya tienes cuenta?
    <a href="../login/login.php" class="link-danger">Iniciar Sesion</a>
  </p>
</form>


<!-- Incluir scripts JavaScript -->
<?php include('../assets/js/js.php'); ?>