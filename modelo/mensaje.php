<?php
  class Mensaje{
    private $id;
    private $usuOrigen;
    private $usuDestino;
    private $grupo;
    private $titulo;
    private $texto;
    private $leido;

    public function __construct($id, $usuOrigen, $usuDestino, $grupo, $titulo, $texto, $leido){
      $this->id = $id;
      $this->usuOrigen = $usuOrigen;
      $this->usuDestino = $usuDestino;
      $this->grupo = $grupo;
      $this->titulo = $titulo;
      $this->texto = $texto;
      $this->leido = $leido;
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

    public function getGrupo(){
      return $this->grupo;
    }

    public function getTitulo(){
      return $this->titulo;
    }

    public function getTexto(){
      return $this->texto;
    }

    public function getLeido(){
      return $this->leido;
    }
  }
 ?>
