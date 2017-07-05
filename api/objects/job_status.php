<?php

class JobStatus {
    // database connection and table name
    private $conn;

    // object properties
    public $job_status_id;
    public $job_status_description;
    public $job_status_template_page;
    public $job_status_manual_action;
    public $job_status_step_text;

    public $query;
    public $numrows;
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
        $this->query  = "SELECT js.id AS job_status_id, js.description AS job_status_description, js.template_page AS job_status_template_page, js.manual_action AS job_status_manual_action";
        $this->query .= " FROM job_status js";
        return;
    }

    private function setManualAction() {
        $this->query .= " WHERE js.manual_action = TRUE";
        return;
    }

    private function setJobStatusID($id) {
        $this->query .= " WHERE js.id = ".$id;
        return;
    }

    private function buildRowArray($row) {
        $item = array(
            "job_status_id"             => $row['job_status_id'],
            "job_status_description"    => $row['job_status_description'],
            "job_status_template_page"  => $row['job_status_template_page'],
            "job_status_manual_action"  => $row['job_status_manual_action']
        );
        if ($item["job_status_manual_action"] == 0) {
            $item["job_status_step_text"] = "Auto";
        } else {
            $item["job_status_step_text"] = "Manual";
        }
        return($item);
    }

    public function getJobStatusByID($id) {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setJobStatusID($id);
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

    public function getAllJobStatuses() {
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

    public function getManualJobStatuses() {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setManualAction();
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

    public function insertJobStatus() {
        $this->initialiseJSON();
        $query  = "INSERT INTO job_status (description, template_page, manual_action) VALUES (:description, :template_page, :manual_action)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':description',   htmlspecialchars(strip_tags($this->job_status_description)));
        $stmt->bindParam(':template_page', htmlspecialchars(strip_tags($this->job_status_template_page)));
        $stmt->bindParam(':manual_action', $this->job_status_manual_action);
        if ($stmt->execute()) {
            $this->data["id"]      = $this->conn->lastInsertId();
            $this->data["success"] = "Ok";
            $this->data["count"]   = $stmt->rowCount();
        }
        return json_encode($this->data);
    }

    public function updateJobStatus() {
        $this->initialiseJSON();
        $query = "UPDATE job_status SET description = :description, template_page = :template_page, manual_action = :manual_action WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':description',   htmlspecialchars(strip_tags($this->job_status_description)));
        $stmt->bindParam(':template_page', htmlspecialchars(strip_tags($this->job_status_template_page)));
        $stmt->bindParam(':manual_action', $this->job_status_manual_action);
        $stmt->bindParam(':id',            $this->job_status_id);
        if ($stmt->execute()) {
            $this->data["success"] = "Ok";
            $this->data["count"]   = $stmt->rowCount();
        }
        return json_encode($this->data);
    }

    public function deleteJobStatus() {
        $this->initialiseJSON();
        $this->query = "DELETE FROM job_status WHERE id = :id";
        $stmt  = $this->conn->prepare($this->query);
        $stmt->bindParam(':id', $this->job_status_id);
        if ($stmt->execute()) {
            $this->data["id"]      = $this->job_status_id;
            $this->data["success"] = "Ok";
            $this->data["count"]   = $stmt->rowCount();
        }
        return json_encode($this->data);
    }

}
?>
