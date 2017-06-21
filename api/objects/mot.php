<?php

class Term {
    // database connection and table name
    private $conn;
    private $table_name = "mot";

    // object properties
  	public $id;
    public $asset_id;
    public $due_date;
    public $notes;
    public $booked_date;
    public $booked_garage;
    public $cost;

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
        $query = "UPDATE ".$this->table_name." SET asset_id = :asset_id due_date = :due_date, notes = :notes booked_date = :booked_date booked_garage = :booked_garage cost = :cost WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $this->notes = htmlspecialchars(strip_tags($this->notes));
        $stmt->bindParam(':cost', $this->cost);
        $stmt->bindParam(':booked_garage', $this->booked_garage);
        $stmt->bindParam(':booked_date', $this->booked_date);
        $stmt->bindParam(':notes', $this->notes);
        $stmt->bindParam(':due_date', $this->due_date);
        $stmt->bindParam(':asset_id', $this->asset_id);
        $stmt->bindParam(':id', $this->id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function readOne() {
        $query = "SELECT id, asset_id, due_date, notes, booked_date, booked_garage, cost FROM ".$this->table_name." WHERE id = ? LIMIT 0,1";
        $stmt  = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->asset_id = $row['asset_id'];
        $this->due_date = $row['due_date'];
        $this->notes = $row['notes'];
        $this->booked_date = $row['booked_date'];
        $this->booked_garage = $row['booked_garage'];
        $this->cost = $row['cost'];
    }

    function create() {
        $query = "INSERT INTO ".$this->table_name." SET asset_id = :asset_id, due_date = :due_date, notes = :notes, booked_date = :booked_date, booked_garage = :booked_garage, cost = :cost";
        $stmt  = $this->conn->prepare($query);

        $this->notes = htmlspecialchars(strip_tags($this->notes));
        $stmt->bindParam(':asset_id', $this->asset_id);
        $stmt->bindParam(':due_date', $this->due_date);
        $stmt->bindParam(':notes', $this->notes);
        $stmt->bindParam(':booked_date', $this->booked_date);
        $stmt->bindParam(':booked_garage', $this->booked_garage);
        $stmt->bindParam(':cost', $this->cost);

        if ($stmt->execute()) {
            return true;
        }
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
        return false;
    }

    function readAll() {
        $query = "SELECT id, asset_id, due_date, notes, booked_date, booked_garage, cost FROM ".$this->table_name." ORDER BY id DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
}
?>
