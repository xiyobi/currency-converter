<?php

class DB{

    public $host = "localhost";
    public $user = "root";
    public $pass = "1234";
    public $db_name = "bot";
    public $conn;
    public function __construct(){
        $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->user, $this->pass);

    }

}