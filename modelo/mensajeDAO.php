<?php
  require_once("db.php");
  require_once("mensaje.php");

  class MensajeDAO{

      public function send($mensaje){
        $con = DB::getInstance()->getConnection();

        //$query = $con->prepare("INSERT INTO mensajes (idUsuario, idUsuarioDestino, titulo, texto) VALUES (?,?,?,?)");

        $query = $con->prepare("INSERT INTO mensajes (idUsuOrigen, idUsuDestino, titulo, texto) VALUES ((SELECT id FROM usuarios WHERE email=?), (SELECT id FROM usuarios WHERE email=?) ,?,?)");

        $idUsuario = $mensaje->getUsuarioOrigen();
        $idUsuarioDestino = $mensaje->getUsuarioDestino();
        $titulo = $mensaje->getTitulo();
        $texto = $mensaje->getTexto();

        $query->bind_param('ssss', $idUsuario, $idUsuarioDestino, $titulo, $texto);
        return $query->execute();
      }

      //Gets messages without destinatary
      public function getMessagesForEveryone(){
        $mensaje = null;
        $mensajesList = array();

        $con = DB::getInstance()->getConnection();
        $consulta = "SELECT mensajes.id, titulo, texto, nombre, apellido FROM mensajes INNER JOIN usuarios ON mensajes.idUsuOrigen = usuarios.id";
        if ($resultado = $con->query($consulta)){
          while($row = $resultado->fetch_row()){
            //$id, $usuOrigen, $usuDestino, $titulo, $texto)
            $mensaje = new Mensaje($row[0], $row[3]." ".$row[4], NULL,  $row[1], $row[2]);
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
      }
  }
 ?>
