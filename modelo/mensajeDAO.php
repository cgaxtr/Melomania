<?php
  require_once("db.php");
  require_once("mensaje.php");

  class MensajeDAO{

      public function send($mensaje){
        $con = DB::getInstance()->getConnection();

        //$query = $con->prepare("INSERT INTO mensajes (idUsuario, idUsuarioDestino, titulo, texto) VALUES (?,?,?,?)");

        $query = $con->prepare("INSERT INTO mensajes (idUsuOrigen, idUsuDestino, titulo, texto, leido) VALUES ((SELECT id FROM usuarios WHERE email=?), (SELECT id FROM usuarios WHERE email=?) ,?,?,?)");

        $idUsuario = $mensaje->getUsuarioOrigen();
        $idUsuarioDestino = $mensaje->getUsuarioDestino();
        $titulo = $mensaje->getTitulo();
        $texto = $mensaje->getTexto();
        $leido = $mensaje->getLeido();

        $query->bind_param('ssssi', $idUsuario, $idUsuarioDestino, $titulo, $texto, $leido);
        return $query->execute();
      }

      //Gets messages without destinatary
      public function getMessagesForEveryone(){
        $mensaje = null;
        $mensajesList = array();

        $con = DB::getInstance()->getConnection();
        $consulta = "SELECT mensajes.id, titulo, texto, nombre, apellido, leido FROM mensajes INNER JOIN usuarios ON mensajes.idUsuOrigen = usuarios.id WHERE idUsuDestino is NULL AND id_grupo is NULL ORDER BY id DESC";
        if ($resultado = $con->query($consulta)){
          while($row = $resultado->fetch_row()){
            //$id, $usuOrigen, $usuDestino, $titulo, $texto)
            $mensaje = new Mensaje($row[0], $row[3]." ".$row[4],NULL, NULL,  $row[1], $row[2], $row[5]);
            array_push($mensajesList, $mensaje);
          }
        }

        return $mensajesList;
      }

      //Gets the messages that have the recipient id
      public function getMessagesTo($email){
        $mensaje = null;
        $mensajeList = array();

        $con = DB::getInstance()->getConnection();
        $query = $con->prepare("SELECT mensajes.id, titulo, texto, leido, origen.nombre as nombreOrigen, origen.apellido as apellidoOrigen,
          destino.nombre as nombreDestino, destino.apellido as apellidoDestino FROM mensajes, usuarios as destino, usuarios as origen
          WHERE mensajes.idUsuOrigen = origen.id and mensajes.idUsuDestino = destino.id and idUsuDestino = (SELECT id FROM usuarios WHERE email = ? ORDER BY id DESC)");
        $query->bind_param('s', $email);
        $query->execute();
        $result = $query->get_result();

        while ($row = $result->fetch_assoc()) {
          $mensaje = new Mensaje($row["id"], $row["nombreOrigen"]." ".$row["apellidoOrigen"], $row["nombreDestino"]." ".$row["apellidoDestino"], NULL, $row["titulo"], $row["texto"], $row["leido"]);
          array_push($mensajeList, $mensaje);
        }

        return $mensajeList;
      }

      public function getCountNoReadMessages(){
        $con = DB::getInstance()->getConnection();
        $query = $con->prepare("SELECT COUNT(leido) FROM mensajes WHERE leido=FALSE and idUsuDestino = (SELECT id FROM usuarios where email = ?);");
        $query->bind_param('s', $_SESSION["email"]);
        $query->execute();
        $result = $query->get_result();
        $result = $result->fetch_assoc();
        return $result["COUNT(leido)"];
      }

      public function setMessageRead($email){
        $con = DB::getInstance()->getConnection();
        $query = $con->prepare("UPDATE mensajes SET leido = TRUE WHERE idUsuDestino = (SELECT id FROM usuarios WHERE email=?)");
        $query->bind_param('s', $email);
        $query->execute();
      }

      public function getMessagesFromGroup($nombre){
        $listMessages = array();

        $con = DB::getInstance()->getConnection();
        $query = $con->prepare("SELECT mensajes.id, usuarios.nombre, usuarios.apellido, texto, titulo FROM mensajes JOIN grupo ON mensajes.id_grupo = grupo.id_grupo JOIN usuarios ON mensajes.idUsuOrigen = usuarios.id WHERE grupo.nombre = ? ORDER BY id DESC");
        $query->bind_param('s', $nombre);
        $query->execute();
        $result = $query->get_result();

        while ($row = $result->fetch_assoc()) {
          $mensaje = new Mensaje($row["id"], $row["nombre"]." ".$row["apellido"], NULL, NULL, $row["titulo"], $row["texto"], NULL);
          array_push($listMessages, $mensaje);
        }

        return $listMessages;
      }

      public function sendToGroup($mensaje){
        $con = DB::getInstance()->getConnection();

        $query = $con->prepare("INSERT INTO mensajes (idUsuOrigen, idUsuDestino, titulo, texto, leido, id_grupo) VALUES ((SELECT id FROM usuarios WHERE email=?), (SELECT id FROM usuarios WHERE email=?) ,?,?,?,(SELECT id_grupo FROM grupo WHERE nombre=?))");

        $idUsuario = $mensaje->getUsuarioOrigen();
        $idUsuarioDestino = $mensaje->getUsuarioDestino();
        $titulo = $mensaje->getTitulo();
        $texto = $mensaje->getTexto();
        $leido = $mensaje->getLeido();
        $grupo = $mensaje->getGrupo();

        $query->bind_param('ssssis', $idUsuario, $idUsuarioDestino, $titulo, $texto, $leido, $grupo);
        return $query->execute();
      }
  }
 ?>
