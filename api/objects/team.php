<?php
class Team {
    // database connection and table name
    private $conn;

    // object properties
    public $team_id;
    public $team_description;

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
        $this->query =  "SELECT t.id AS team_id,
                                t.description AS team_description
                            FROM team t";
    }

    private function setTeamID($team_id) {
        $this->query .= " WHERE t.id = ".$team_id;
        return;
    }

    private function buildRowArray($row) {
        $item = array(
            "team_id"          => $row['team_id'],
            "team_description" => $row['team_description']
        );
        return($item);
    }

    public function getTeamByID($team_id) {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setTeamID($team_id);
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

    public function getAllTeams() {
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

    public function insertTeam() {
        $this->initialiseJSON();
        $query = "INSERT INTO team (description) VALUES (:description)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':description', htmlspecialchars(strip_tags($this->team_description)));
        if ($stmt->execute()) {
            $this->data["id"]      = $this->conn->lastInsertId();
            $this->data["success"] = "Ok";
            $this->data["count"]   = 1;
        }
        return json_encode($this->data);
    }

    public function updateTeam() {
        $this->initialiseJSON();
        $query = "UPDATE team SET description = :description WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':description', htmlspecialchars(strip_tags($this->team_description)));
        $stmt->bindParam(':id',          $this->team_id);
        if ($stmt->execute()) {
            $this->data["success"] = "Ok";
            $this->data["count"]   = $stmt->rowCount();
        }
        return json_encode($this->data);
    }

    public function deleteTeam() {
        $this->initialiseJSON();
        $query = "DELETE FROM team WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->team_id);
        if ($stmt->execute()) {
            $this->data["id"]      = $this->team_id;
            $this->data["success"] = "Ok";
            $this->data["count"]   = $stmt->rowCount();
        }
        return json_encode($this->data);
    }

}

?>
