<?php session_start();
require_once("modelo/mensajeDAO.php");

if(isset($_POST["submit"])){
  $mesDAO = new MensajeDAO();
  $message = new Mensaje(NULL, $_SESSION["email"], NULL, $_POST["titulo"], $_POST["texto"]);
  $mesDAO->send($message);
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
    <?php include ('cabecera.php');?>
    <div class="wrapper">

      <?php
      if (isset($_SESSION["login"])){
      ?>
      <div class="message" data-toggle="modal" data-target="#myModal">
        <img src="./images/send-button.png" ></img>
        <p>Mandar nuevo mensaje</p>
      </div>
      <?php
      }
      ?>
      <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

      <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Nuevo mensaje</h4>
          </div>
          <form method="post">
            <div class="modal-body">
              <label for="title">Titulo</label>
              <input required type="text" name="titulo" class="form-control" id="title" placeholder="Titulo">
              <label for="text">Cuerpo mensaje</label>
              <textarea required class="form-control" name="texto" id="text" placeholder="Texto"></textarea>
            </div>
            <div class="modal-footer">
              <button type"submit" name="submit" class="btn btn-default">Enviar</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </form>
        </div>
    </div>
  </div>
  <!-- Modal content final-->

  <div class="list-group">

  <?php
    $menDAO = new MensajeDAO();
    $listMessages = $menDAO->getMessagesForEveryone();
    foreach ($listMessages as $menssage){
    ?>
      <a href="#" class="list-group-item">
        <h4 class="list-group-item-heading">Titulo:  <?php echo $menssage->getTitulo() ?> </h4>
        <h6 class="author">Autor: <?php echo $menssage->getUsuarioOrigen(); ?> </h6>
        <p class="list-group-item-text"> <?php echo $menssage->getTexto(); ?></p>
      </a>

    <?php } ?>

</div>
</div>

  </body>
</html>
