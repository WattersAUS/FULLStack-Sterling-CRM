<?php
class Site {
    // database connection and table name
    private $conn;

    // object properties
    public $site_id;
    public $site_customer_id;
    public $site_name;
    public $site_shortname;
    public $site_address1;
    public $site_address2;
    public $site_city;
    public $site_county;
    public $site_postcode;

    public $customer_id;
    public $customer_name;

    public $query;
    public $numRows;
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
        $this->query  = "SELECT s.id AS site_id,
                                s.customer_id AS site_customer_id,
                                s.name AS site_name,
                                s.shortname AS site_shortname,
                                s.address1 AS site_address1,
                                s.address2 AS site_address2,
                                s.city AS site_city,
                                s.county AS site_county,
                                s.postcode AS site_postcode,
                                c.id AS customer_id,
                                c.name as customer_name";
        $this->query .= " FROM site s";
        $this->query .= " LEFT JOIN customer c ON s.customer_id = c.id";
        return;
    }

    private function setSiteID($site_id) {
        $this->query .= " WHERE s.id = ".$site_id;
        return;
    }

    private function setCustomerID($customer_id) {
        $this->query .= " WHERE s.customer_id = ".$customer_id;
        return;
    }

    private function addSiteContactCheck() {
        $this->query .= " AND (SELECT COUNT(*) FROM site_contact WHERE site_id = s.id) > 0";
    }

    private function buildRowArray($row) {
        $item = array(
            "site_id"          => $row['site_id'],
            "site_customer_id" => $row['site_customer_id'],
            "site_name"        => $row['site_name'],
            "site_shortname"   => $row['site_shortname'],
            "site_address1"    => $row['site_address1'],
            "site_address2"    => $row['site_address2'],
            "site_city"        => $row['site_city'],
            "site_county"      => $row['site_county'],
            "site_postcode"    => $row['site_postcode'],
            "customer_id"      => $row['customer_id'],
            "customer_name"    => $row['customer_name']
        );
        return($item);
    }

    public function getSiteByID($site_id) {
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

    public function getAllSites() {
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

    public function getSitesForCustomer($customer_id) {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setCustomerID($customer_id);
        $this->addSiteContactCheck();
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

    public function insertSite() {
        $this->initialiseJSON();
        $this->query = "INSERT INTO site SET
                              customer_id = :customer_id,
                                     name = :name,
                                shortname = :shortname,
                                 address1 = :address1,
                                 address2 = :address2,
                                     city = :city,
                                   county = :county,
                                 postcode = :postcode";
        $stmt                 = $this->conn->prepare($this->query);
        $this->site_name      = htmlspecialchars(strip_tags($this->site_name));
        $this->site_shortname = htmlspecialchars(strip_tags($this->site_shortname));
        $this->site_address1  = htmlspecialchars(strip_tags($this->site_address1));
        $this->site_address2  = htmlspecialchars(strip_tags($this->site_address2));
        $this->site_city      = htmlspecialchars(strip_tags($this->site_city));
        $this->site_county    = htmlspecialchars(strip_tags($this->site_county));
        $this->site_postcode  = htmlspecialchars(strip_tags($this->site_postcode));
        $stmt->bindParam(':customer_id', $this->site_customer_id);
        $stmt->bindParam(':name',        $this->site_name);
        $stmt->bindParam(':shortname',   $this->site_shortname);
        $stmt->bindParam(':address1',    $this->site_address1);
        $stmt->bindParam(':address2',    $this->site_address2);
        $stmt->bindParam(':city',        $this->site_city);
        $stmt->bindParam(':county',      $this->site_county);
        $stmt->bindParam(':postcode',    $this->site_postcode);
        if ($stmt->execute()) {
            $this->data["id"]      = $this->conn->lastInsertId();
            $this->data["success"] = "Ok";
            $this->data["count"]   = 1;
        }
        return json_encode($this->data);
    }

    public function updateSite() {
        $this->initialiseJSON();
        $this->query = "UPDATE site SET
                              customer_id = :customer_id,
                                     name = :name,
                                shortname = :shortName,
                                 address1 = :address1,
                                 address2 = :address2,
                                     city = :city,
                                   county = :county,
                                 postcode = :postcode
                            WHERE id = :id";
        $stmt                 = $this->conn->prepare($this->query);
        $this->site_name      = htmlspecialchars(strip_tags($this->site_name));
        $this->site_shortName = htmlspecialchars(strip_tags($this->site_shortName));
        $this->site_address1  = htmlspecialchars(strip_tags($this->site_address1));
        $this->site_address2  = htmlspecialchars(strip_tags($this->site_address2));
        $this->site_city      = htmlspecialchars(strip_tags($this->site_city));
        $this->site_county    = htmlspecialchars(strip_tags($this->site_county));
        $this->site_postcode  = htmlspecialchars(strip_tags($this->site_postcode));
        $stmt->bindParam(':customer_id', $this->site_customer_id);
        $stmt->bindParam(':name',        $this->site_name);
        $stmt->bindParam(':shortName',   $this->site_shortName);
        $stmt->bindParam(':address1',    $this->site_address1);
        $stmt->bindParam(':address2',    $this->site_address2);
        $stmt->bindParam(':city',        $this->site_city);
        $stmt->bindParam(':county',      $this->site_county);
        $stmt->bindParam(':postcode',    $this->site_postcode);
        $stmt->bindParam(':id',          $this->site_id);
        if ($stmt->execute()) {
            $this->data["success"] = "Ok";
            $this->data["count"]   = $this->numRows;
        }
        return json_encode($this->data);
    }

    public function deleteSite() {
        $this->initialiseJSON();
        $query = "DELETE FROM site WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->site_id);
        if ($stmt->execute()) {
            $this->data["id"]      = $this->site_id;
            $this->data["success"] = "Ok";
            $this->data["count"]   = $this->numRows;
        }
        return json_encode($this->data);
    }
}
?>
