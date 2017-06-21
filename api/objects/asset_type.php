<?php
class AssetType {
    // database connection and table name
    private $conn;
    private $table_name = "asset_type";

    // object properties
    public $id;
    public $daysToReview;
    public $type;

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
        $query = "UPDATE ".$this->table_name." SET days_to_review = :days_to_review, type = :type WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $this->type = htmlspecialchars(strip_tags($this->type));
        $stmt->bindParam(':days_to_review', $this->daysToReview);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':id', $this->id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function readOne() {
        $query = "SELECT id, days_to_review, type FROM ".$this->table_name." WHERE id = ? LIMIT 0,1";
        $stmt  = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row                = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->daysToReview = $row['days_to_review'];
        $this->type         = $row['type'];
    }

    function create() {
        $query = "INSERT INTO ".$this->table_name." SET days_to_review = :days_to_review, type = :type";
        $stmt  = $this->conn->prepare($query);
        $this->type = htmlspecialchars(strip_tags($this->type));
        $stmt->bindParam(':days_to_review', $this->daysToReview);
        $stmt->bindParam(':type', $this->type);

        if ($stmt->execute()) {
            return true;
        }
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
        return false;
    }

    function readAll() {
        $query = "SELECT id, days_to_review, type FROM ".$this->table_name." ORDER BY id DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
}
?>
