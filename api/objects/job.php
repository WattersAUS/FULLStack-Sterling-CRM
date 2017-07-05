<?php
class Job {
    // database connection and table name
    private $conn;

    // object properties (job data first, related after)
    public $job_id;
    public $job_site_id;
    public $job_employee_id;
    public $job_status_id;
    public $job_status_change;
    public $job_customer_ref_no;
    public $job_site_contact_id;
    public $job_description;
    public $job_closed;
    public $job_date_updated;

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
        $this->query  = "SELECT j.id AS job_id,
                                j.site_id AS job_site_id,
                                j.employee_id AS job_employee_id,
                                j.status_id AS job_status_id,
                                j.status_change AS job_status_change,
                                COALESCE(j.customer_ref_no, '') AS job_customer_ref_no,
                                j.site_contact_id AS job_site_contact_id,
                                COALESCE(j.description, '') AS job_description,
                                j.closed AS job_closed,
                                j.date_updated AS job_date_updated,
                                s.name AS site_name,
                                c.id AS customer_id,
                                c.name AS customer_name,
                                u.last_name AS employee_last_name,
                                u.first_name AS employee_first_name,
                                js.description AS job_status_description";
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
            "job_site_id"            => $row['job_site_id'],
            "job_employee_id"        => $row['job_employee_id'],
            "job_status_id"          => $row['job_status_id'],
            "job_status_change"      => $row['job_status_change'],
            "job_customer_ref_no"    => $row['job_customer_ref_no'],
            "job_site_contact_id"    => $row['job_site_contact_id'],
            "job_description"        => $row['job_description'],
            "job_closed"             => $row['job_closed'],
            "job_date_updated"       => $row['job_date_updated'],
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
        $this->query = "INSERT INTO job (
                            site_id,
                            employee_id,
                            status_id,
                            status_change,
                            customer_ref_no,
                            site_contact_id,
                            description,
                            closed
                        ) VALUES (
                            :site_id,
                            :employee_id,
                            :status_id,
                            :status_change,
                            :customer_ref_no,
                            :site_contact_id,
                            :description,
                            :closed
                        )";
        $stmt  = $this->conn->prepare($this->query);
        $stmt->bindParam(':site_id',         $this->job_site_id);
        $stmt->bindParam(':employee_id',     $this->job_employee_id);
        $stmt->bindParam(':status_id',       $this->job_status_id);
        $stmt->bindParam(':status_change',   $this->job_status_change);
        $stmt->bindParam(':customer_ref_no', $this->job_customer_ref_no);
        $stmt->bindParam(':site_contact_id', $this->job_site_contact_id);
        $stmt->bindParam(':description',     htmlspecialchars(strip_tags($this->job_description)));
        $stmt->bindParam(':closed',          $this->job_closed);
        if ($stmt->execute()) {
            $this->data["id"]      = $this->conn->lastInsertId();
            $this->data["success"] = "Ok";
            $this->data["count"]   = 1;
        }
        return json_encode($this->data);
    }

    public function updateJob() {
        $this->initialiseJSON();
        $this->query = "UPDATE job SET
                            site_id          = :site_id,
                            employee_id      = :employee_id,
                            status_id        = :status_id,
                            status_change    = :status_change,
                            customer_ref_no  = :customer_ref_no,
                            site_contact_id  = :site_contact_id,
                            description      = :description,
                            closed           = :closed
                        WHERE id = :id";
        $stmt  = $this->conn->prepare($this->query);
        $stmt->bindParam(':site_id',         $this->job_site_id);
        $stmt->bindParam(':employee_id',     $this->job_employee_id);
        $stmt->bindParam(':status_id',       $this->job_status_id);
        $stmt->bindParam(':status_change',   $this->job_status_change);
        $stmt->bindParam(':customer_ref_no', $this->job_customer_ref_no);
        $stmt->bindParam(':site_contact_id', $this->job_site_contact_id);
        $stmt->bindParam(':description',     htmlspecialchars(strip_tags($this->job_description)));
        $stmt->bindParam(':closed',          $this->job_closed);
        $stmt->bindParam(':id',              $this->job_id);
        if ($stmt->execute()) {
            $this->data["success"] = "Ok";
            $this->data["count"]   =  $stmt->rowCount();
        }
        return json_encode($this->data);
    }

}
?>
