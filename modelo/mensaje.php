<?php
  class Mensaje{
    private $id;
    private $usuOrigen;
    private $usuDestino;
    private $titulo;
    private $texto;

    public function __construct($id, $usuOrigen, $usuDestino, $titulo, $texto){
      $this->id = $id;
      $this->usuOrigen = $usuOrigen;
      $this->usuDestino = $usuDestino;
      $this->titulo = $titulo;
      $this->texto = $texto;
    }

    public function getId(){
      return $this->id;
    }

    public function getUsuarioOrigen(){
      return $this->usuOrigen;
    }

    public function getUsuarioDestino(){
      return $this->usuDestino;
    }

    public function getTitulo(){
      return $this->titulo;
    }

    public function getTexto(){
      return $this->texto;
    }
  }
 ?>
