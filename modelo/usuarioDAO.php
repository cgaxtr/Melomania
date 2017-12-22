<?php
  require_once("db.php");
  require_once("usuario.php");
  class UsuarioDAO{

    public function login($email, $pass){
      $con = DB::getInstance()->getConnection();
      $query = $con->prepare("SELECT * FROM usuarios WHERE email = ? and contrasena = ?");
      $query->bind_param('ss', $email, $pass);
      $query->execute();
      $result = $query->get_result()->fetch_assoc();

      if ($result){
        //$id, $nombre, $apellido, $email, $pass, $type, $fecha, $estilos
        //SELECT estilos.nombre FROM estilos JOIN estilo_usuario ON estilos.id_estilo = estilo_usuario.id_estilo JOIN usuarios ON estilo_usuario.id_usuario = id WHERE id_usuario = 11;
        return new Usuario($result["id"], $result["nombre"], $result["apellido"], $result["email"], $result["contrasena"], $result["type"], date_format(date_create($result["fech_nacimiento"]), 'd-m-Y'), NULL);
      }else {
        return NULL;
      }
    }

    public function register($usuario){

      $con = DB::getInstance()->getConnection();
      $query = $con->prepare("SELECT * FROM usuarios WHERE email = ?");
      $email = $usuario->getEmail();
      $query->bind_param('s', $email);
      $query->execute();
      $query->store_result();

      if ($query->num_rows != 0)
        return false;

      $query = $con->prepare("INSERT INTO usuarios (nombre, apellido, email, contrasena, fech_nacimiento) VALUES (?,?,?,?,?)");
      $nombre = $usuario->getNombre();
      $apellido = $usuario->getApellido();
      $email = $usuario->getEmail();
      $pass = $usuario->getContrasena();
      $fecha = date_format(date_create($usuario->getFecha()), 'Y-m-d');
      $estilos = $usuario->getEstilos();

      $query->bind_param('sssss', $nombre, $apellido, $email, $pass, $fecha);
      $query->execute();

      $query = $con->prepare("INSERT INTO estilo_usuario SELECT id, id_estilo FROM usuarios, estilos WHERE email = ? AND estilos.nombre = ?");
      foreach ($estilos as $estilo) {
        $query->bind_param('ss', $email, $estilo);
        $query->execute();
      }

      $insert = $con->prepare("INSERT INTO grupo_usuario SELECT usuarios.id, id_grupo FROM grupo JOIN estilos ON grupo.id_estilo = estilos.id_estilo, usuarios WHERE (datediff(now(),fech_nacimiento)/365 BETWEEN edad_min AND edad_max) AND estilos.nombre = ? AND email=?");
      foreach ($estilos as $estilo) {
        $insert->bind_param('ss', $estilo, $email);
        $insert->execute();
      }

      return true;

    }

    public function getInformation($email){
      $con = DB::getInstance()->getConnection();

      $query = $con->prepare("SELECT * from usuarios WHERE email=?");
      $query->bind_param('s',$email);
      $query->execute();

      $result = $query->get_result()->fetch_assoc();

      return new Usuario($result["id"], $result["nombre"], $result["apellido"], $result["email"], $result["contrasena"], $result["type"], $result["fech_nacimiento"], NULL);

    }
  }
?>
