<?php

class Task {
    private $conn;
    private $table = 'tasks';


    public function __construct($db){
        $this->conn = $db;
    }

    public function add($title, $description){
        $stmt = $this->conn->prepare("INSERT INTO $this->table (title, description) VALUES (? , ?)");
        $stmt->bind_param("ss", $title, $description);
        return $stmt->execute();
        
    }

    public function getAll() {
        $result = $this->conn->query("SELECT * FROM $this->table ORDER BY created_at DESC");
        return $result;
    }
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}