<?php
class QuoteOption {
	// database connection and table name
	private $conn;

	// object properties (qo data first, related after)
	public $qo_id;
	public $qo_employee_id;
	public $qo_job_id;
	public $qo_description;
	public $qo_created_date;
	public $qo_end_date;
	public $qo_date_updated;

	public $job_site_id;
	public $job_employee_id;
	public $job_status_id;
	public $job_status_change;
	public $job_customer_ref_no;
	public $job_site_contact_id;
	public $job_description;
	public $job_closed;
	public $job_date_updated;

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
		$this->query  = "SELECT qo.id AS qo_id,
								qo.employee_id AS qo_employee_id,
								qo.job_id AS qo_job_id,
								qo.description AS qo_description,
								qo.created_date AS qo_created_date,
								qo.end_date AS qo_end_date,
								qo.date_updated AS qo_date_updated,
								j.site_id AS job_site_id,
								j.employee_id AS job_employee_id,
								j.status_id AS job_status_id,
								j.status_change AS job_status_change,
								j.customer_ref_no AS job_customer_ref_no,
								j.site_contact_id AS job_site_contact_id,
								j.description AS job_description,
								j.closed AS job_closed,
								j.date_updated AS job_date_updated,
								js.description AS job_status_description,
								CONCAT(u.last_name, ', ', u.first_name) AS quote_owned_by";
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
        $this->query .= " WHERE j.id = ".$id." AND qo.end_date IS NULL";
        return;
    }

    private function setQuoteOptionID($id) {
        $this->query .= " WHERE qo.id = ".$id;
        return;
    }

	private function buildRowArray($row) {
		$item = array(
			"qo_id"                  => $row['qo_id'],
			"qo_employee_id"         => $row['qo_employee_id'],
			"qo_job_id"              => $row['qo_job_id'],
			"qo_description"         => $row['qo_description'],
			"qo_created_date"        => $row['qo_created_date'],
			"qo_end_date"            => $row['qo_end_date'],
			"qo_date_updated"        => $row['qo_date_updated'],
			"job_site_id"            => $row['job_site_id'],
			"job_employee_id"        => $row['job_employee_id'],
			"job_status_id"          => $row['job_status_id'],
			"job_status_change"      => $row['job_status_change'],
			"job_customer_ref_no"    => $row['job_customer_ref_no'],
			"job_site_contact_id"    => $row['job_site_contact_id'],
			"job_description"        => $row['job_description'],
			"job_closed"             => $row['job_closed'],
			"job_date_updated"       => $row['job_date_updated'],
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
        $this->data["success"] = "Ok";
        $this->data["count"]   = $this->numRows;
        return json_encode($this->data);
    }

    public function getQuoteOptionByID($qo_id) {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setQuoteOptionID($qo_id);
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

	public function insertQuoteOption() {
		$this->initialiseJSON();
		$this->query = "INSERT INTO quote_option (
							employee_id,
							job_id,
							description,
							created_date,
							end_date
						) VALUES (
							:employee_id,
							:job_id,
							:description,
							now(),
							NULL
						)";
		$stmt  = $this->conn->prepare($this->query);
		$this->qo_description = htmlspecialchars(strip_tags($this->qo_description));
		$stmt->bindParam(':employee_id',     $this->qo_employee_id);
		$stmt->bindParam(':job_id',          $this->qo_job_id);
		$stmt->bindParam(':description',     $this->qo_description);
		if ($stmt->execute()) {
			$this->data["id"]      = $this->conn->lastInsertId();
			$this->data["success"] = "Ok";
			$this->data["count"]   = 1;
		}
		return json_encode($this->data);
	}

	public function disableQuoteOption($id) {
		$this->initialiseJSON();
		$this->query = "UPDATE quote_option SET
							end_date = now()
						WHERE id = :id";
		$stmt = $this->conn->prepare($this->query);
		$stmt->bindParam(':id', $id);
		if ($stmt->execute()) {
			$this->data["success"] = "Ok";
			$this->data["count"]   = $stmt->rowCount();
		}
		return json_encode($this->data);
	}

}
?>
