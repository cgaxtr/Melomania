<?php session_start();
include("modelo/grupoDAO.php");
include("modelo/mensajeDAO.php");

if(isset($_POST["submit"])){
  $mensajeDAO = new mensajeDAO();

  //$id, $usuOrigen, $usuDestino, $grupo, $titulo, $texto, $leido
  $mensaje = new mensaje(NULL, $_SESSION["email"], NULL, $_POST["grupo"], $_POST["titulo"], $_POST["texto"], TRUE);
  $mensajeDAO->sendToGroup($mensaje);
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
    <script src="js/ajax.js"></script>
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
                <label for="title">Grupo</label>
                <select required name="grupo" id="<?php echo $_SESSION['email'] ?>" class="form-control" id="destinatario"></select>
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
      <h4 id="tituloGrupos">Grupos a los que perteneces</h4>
      <?php
        $grupoDAO = new grupoDAO();
        $listGroups = $grupoDAO->getAPersonGroups($_SESSION["email"]);
        $count = 0;
        $mensajeDAO = new MensajeDAO();
        foreach ($listGroups as $group) {
          $listMessages = $mensajeDAO->getMessagesFromGroup($group->getNombre());
          ?>
          <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" href="#collapse<?php echo $count ?>"><?php echo $group->getNombre() ?></a>
                </h4>
              </div>

              <div id="collapse<?php echo $count ?>" class="panel-collapse collapse">
                <div class="panel-body">
                  <div class="list-group grupos">

                  <?php
                    foreach ($listMessages as $menssage){
                    ?>
                      <a href="#" class="list-group-item">
                        <h4 class="list-group-item-heading">Titulo:  <?php echo $menssage->getTitulo() ?> </h4>
                        <h6 class="author">Autor: <?php echo $menssage->getUsuarioOrigen(); ?> </h6>
                        <p class="list-group-item-text"> <?php echo $menssage->getTexto(); ?></p>
                      </a>
                    <?php }
                    $count++; ?>
                  </div>
                </div>

              </div>
            </div>
          </div>
        <?php
        }
       ?>
    </div>
  </body>
</html>
