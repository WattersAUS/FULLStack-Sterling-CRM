<?php

class JobStatus {
    // database connection and table name
    private $conn;
    private $table_name = "job_status";

    // object properties
    public $id;
    public $description;
    public $template_page;

    public $query;
    public $numrows;
    public $data;

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
        $query = "UPDATE ".$this->table_name." SET description = :description, template_page = :template_page WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $this->description = htmlspecialchars(strip_tags($this->description));
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id',          $this->id);
        $stmt->bindParam(':template_page', $this->template_page);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function readOne(){
        $query = "SELECT id, description, template_page FROM ".$this->table_name." WHERE id = ? LIMIT 0,1";
        $stmt  = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row         = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->description   = $row['description'];
        $this->template_page = $row['template_page'];
    }

    function create(){
        $query = "INSERT INTO ".$this->table_name." SET description=:description";
        $stmt  = $this->conn->prepare($query);

        $this->description = htmlspecialchars(strip_tags($this->description));
        $stmt->bindParam(':description',   $this->description);
        $stmt->bindParam(':template_page', $this->template_page);

        if ($stmt->execute()) {
            return true;
        }
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
        return false;
    }

    function readAll(){
        $query = "SELECT id, description, template_page FROM ".$this->table_name." ORDER BY id DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }

// new and improved below here! returns JSON back to caller directly.

	private function initialiseJSON() {
        $this->data            = array();
        $this->data["records"] = array();
        $this->data["count"]   = 0;
        $this->data["success"] = "Fail";
        return;
    }

    private function setDefaultQuery() {
        $this->query  = "SELECT js.id AS job_status_id, js.description AS job_status_description, js.template_page AS template_page";
        $this->query .= " FROM job_status js";
        return;
    }

    private function buildRowArray($row) {
        $item = array(
            "job_status_id"             => $row['job_status_id'],
            "job_status_description"    => $row['job_status_description'],
            "job_status_template_page"  => $row['template_page']
        );
        return($item);
    }

    public function getAllStatuses() {
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
}
?>
