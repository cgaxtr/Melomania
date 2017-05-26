<?php

  class grupo{
    private $id;
    private $estilo;
    private $nombre;
    private $edad_min;
    private $edad_max;

    public function __construct($id, $estilo, $nombre, $edad_min, $edad_max){
      $this->id = $id;
      $this->estilo = $estilo;
      $this->nombre = $nombre;
      $this->edad_min = $edad_min;
      $this->edad_max = $edad_max;
    }

    public function getId(){
      return $this->id;
    }

    public function getEstilo(){
      return $this->estilo;
    }

    public function getNombre(){
      return $this->nombre;
    }

    public function getEdadMin(){
      return $this->edad_min;
    }

    public function getEdadMax(){
      return $this->edad_max;
    }
  }

 ?>
