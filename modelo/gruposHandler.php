<?php
  require_once("db.php");
  require_once("grupoDAO.php");

  $db = DB::getInstance()->getConnection();

  $email = $_REQUEST['id'];

  $grupoDAO = new GrupoDAO();
  $grupos = $grupoDAO->getAPersonGroups($email);
  $return = array();
  foreach ($grupos as $grupo) {
    $return[] = array(
      'nombre' => $grupo->getNombre()
    );
  }

    echo json_encode($return);
 ?>
