<?php
  class Usuario{
      private $id;
      private $nombre;
      private $apellido;
      private $email;
      private $pass;
      private $type;
      private $fecha;
      private $estilos;

      public function __construct($id, $nombre, $apellido, $email, $pass, $type, $fecha, $estilos){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->pass = $pass;
        $this->type = $type;
        $this->fecha = $fecha;
        $this->estilos = $estilos;
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

      public function getTypeUser(){
        return $this->type;
      }

      public function getFecha(){
        return $this->fecha;
      }

      public function getEstilos(){
        return $this->estilos;
      }
  }
 ?>
