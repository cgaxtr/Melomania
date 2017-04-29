<?php
  require_once("db.php");
  class UsuarioDAO{

    public function login($email, $pass){
      $con = DB::getInstance()->getConnection();
      $query = $con->prepare("SELECT * FROM usuarios WHERE email = ? and contrasena = ?");
      $query->bind_param('ss', $email, $pass);
      $query->execute();
      $result = $query->get_result()->fetch_assoc();

      if ($result){
        return new Usuario($result["id"], $result["nombre"], $result["apellido"], $result["email"], $result["contrasena"]);
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

      $query = $con->prepare("INSERT INTO usuarios (nombre, apellido, email, contrasena) VALUES (?,?,?,?)");
      $nombre = $usuario->getNombre();
      $apellido = $usuario->getApellido();
      $email = $usuario->getEmail();
      $pass = $usuario->getContrasena();

      $query->bind_param('ssss', $nombre, $apellido, $email, $pass);
      $query->execute();

      return true;

    }

    public function getIdByEmail($email){}

    public function getAllEmails(){}
  }
?>
