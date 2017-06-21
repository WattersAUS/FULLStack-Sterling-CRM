<?php

class Team {
    // database connection and table name
    private $conn;
    private $table_name = "team";

    // object properties
    public $id;
    public $description;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function delete () {
        $query    = "DELETE FROM ".$this->table_name." WHERE id = ?";
        $stmt     = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function update(){
        $query = "UPDATE ".$this->table_name." SET description = :description WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $this->description = htmlspecialchars(strip_tags($this->description));
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $this->id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function readOne(){
        $query = "SELECT id, description FROM ".$this->table_name." WHERE id = ? LIMIT 0,1";
        $stmt  = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row         = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->description = $row['description'];
    }

    function create(){
        $query = "INSERT INTO ".$this->table_name." SET description=:description";
        $stmt  = $this->conn->prepare($query);

        $this->description = htmlspecialchars(strip_tags($this->description));
        $stmt->bindParam(':description', $this->description);

        if ($stmt->execute()) {
            return true;
        }
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
        return false;
    }

    function readAll(){
        $query = "SELECT id, description FROM ".$this->table_name." ORDER BY id DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
}
?>
