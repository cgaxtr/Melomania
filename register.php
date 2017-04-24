<?php session_start();
$_SESSION["login"] = True;
$_SESSION["name"] = "Carlos";
//unset($_SESSION["login"]);
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
      if(isset($_POST['submit'])){
        //$usuario = new Usuario();
        //$usuDAO = new UsuarioDAO();
        //if($usuDAO->register($usuario)){}
        ?>
        <div class="form-signin correct">
          <h2 class="form-signin-heading">Tu cuenta se ha creado correctamente</h2>
          <img src="./images/logo1.png"></img>
        </div>
      <?php
      }else{ ?>
        <form class="form-signin" method="post">
          <h2 class="form-signin-heading">Registrate</h2>
          <input id="first" type="text" class="form-control" name="name" placeholder="Name" required autofocus="" />
          <input type="text" class="form-control" name="lastname" placeholder="Last Name" required/>
          <input type="text" class="form-control" name="email" placeholder="Email" required/>
          <input id="last" type="password" class="form-control" name="password" placeholder="Password" required/>
          <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Registrar</button>
        </form>
    <?php
    } ?>
    </div>
  </body>
</html>
