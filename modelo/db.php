<?php
  require_once("configDB.php");

  class DB{
    private static $instance;
    private $connection;

    private function __construct(){
      $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

		  if(mysqli_connect_error()) {
		     trigger_error("Failed to conenc to to MySQL: " . mysql_connect_error(), E_USER_ERROR);
		  }
    }

    public static function getInstance(){
      if(!self::$instance){
        self::$instance = new self();
      }

      return self::$instance;
    }

    public function getConnection(){
      return $this->connection;
    }

    public function __clone(){
      trigger_error("This method is not allowed");
    }

    public function __wakeup(){
      trigger_error("This method is not allowed");
    }

    public function __destruct() {
        if ( isset($this->connection) ) {
            $this->connection = null;
        }
    }
  }
 ?>
