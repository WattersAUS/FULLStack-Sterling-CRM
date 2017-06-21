<?php
class QuoteOption {
	// database connection and table name
	private $conn;

	// object properties (qo data first, related after)
	public $quote_option_id;
	public $employee_id;
	public $date_updated;

	public $job_id;
	public $job_status;

	public $job_status_description;

    public $quote_owned_by;
	
	// returned in JSON
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
		$this->query  = "SELECT qo.id AS quote_option_id, qo.employee_id AS employee_id, qo.date_updated AS date_updated, j.id AS job_id, j.status_id AS job_status, js.description AS job_status_description, CONCAT(u.last_name, ', ', u.first_name) AS quote_owned_by";
		$this->query .= " FROM quote_option qo";
		$this->query .= " LEFT JOIN job j ON qo.job_id = j.id";
		$this->query .= " LEFT JOIN job_status js ON j.status_id = js.id";
		$this->query .= " LEFT JOIN employee e ON qo.employee_id = e.id";
		$this->query .= " LEFT JOIN user u ON e.user_id = u.id";
			return;
	}

    private function setSiteID($id) {
        $this->query .= " WHERE j.site_id = ".$id;
        return;
    }

    private function setJobID($id) {
        $this->query .= " WHERE j.id = ".$id;
        return;
    }

    private function setQuoteOptionID($id) {
        $this->query .= " WHERE qo.id = ".$id;
        return;
    }

	private function buildRowArray($row) {
		$item = array(
			"quote_option_id"        => $row['quote_option_id'],
			"employee_id"            => $row['employee_id'],
			"date_updated"           => $row['date_updated'],
			"job_id"                 => $row['job_id'],
			"job_status"             => $row['job_status'],
			"job_status_description" => $row['job_status_description'],
			"quote_owned_by"         => $row['quote_owned_by']
		);
		return($item);
	}

    public function getQuoteOptionsForSite($site_id) {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setSiteID($site_id);
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

    public function getQuoteOptionsForJob($job_id) {
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

    public function getQuoteOptionByID($quote_option_id) {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setQuoteOptionID($quote_option_id);
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

    public function getAllQuoteOptions() {
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
