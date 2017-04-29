<?php
  class Mensaje{
    private $id;
    private $idUsuOrigen;
    private $idUsuDestino;
    private $titulo;
    private $texto;

    public function __construct($id, $idOrigen, $idDestino, $titulo, $texto){
      $this->id = $id;
      $this->idUsuOrigen = $idOrigen;
      $this->idUsuDestino = $idDestino;
      $this->titulo = $titulo;
      $this->texto = $texto;
    }

    public function getId(){
      return $this->id;
    }

    public function getIdUsuarioOrigen(){
      return $this->idUsuOrigen;
    }

    public function getIdUsuarioDestino(){
      return $this->idUsuDestino;
    }

    public function getTitulo(){
      return $this->titulo;
    }

    public function getTexto(){
      return $this->texto;
    }

    //testing method
    public function toString(){
      return $this->id." ".$this->idUsuOrigen." ".$this->idUsuDestino." ".$this->titulo." ".$this->texto;
    }
  }
 ?>
