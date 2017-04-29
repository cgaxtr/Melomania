<?php
  require_once("db.php");

  class MensajeDAO{

      public function send($mensaje){
        $con = DB::getInstance()->getConnection();
        $query = $con->prepare("INSERT INTO mensajes (idUsuario, idUsuarioDestino, titulo, texto) VALUES (?,?,?,?)");

        $idUsuario = $mensaje->getIdUsuarioOrigen();
        $idUsuarioDestino = $mensaje->getIdUsuarioDestino();
        $titulo = $mensaje->getTitulo();
        $texto = $mensaje->getTexto();

        $query->bind_param('iiss', $idUsuario, $idUsuarioDestino, $titulo, $texto);
        return $query->execute();
      }

      //Gets messages without destinatary
      public function getMessagesForEveryone(){
        $mensaje = null;
        $mensajesList = array();

        $con = DB::getInstance()->getConnection();
        $consulta = "SELECT * FROM mensajes WHERE idUsuarioDestino is NULL ";
        if ($resultado = $con->query($consulta)){
          while($row = $resultado->fetch_row()){
            $mensaje = new Mensaje($row[0], $row[1], $row[2], $row[3], $row[4]);
            array_push($mensajesList, $mensaje);
          }
        }

        return $mensajesList;
      }

      //Gets the messages that have the recipient id
      public function getMessagesTo($id){
        $mensaje = null;
        $mensajeList = array();

        $con = DB::getInstance()->getConnection();
        $query = $con->prepare("SELECT * FROM mensajes WHERE idUsuarioDestino = ? ");
        $query->bind_param('i', $id);
        $query->execute();
        $result = $query->get_result();

        while ($row = $result->fetch_assoc()) {
          $mensaje = new Mensaje($row["id"], $row["idUsuario"], $row["idUsuarioDestino"], $row["titulo"], $row["texto"]);
          array_push($mensajeList, $mensaje);
        }

        return $mensajeList;
      }
  }
 ?>
