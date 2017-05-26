<?php session_start();?>
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
    <?php include ('cabecera.php');?>

    <div class="jumbotron">
      <div class="container">
        <h1>Bienvenido</h1>
        <p>En melomania encontraras un lugar en el que compartir tu afición por la música con el resto, solo regístrate y disfura de la música</p>
        <?php if (!isset($_SESSION["login"])){ ?>
          <p><a class="btn btn-primary btn-lg" href="login.php" role="button">Únete &raquo;</a></p>
        <?php } ?>
      </div>
    </div>
  </body>
</html>
