<?php

class Database {

    private $host = 'localhost';
    private $db = 'task_db';
    private $user = 'root';
    private $password = '';
    public $conn;



    public function connect(){
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }
}


?>