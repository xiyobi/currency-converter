<?php

class DB{
    public $host = "localhost";
    public $user = "root";
    public $pass = "1234";
    public $dbname = "bot";
    public $conn;
    public function __construct(){
        $this->conn = new PDO($this->host, $this->user, $this->pass, $this->dbname);

    }

}