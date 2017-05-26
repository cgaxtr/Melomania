<?php
require_once("db.php");
require_once("grupo.php");

  class GrupoDAO {

    public function getAllGroups(){
      $con = DB::getInstance()->getConnection();

      $listGroup = array();
      $query = "SELECT id_grupo, estilos.nombre as estilo, grupo.nombre, edad_min, edad_max FROM grupo JOIN estilos ON grupo.id_estilo = estilos.id_estilo";
      if($result = $con->query($query)){
        while($row = $result->fetch_row()){
          $grupo = new Grupo($row[0], $row[1], $row[2], $row[3], $row[4]);
          array_push($listGroup, $grupo);
        }
      }

      return $listGroup;
    }

    public function create($grupo){
      $con = DB::getInstance()->getConnection();

      $query = $con->prepare("INSERT INTO grupo (id_estilo, nombre, edad_min, edad_max) VALUES ((SELECT id_estilo FROM estilos WHERE nombre=?),?,?,?)");
      //al crear grupo hay que meter a los que cumplen con los requisitos
      //    INSERT INTO TABLA_PADRE (CAMPO1, CAMPO2) SELECT CAMPO1,CAMPO2 FROM TABLA_HIJO;
      $nombre = $grupo->getNombre();
      $estilo = $grupo->getEstilo();
      $edad_min = $grupo->getEdadMin();
      $edad_max = $grupo->getEdadMax();

      $query->bind_param('ssii',$estilo, $nombre, $edad_min, $edad_max);
      $query->execute();

      $insert = $con->prepare("INSERT INTO grupo_usuario SELECT id, id_grupo FROM usuarios JOIN estilo_usuario ON estilo_usuario.id_usuario = usuarios.id JOIN estilos ON estilo_usuario.id_estilo = estilos.id_estilo, grupo WHERE (datediff(now(),fech_nacimiento)/365 BETWEEN ? and ?) and grupo.nombre = ? and estilos.nombre = ?");
      $insert->bind_param('iiss', $edad_min, $edad_max, $nombre, $estilo);
      $insert->execute();
    }

    public function getAPersonGroups($email){
      $groupsList = array();

      $con = DB::getInstance()->getConnection();
      $query = $con->prepare("SELECT grupo.id_grupo, estilos.nombre as estilo, grupo.nombre, edad_min, edad_max from grupo JOIN grupo_usuario ON grupo.id_grupo = grupo_usuario.id_grupo JOIN usuarios ON grupo_usuario.id_usuario = usuarios.id JOIN estilos ON grupo.id_estilo = estilos.id_estilo WHERE email=?");
      $query->bind_param('s', $email);
      $query->execute();
      $result = $query->get_result();

      while ($row = $result->fetch_assoc()) {

        $grupo = new Grupo($row["id_grupo"], $row["estilo"], $row["nombre"], $row["edad_min"], $row["edad_max"]);
        array_push($groupsList, $grupo);
      }
      return $groupsList;
    }
  }
 ?>
