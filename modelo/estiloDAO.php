<?php
  require_once("db.php");
  require_once("estilo.php");

  class EstiloDAO {

    public function create($estilo){
      $con = DB::getInstance()->getConnection();

      $query = $con->prepare("INSERT INTO estilos (nombre) VALUES (?)");
      $name = $estilo->getName();
      $query->bind_param('s', $name);

      return $query->execute();

    }

    public function delete($estilo){
      $con = DB::getInstance()->getConnection();

      $query = $con->prepare("DELETE FROM estilos WHERE id_estilo = ?");
      $id = $estilo->getId();
      $query->bind_param('i', $id);
      $query->execute();
    }

    public function getStyles(){
      $con = DB::getInstance()->getConnection();

      $result = array();
      $query = "SELECT * FROM estilos";

      if ($res = $con->query($query)){
        while($row = $res->fetch_row()){
          $estilo = new Estilo($row[0], $row[1]);
          array_push($result, $estilo);
        }
      }

      return  $result;
    }
  }

?>
