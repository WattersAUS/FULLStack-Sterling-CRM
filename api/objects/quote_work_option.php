<?php
class QuoteWorkOption {
	// database connection and table name
	private $conn;

	// object properties (qo data first, related after)
	public $quote_work_option_id;
	public $work_option_id;
	public $pricing;
	public $date_updated;
	
	public $work_option_code;
	public $default_pricing;
	
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
		$this->query  = "SELECT qwo.id AS quote_work_option_id, qwo.work_option_id AS work_option_id, qwo.description AS description, qwo.pricing AS pricing, qwo.date_updated AS date_updated, wo.code AS work_option_code, wo.default_pricing AS default_pricing";
		$this->query .= " FROM quote_work_option qwo";
		$this->query .= " LEFT JOIN work_option wo ON qwo.work_option_id = wo.id";
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
			"quote_work_option_id"=> $row['quote_work_option_id'],
			"work_option_id"      => $row['work_option_id'],
			"pricing"             => $row['pricing'],
			"date_updated"        => $row['date_updated'],
			"work_option_code"    => $row['work_option_code'],
			"default_pricing"     => $row['default_pricing']
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
        if ($this->numRows > 0) {
            $this->data["success"] = "Ok";
            $this->data["count"]   = $this->numRows;
        }
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
}
?>
