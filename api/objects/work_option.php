<?php

class WorkOption {
    // database connection and table name
    private $conn;
    private $table_name = "work_option";

    // object properties
    public $id;
    public $category_id;
    public $code;
    public $description;
    public $default_pricing;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function delete() {
        $query    = "DELETE FROM ".$this->table_name." WHERE id = ?";
        $stmt     = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function update() {
        $query = "UPDATE ".$this->table_name." SET category_id = :category_id, code = :code, description = :description, default_pricing = :default_pricing WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $this->code        = htmlspecialchars(strip_tags($this->code));
        $this->description = htmlspecialchars(strip_tags($this->description));

        $stmt->bindParam(':category_id',     $this->category_id);
        $stmt->bindParam(':code',            $this->code);
        $stmt->bindParam(':description',     $this->description);
        $stmt->bindParam(':default_pricing', $this->default_pricing);
        $stmt->bindParam(':id',              $this->id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function readOne() {
        $query = "SELECT id, category_id, code, description, default_pricing FROM ".$this->table_name." WHERE id = ? LIMIT 0,1";
        $stmt  = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row                   = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->category_id     = $row['category_id'];
        $this->code            = $row['code'];
        $this->description     = $row['description'];
        $this->default_pricing = $row['default_pricing'];
    }

    function create() {
        $query = "INSERT INTO ".$this->table_name."  SET category_id = :category_id, code = :code, description = :description, default_pricing = :default_pricing ";
        $stmt  = $this->conn->prepare($query);
        $this->code        = htmlspecialchars(strip_tags($this->code));
        $this->description = htmlspecialchars(strip_tags($this->description));

        $stmt->bindParam(':category_id',     $this->category_id);
        $stmt->bindParam(':code',            $this->code);
        $stmt->bindParam(':description',     $this->description);
        $stmt->bindParam(':default_pricing', $this->default_pricing);
        if ($stmt->execute()) {
            return true;
        }
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
        return false;
    }

    function readAll() {
        $query = "SELECT id, category_id, code, description, default_pricing FROM ".$this->table_name." ORDER BY id DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
}
?>
