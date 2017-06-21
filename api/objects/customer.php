<?php
class Customer {
    // database connection and table name
    private $conn;

    // object properties
	public $customerName;

    public $id;
    public $name;

    public $query;
    public $numrows;
    public $data;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function readAll() {
        $query = "SELECT id, name FROM customer ORDER BY name DESC";
		$stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }

    // new code
    private function initialiseJSON() {
        $this->data            = array();
        $this->data["records"] = array();
        $this->data["count"]   = 0;
        $this->data["success"] = "Fail";
        return;
    }

    private function setDefaultQuery() {
        $this->query  = "SELECT c.id AS customer_id, c.name AS customer_name";
        $this->query .= " FROM customer c";
        return;
    }

    private function buildRowArray($row) {
        $item = array(
            "customer_id"   => $row['customer_id'],
            "customer_name" => $row['customer_name']
        );
        return($item);
    }

    public function getAllCustomers() {
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
