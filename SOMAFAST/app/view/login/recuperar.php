
<?php include('../assets/css/css.php'); ?>
<?php include('../assets/css/css2.php'); ?>

<div class="preloder" id="preloder">
  <div class="spinner-border text-success spinenrBtn" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>
<?php include('../assets/view/header.php'); ?>
<body>
<br>
<br><br>
        <div class="card">
            <div class="panel">
                <div class="panel-heading text-center">
                    <h3><i class="fa fa-lock fa-4x"></i></h3>
                    <h2>¿Has olvidado tu contraseña?</h2>
                </div>
                <div class="panel-body">
                    <p>Puede restablecer su contraseña aquí.</p>
                    <form id="register-form" action="../../controller/reseat.php" role="form" autocomplete="off" class="form" method="POST">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                <input id="p_email" name="p_email" placeholder="Correo Electronico" class="form-control" type="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input name="recover-submit" class="btn btn-lg btn-warning   btn-block" value="Reestablecer Contraseña" type="submit">
                        </div>
                        <input type="hidden" class="hide" name="token" id="token" value="">
                    </form>
                </div>
            </div>
        </div>
</body>


    <?php include('../assets/js/js.php'); ?>
