<?php session_start();
require_once("modelo/estiloDAO.php");
require_once("modelo/estilo.php");
require_once("modelo/grupoDAO.php");
require_once("modelo/grupo.php");

if(isset($_POST["grupo"])){
  //$id, $estilo, $nombre, $edad_min, $edad_max
  $grupo = new Grupo(NULL, $_POST["estilo"], $_POST["nombre"], $_POST["min"],$_POST["max"]);
  $grupoDAO = new GrupoDAO ();
  $grupoDAO->create($grupo);
}elseif (isset($_POST["estilo"])) {
  $estilo = new Estilo(NULL, $_POST["nombre"]);
  $estiloDAO = new EstiloDAO();
  $estiloDAO->create($estilo);
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
      <div class="panel with-nav-tabs panel-default">
          <div class="panel-heading">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab1default" data-toggle="tab">Estilos</a></li>
              <li><a href="#tab2default" data-toggle="tab">Grupos</a></li>
            </ul>
          </div>

          <div class="panel-body">
              <div class="tab-content">
                  <div class="tab-pane fade in active" id="tab1default">

                    <div class="message" data-toggle="modal" data-target="#estilos">
                      <span class="glyphicon glyphicon-plus"></span>
                      <p>Añadir nuevo estilo</p>
                    </div>

                    <ul class="list-group">
                      <?php
                        $styleDAO = new EstiloDAO();
                        $listStyles = $styleDAO->getStyles();
                        foreach($listStyles as $style){ ?>
                          <li class="list-group-item"><?php echo $style->getName() ?><spam class="glyphicon glyphicon-trash"></spam></li>
                        <?php }
                       ?>
                    </ul>
                  </div>
                  <div class="tab-pane fade" id="tab2default">
                    <div class="message" data-toggle="modal" data-target="#grupos">
                      <span class="glyphicon glyphicon-plus"></span>
                      <p>Añadir nuevo grupo</p>
                    </div>

                    <ul class="list-group">
                      <?php
                        $groupsDAO = new GrupoDAO();
                          $listGroups = $groupsDAO->getAllGroups();
                          foreach($listGroups as $group){ ?>
                            <li class="list-group-item">
                              <h5>Nombre: <?php echo $group->getNombre(); ?></h1>
                              <h6>Estilo: <?php echo $group->getEstilo(); ?></h6>
                              <h6>Rango edad: <?php echo $group->getEdadMin(); ?> - <?php echo $group->getEdadMax(); ?></h6>
                            </li>
                          <?php } ?>
                    </ul>
                  </div>
                  </div>
              </div>
          </div>
      </div>
    </div>

    <!-- Modal Estilos-->
    <div id="estilos" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Nuevo estilo de musica</h4>
          </div>
          <form method="post">
            <div class="modal-body">
              <label for="title">Nombre del estilo</label>
              <input required type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre del estilo">
            </div>
            <div class="modal-footer">
              <button type"submit" name="estilo" class="btn btn-default">Enviar</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal estilos final-->

    <!-- Modal Grupos-->
    <div id="grupos" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Nuevo estilo de musica</h4>
          </div>
          <form method="post">
            <div class="modal-body">
              <label for="title">Nombre del grupo</label>
              <input required type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre del grupo">
              <label for="title">Estilo de musica</label>
              <input required type="text" name="estilo" class="form-control" id="nombre" placeholder="Estilo">
              <label for="title">Edad minima</label>
              <input required type="text" name="min" class="form-control" id="eMin" placeholder="Edad minima">
              <label for="title">Edad maxima</label>
              <input required type="text" name="max" class="form-control" id="eMan" placeholder="Edad maxima">
            </div>
            <div class="modal-footer">
              <button type"submit" name="grupo" class="btn btn-default">Enviar</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal grupos final-->

  </body>
</html>
