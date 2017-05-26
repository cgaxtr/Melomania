<?php session_start();
include("./modelo/usuario.php");
include("./modelo/usuarioDAO.php");
include("./modelo/estiloDAO.php");

if(isset($_POST['submit']) && $_POST['submit'] == 'register'){
  $boolRegister = False;
  $usuario = new Usuario(null, $_POST['name'], $_POST['lastname'], $_POST['email'], $_POST['password'], null, $_POST["fecha"], $_POST["estilos"]);
  $uDao = new UsuarioDAO();
  if($boolRegister = $uDao->register($usuario)){
    $_SESSION["login"] = True;
    $_SESSION["name"] = $_POST["name"];
    $_SESSION["type"] = "user";
    $_SESSION["email"] = $_POST["email"];
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./style/styles.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-*.min.js"></script>
    <script src="js/scripts.js"></script>

    <title>Melomania</title>
  </head>
  <body>

    <?php include_once ('cabecera.php');?>

    <div class="wrapper">
      <?php
      if(isset($boolRegister) && $boolRegister){ ?>
        <div class="form-signin correct">
          <h2 class="form-signin-heading">Tu cuenta se ha creado correctamente</h2>
          <img src="./images/logo1.png"></img>
        </div>
      <?php }else if(isset($boolRegister) && !$boolRegister){ ?>
        <div class="form-signin incorrect">
          <h2 class="form-signin-heading">Existe una cuenta asociada a ese email</h2>
          <img src="./images/logo1.png"></img>
        </div>

      <?php }else{
       ?>
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Registrate</h2>
        <input id="first" type="text" class="form-control" name="name" placeholder="Name" required autofocus="" />
        <input type="text" class="form-control" name="lastname" placeholder="Last Name" required/>
        <input type="text" class="form-control" name="email" placeholder="Email" required/>
        <input type='text' class="form-control" id="datepicker" placeholder="Date" name="fecha" format="DD-MM-YYYY"/>
        <select class="selectpicker" multiple title="Choose types of music" name="estilos[]">
          <?php
          $estiloDAO = new EstiloDAO();
          $listEstilos = $estiloDAO->getStyles();
          foreach ($listEstilos as $estilo) {
            echo "<option value=".$estilo->getName().">".$estilo->getName()."</option>";

          } ?>
        </select>
        <input id="last" type="password" class="form-control" name="password" placeholder="Password" required/>
        <button class="btn btn-lg btn-primary btn-block" value="register" type="submit" name="submit">Registrar</button>
      </form>
      <?php } ?>
    </div>
  </body>
</html>
