<?php
class JobHistory {
    // database connection and table name
    private $conn;

    // object properties (job data first, related after)
    public $job_history_id;
    public $job_history_job_id;
    public $job_history_site_id;
    public $job_history_employee_id;
    public $job_history_status_id;
    public $job_history_status_change;
    public $job_history_customer_ref_no;
    public $job_history_site_contact_id;
    public $job_history_job_description;
    public $job_history_closed;
    public $job_history_date_updated;

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
        $this->query  = "SELECT jh.id AS job_history_id,
                                jh.job_id AS job_history_job_id,
                                jh.site_id AS job_history_site_id,
                                jh.employee_id AS job_history_employee_id,
                                jh.status_id AS job_history_status_id,
                                jh.status_change AS job_history_status_change,
                                COALESCE(jh.customer_ref_no, '') AS job_history_customer_ref_no,
                                jh.site_contact_id AS job_history_site_contact_id,
                                COALESCE(jh.description, '') AS job_history_description,
                                jh.closed AS job_history_closed,
                                jh.date_updated AS job_history_date_updated,
                                s.name AS site_name,
                                c.id AS customer_id,
                                c.name AS customer_name,
                                u.last_name AS employee_last_name,
                                u.first_name AS employee_first_name,
                                js.description AS job_status_description";
        $this->query .= " FROM job_history jh";
        $this->query .= " LEFT JOIN site s ON jh.site_id = s.id";
        $this->query .= " LEFT JOIN customer c ON s.customer_id = c.id";
        $this->query .= " LEFT JOIN employee e ON jh.employee_id = e.id";
        $this->query .= " LEFT JOIN user u ON e.user_id = u.id";
        $this->query .= " LEFT JOIN job_status js ON jh.status_id = js.id";
        return;
    }

    private function setJobID($id) {
        $this->query .= " WHERE jh.job_id = ".$id;
        return;
    }

    private function setJobHistoryFirstRecordForJobID($id) {
        $this->query .= " WHERE jh.id = (SELECT MIN(jh1.id) FROM job_history jh1 WHERE jh1.job_id = ".$id.")";
        return;
    }

    private function setJobHistoryID($id) {
        $this->query .= " WHERE jh.id = ".$id;
        return;
    }

    private function setDataOrderByID() {
        $this->query .= " ORDER BY jh.id DESC";
    }

    private function buildRowArray($row) {
        $item = array(
            "job_history_id"              => $row['job_history_id'],
            "job_history_job_id"          => $row['job_history_job_id'],
            "job_history_site_id"         => $row['job_history_site_id'],
            "job_history_employee_id"     => $row['job_history_employee_id'],
            "job_history_status_id"       => $row['job_history_status_id'],
            "job_history_status_change"   => $row['job_history_status_change'],
            "job_history_customer_ref_no" => $row['job_history_customer_ref_no'],
            "job_history_site_contact_id" => $row['job_history_site_contact_id'],
            "job_history_description"     => $row['job_history_description'],
            "job_history_closed"          => $row['job_history_closed'],
            "job_history_date_updated"    => $row['job_history_date_updated'],
            "site_name"                   => $row['site_name'],
            "customer_id"                 => $row['customer_id'],
            "customer_name"               => $row['customer_name'],
            "employee_first_name"         => $row['employee_first_name'],
            "employee_last_name"          => $row['employee_last_name'],
            "job_status_description"      => $row['job_status_description']
        );
        return($item);
    }

    public function getJobHistoryForJob($job_id) {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setJobID($job_id);
        $this->setDataOrderByID();
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

    public function getJobHistoryForJobFirstRecord($job_id) {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setJobHistoryFirstRecordForJobID($job_id);
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

    public function getJobHistoryByID($job_history_id) {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setJobHistoryID($job_history_id);
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
