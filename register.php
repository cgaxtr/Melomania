<?php session_start();
include("./modelo/usuario.php");
include("./modelo/usuarioDAO.php");

if(isset($_POST['submit']) && $_POST['submit'] == 'register'){
  $boolRegister = False;
  $usuario = new Usuario(null, $_POST['name'], $_POST['lastname'], $_POST['email'], $_POST['password'], null);
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
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Melomania</title>
  </head>
  <body>

    <?php include_once ('cabecera.php');?>

    <div class="wrapper">
      <?php
      if(isset($boolRegister) && $boolRegister){
        echo "registrado correctamente";
      }else if(isset($boolRegister) && !$boolRegister){
        echo "registro fallido";
      }else{
        echo "formulario registro";
      }
       ?>
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Registrate</h2>
        <input id="first" type="text" class="form-control" name="name" placeholder="Name" required autofocus="" />
        <input type="text" class="form-control" name="lastname" placeholder="Last Name" required/>
        <input type="text" class="form-control" name="email" placeholder="Email" required/>
        <input id="last" type="password" class="form-control" name="password" placeholder="Password" required/>
        <button class="btn btn-lg btn-primary btn-block" value="register" type="submit" name="submit">Registrar</button>
      </form>
    </div>
  </body>
</html>
