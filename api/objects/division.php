<?php
class Division {
    // database connection and table name
    private $conn;

    // object properties (asset data first, related after)
    public $division_id;
    public $division_description;

    public $query;
    public $numRows;
    public $data;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    private function initialiseJSON() {
        $this->data            = array();
        $this->data["records"] = array();
        $this->data["count"]   = 0;
        $this->data["success"] = "Fail";
        return;
    }

    private function setDefaultQuery() {
        $this->query =  "SELECT d.id AS division_id,
                                d.description AS division_description
                            FROM division d";
    }

    private function setDivisionID($division_id) {
        $this->query .= " WHERE d.id = ".$division_id;
        return;
    }

    private function buildRowArray($row) {
        $item = array(
            "division_id"          => $row['division_id'],
            "division_description" => $row['division_description']
        );
        return($item);
    }

    public function getDivisionByID($division_id) {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setDivisionID($division_id);
        $stmt = $this->conn->prepare($this->query);
        $stmt->execute();
        $this->numRows = 0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->numRows += 1;
            array_push($this->data["records"], $this->buildRowArray($row));
        }
        if ($this->numRows > 0) {
            $this->data["success"] = "Ok";
            $this->data["count"]   = $this->numRows;
        }
        return json_encode($this->data);
    }

    public function getAllDivisions() {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $stmt = $this->conn->prepare($this->query);
        $stmt->execute();
        $this->numRows = 0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->numRows += 1;
            array_push($this->data["records"], $this->buildRowArray($row));
        }
        if ($this->numRows > 0) {
            $this->data["success"] = "Ok";
            $this->data["count"]   = $this->numRows;
        }
        return json_encode($this->data);
    }

    public function insertDivision() {
        $this->initialiseJSON();
        $query = "INSERT INTO division (description) VALUES (:description)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':description', htmlspecialchars(strip_tags($this->division_description)));
        if ($stmt->execute()) {
            $this->data["id"]      = $this->conn->lastInsertId();
            $this->data["success"] = "Ok";
            $this->data["count"]   = 1;
        }
        return json_encode($this->data);
    }

    public function updateDivision() {
        $this->initialiseJSON();
        $query = "UPDATE division SET description = :description WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':description', htmlspecialchars(strip_tags($this->division_description)));
        $stmt->bindParam(':id',          $this->division_id);
        if ($stmt->execute()) {
            $this->data["success"] = "Ok";
            $this->data["count"]   = $stmt->rowCount();
        }
        return json_encode($this->data);
    }

    public function deleteDivision() {
        $this->initialiseJSON();
        $query = "DELETE FROM division WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->division_id);
        if ($stmt->execute()) {
            $this->data["id"]      = $this->division_id;
            $this->data["success"] = "Ok";
            $this->data["count"]   = $stmt->rowCount();
        }
        return json_encode($this->data);
    }

}

?>
