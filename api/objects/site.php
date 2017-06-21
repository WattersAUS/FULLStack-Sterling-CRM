<?php
class Site {
    // database connection and table name
    private $conn;
    private $table_name = "site";

    // object properties
	public $customerName;

    public $id;
    public $customerId;
    public $name;
    public $address1;
    public $address2;
    public $city;
    public $county;
    public $postcode;

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

    function update() {
        $query = "UPDATE ".$this->table_name." SET
						             name = :name,
							    shortname = :shortName,
						 		 address1 = :address1,
							     address2 = :address2,
							         city = :city,
							       county = :county,
							     postcode = :postcode
								 WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $this->name                   = htmlspecialchars(strip_tags($this->name));
        $this->shortName              = htmlspecialchars(strip_tags($this->shortName));
		$this->companyRegNo           = htmlspecialchars(strip_tags($this->companyRegNo));
		$this->address1               = htmlspecialchars(strip_tags($this->address1));
		$this->address2               = htmlspecialchars(strip_tags($this->address2));
		$this->city                   = htmlspecialchars(strip_tags($this->city));
		$this->county                 = htmlspecialchars(strip_tags($this->county));
		$this->postcode               = htmlspecialchars(strip_tags($this->postcode));
        $stmt->bindParam(':name',      $this->name);
        $stmt->bindParam(':shortName', $this->shortName);
        $stmt->bindParam(':address1',  $this->address1);
        $stmt->bindParam(':address2',  $this->address2);
        $stmt->bindParam(':city',      $this->city);
        $stmt->bindParam(':county',    $this->county);
        $stmt->bindParam(':postcode',  $this->postcode);
        $stmt->bindParam(':id',        $this->id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function readOne() {
        $query = "SELECT id,
						customer_id,
						name,
						shortname,
						address1,
						address2,
						city,
						county,
						postcode
						FROM ".$this->table_name." WHERE id = ? LIMIT 0,1";
        $stmt  = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row              = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->customerId = $row['customer_id'];
        $this->name       = $row['name'];
        $this->shortName  = $row['shortname'];
        $this->address1   = $row['address1'];
        $this->address2   = $row['address2'];
        $this->city       = $row['city'];
        $this->county     = $row['county'];
        $this->postcode   = $row['postcode'];
    }

    function create() {
        $query = "INSERT INTO ".$this->table_name." SET
							  customer_id = :customerId,
							         name = :name,
							    shortname = :shortName,
						 		 address1 = :address1,
							     address2 = :address2,
							         city = :city,
							       county = :county,
								 postcode = :postcode";
        $stmt  = $this->conn->prepare($query);
        $this->name                   = htmlspecialchars(strip_tags($this->name));
        $this->shortName              = htmlspecialchars(strip_tags($this->shortName));
		$this->address1               = htmlspecialchars(strip_tags($this->address1));
		$this->address2               = htmlspecialchars(strip_tags($this->address2));
		$this->city                   = htmlspecialchars(strip_tags($this->city));
		$this->county                 = htmlspecialchars(strip_tags($this->county));
		$this->postcode               = htmlspecialchars(strip_tags($this->postcode));
        $stmt->bindParam(':customerId', $this->customerId);
        $stmt->bindParam(':name',       $this->name);
        $stmt->bindParam(':shortName',  $this->shortName);
        $stmt->bindParam(':address1',   $this->address1);
        $stmt->bindParam(':address2',   $this->address2);
        $stmt->bindParam(':city',       $this->city);
        $stmt->bindParam(':county',     $this->county);
		$stmt->bindParam(':postcode',   $this->postcode);
        if ($stmt->execute()) {
            return true;
        }
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
        return false;
    }

    function readAll() {
        $query = "SELECT s.id AS id,
					s.customer_id AS customer_id,
					s.name AS name,
					s.shortname AS shortname,
					s.address1 AS address1,
					s.address2 AS address2,
					s.city AS city,
					s.county AS county,
					s.postcode AS postcode,
					c.name AS customer_name
				FROM ".$this->table_name." s LEFT JOIN customer c ON (s.customer_id = c.id) ORDER BY c.name, s.name DESC";
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
        $this->query  = "SELECT s.id AS site_id, s.name AS site_name, s.shortname AS site_shortname, s.postcode AS site_postcode";
        $this->query .= " FROM site s";
        $this->query .= " LEFT JOIN site_contact sc ON s.id = sc.site_id";
        return;
    }

    private function setCustomerID($customer_id) {
        $this->query .= " WHERE s.customer_id = ".$customer_id;
        return;
    }

    private function buildRowArray($row) {
        $item = array(
            "site_id"        => $row['site_id'],
            "site_name"      => $row['site_name'],
            "site_shortname" => $row['site_shortname'],
            "site_postcode"  => $row['site_postcode']
        );
        return($item);
    }

    public function getSitesForCustomer($customer_id) {
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

}
?>
