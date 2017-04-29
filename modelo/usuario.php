<?php
  class Usuario{
      private $id;
      private $nombre;
      private $apellido;
      private $email;
      private $pass;

      public function __construct($id, $nombre, $apellido, $email, $pass){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->pass = $pass;
      }

      public function getID(){
        return $this->id;
      }

      public function getNombre(){
        return $this->nombre;
      }

      public function getApellido(){
        return $this->apellido;
      }

      public function getEmail() {
        return $this->email;
      }

      public function getContrasena(){
        return $this->pass;
      }

      //testing method
      public function toString(){
        return $this->id." ".$this->nombre." ".$this->apellido." ".$this->email." ".$this->pass;
      }
  }
 ?>
