<?php
class QuoteWorkOption {
	// database connection and table name
	private $conn;

	// object properties (qo data first, related after)
	public $qwo_id;
	public $qwo_quote_option_id;
	public $qwo_work_option_id;
	public $qwo_description;
	public $qwo_quantity;
	public $qwo_pricing;
	public $qwo_date_updated;

	public $qo_id;
	public $qo_employee_id;
	public $qo_job_id;
	public $qo_date_updated;

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

	public $wo_id;
	public $wo_category_id;
	public $wo_code;
	public $wo_description;
	public $wo_default_pricing;

	public $category_id;
	public $category_code;
	public $category_description;

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
		$this->query  = "SELECT qwo.id AS qwo_id,
								qwo.quote_option_id AS qwo_quote_option_id,
								qwo.work_option_id AS qwo_work_option_id,
								qwo.description AS qwo_description,
								qwo.quantity AS qwo_quantity,
								qwo.pricing AS qwo_pricing,
								qwo.date_updated AS qwo_date_updated,
								qo.id AS qo_id,
								qo.employee_id AS qo_employee_id,
								qo.job_id AS qo_job_id,
								qo.date_updated AS qo_date_updated,
								j.id AS job_id,
								j.site_id AS job_site_id,
								j.employee_id AS job_employee_id,
								j.status_id AS job_status_id,
								j.status_change AS job_status_change,
								j.customer_ref_no AS job_customer_ref_no,
								j.site_contact_id AS job_site_contact_id,
								j.description AS job_description,
								j.closed AS job_closed,
								j.date_updated AS job_date_updated,
								wo.id AS wo_id,
								wo.category_id AS wo_category_id,
								wo.code AS wo_code,
								wo.description AS wo_description,
								wo.default_pricing AS default_pricing,
								c.id AS category_id,
								c.code AS category_code,
								c.description AS category_description";
		$this->query .= " FROM quote_work_option qwo";
		$this->query .= " LEFT JOIN quote_option qo ON qwo.quote_option_id = qo.id";
		$this->query .= " LEFT JOIN job j ON qo.job_id = j.id";
		$this->query .= " LEFT JOIN work_option wo ON qwo.work_option_id = wo.id";
		$this->query .= " LEFT JOIN category c ON wo.category_id = c.id";
		return;
	}

    private function setQuoteOptionID($quote_option_id) {
        $this->query .= " WHERE qwo.quote_option_id = ".$quote_option_id;
        return;
    }

    private function setQuoteWorkOptionID($quote_work_option_id) {
        $this->query .= " WHERE qwo.id = ".$quote_work_option_id;
        return;
    }

	private function buildRowArray($row) {
		$item = array(
			"qwo_id"               => $row['qwo_id'],
			"qwo_quote_option_id"  => $row['qwo_quote_option_id'],
			"qwo_work_option_id"   => $row['qwo_work_option_id'],
			"qwo_description"      => $row['qwo_description'],
			"qwo_quantity"         => $row['qwo_quantity'],
			"qwo_pricing"          => $row['qwo_pricing'],
			"qwo_date_updated"     => $row['qwo_date_updated'],
			"qo_id"                => $row['qo_id'],
			"qo_employee_id"       => $row['qo_employee_id'],
			"qo_job_id"            => $row['qo_job_id'],
			"qo_date_updated"      => $row['qo_date_updated'],
			"job_id"               => $row['job_id'],
			"job_site_id"          => $row['job_site_id'],
			"job_employee_id"      => $row['job_employee_id'],
			"job_status_id"        => $row['job_status_id'],
			"job_status_change"    => $row['job_status_change'],
			"job_customer_ref_no"  => $row['job_customer_ref_no'],
			"job_site_contact_id"  => $row['job_site_contact_id'],
			"job_description"      => $row['job_description'],
			"job_closed"           => $row['job_closed'],
			"job_date_updated"     => $row['job_date_updated'],
			"wo_id"                => $row['wo_id'],
			"wo_category_id"       => $row['wo_category_id'],
			"wo_code"              => $row['wo_code'],
			"wo_description"       => $row['wo_description'],
			"wo_default_pricing"   => $row['wo_default_pricing'],
			"category_id"          => $row['category_id'],
			"category_code"        => $row['category_code'],
			"category_description" => $row['category_description']
		);
		return($item);
	}

    public function getQuoteWorkOptionsForQuoteOption($quote_option_id) {
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
        $this->data["success"] = "Ok";
        $this->data["count"]   = $this->numRows;
        return json_encode($this->data);
    }

    public function getQuoteWorkOptionByID($quote_work_option_id) {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setQuoteWorkOptionID($quote_work_option_id);
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

    public function getAllQuoteWorkOptions() {
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

	public function insertQuoteWorkOption() {
		$this->initialiseJSON();
		$this->query = "INSERT INTO quote_work_option (
							quote_option_id,
							work_option_id,
							description,
							quantity,
							pricing
						) VALUES (
							:quote_option_id,
							:work_option_id,
							:description,
							:quantity,
							:pricing
						)";
		$stmt  = $this->conn->prepare($this->query);
		$this->qwo_description = htmlspecialchars(strip_tags($this->qwo_description));
		$stmt->bindParam(':quote_option_id', $this->qwo_quote_option_id);
		$stmt->bindParam(':work_option_id',  $this->qwo_work_option_id);
		$stmt->bindParam(':description',     $this->qwo_description);
		$stmt->bindParam(':quantity',        $this->qwo_quantity);
		$stmt->bindParam(':pricing',         $this->qwo_pricing);
		if ($stmt->execute()) {
			$this->data["id"]      = $this->conn->lastInsertId();
			$this->data["success"] = "Ok";
			$this->data["count"]   = 1;
		}
		return json_encode($this->data);
	}

}
?>
