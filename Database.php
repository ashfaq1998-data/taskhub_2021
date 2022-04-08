<?php

class Database {
  public $con;

  public function __construct() {
    $host = "localhost:3306";
    $dbname = "taskhub_new";
    $username = "root";
    $password = "";

    try {
      $this->con = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $username, $password);
      $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Connection Error: " . $e->getMessage();
    }
  }

  public function __destruct()
  {
          
  }
  
}