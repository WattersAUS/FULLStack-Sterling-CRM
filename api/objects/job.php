<?php
class Job {
    // database connection and table name
    private $conn;

    // object properties (job data first, related after)
    public $job_id;
    public $site_id;
    public $employee_id;
    public $status_id;
    public $customer_ref_no;
    public $site_contact_id;
    public $job_description;
    public $closed;
    public $date_updated;

    public $site_name;
    public $customer_id;
    public $customer_name;
    public $employee_first_name;
    public $employee_last_name;
    public $job_status_description;

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
        $this->query  = "SELECT j.id AS job_id, j.site_id, j.employee_id, j.status_id, COALESCE(j.customer_ref_no, '') AS customer_ref_no, j.site_contact_id AS site_contact_id, COALESCE(j.description, '') as job_description, j.closed, j.date_updated, s.name AS site_name, c.id AS customer_id, c.name AS customer_name, u.last_name AS employee_last_name, u.first_name AS employee_first_name, js.description AS job_status_description";
        $this->query .= " FROM job j";
        $this->query .= " LEFT JOIN site s ON j.site_id = s.id";
        $this->query .= " LEFT JOIN customer c ON s.customer_id = c.id";
        $this->query .= " LEFT JOIN employee e ON j.employee_id = e.id";
        $this->query .= " LEFT JOIN user u ON e.user_id = u.id";
        $this->query .= " LEFT JOIN job_status js ON j.status_id = js.id";
        return;
    }

    private function setCustomerID($id) {
        $this->query .= " WHERE c.id = ".$id;
        return;
    }

    private function setJobID($id) {
        $this->query .= " WHERE j.id = ".$id;
        return;
    }

    private function buildRowArray($row) {
        $item = array(
            "job_id"                 => $row['job_id'],
            "site_id"                => $row['site_id'],
            "employee_id"            => $row['employee_id'],
            "status_id"              => $row['status_id'],
            "customer_ref_no"        => $row['customer_ref_no'],
            "site_contact_id"        => $row['site_contact_id'],
            "job_description"        => $row['job_description'],
            "closed"                 => $row['closed'],
            "date_updated"           => $row['date_updated'],
            "site_name"              => $row['site_name'],
            "customer_id"            => $row['customer_id'],
            "customer_name"          => $row['customer_name'],
            "employee_first_name"    => $row['employee_first_name'],
            "employee_last_name"     => $row['employee_last_name'],
            "job_status_description" => $row['job_status_description']
        );
        return($item);
    }

    public function getJobsForCustomer($customer_id) {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setCustomerID($customer_id);
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

    public function getJobByID($job_id) {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setJobID($job_id);
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

    public function getAllJobs() {
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

    public function insertJob() {
        $this->initialiseJSON();
        $query = "INSERT INTO job (site_id, employee_id, status_id, customer_ref_no, site_contact_id, description, closed) VALUES (:site_id, :employee_id, :status_id, :customer_ref_no, :site_contact_id, :description, :closed)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':site_id',         $this->site_id);
        $stmt->bindParam(':employee_id',     $this->employee_id);
        $stmt->bindParam(':status_id',       $this->status_id);
        $stmt->bindParam(':customer_ref_no', $this->customer_ref_no);
        $stmt->bindParam(':site_contact_id', $this->site_contact_id);
        $stmt->bindParam(':description',     htmlspecialchars(strip_tags($this->job_description)));
        $stmt->bindParam(':closed',          $this->closed);
        if ($stmt->execute()) {
            $this->data["id"]      = $this->conn->lastInsertId();
            $this->data["success"] = "Ok";
            $this->data["count"]   = 1;
        }
        return json_encode($this->data);
    }

}
?>
