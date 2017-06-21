<?php
class SiteContact {
    // database connection and table name
    private $conn;

    // object properties (job data first, related after)
    public $site_contact_id;
    public $site_id;
    public $contact_type;
    public $contact_first_name;
    public $contact_last_name;
    public $contact_tel_no;
    public $contact_email_address;

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
        $this->query  = "SELECT sc.id AS site_contact_id, sc.site_id AS site_id, sc.type AS contact_type, sc.first_name AS contact_first_name, sc.last_name AS contact_last_name, sc.tel_no AS contact_tel_no, sc.email_address AS contact_email_address";
        $this->query .= " FROM site_contact sc";
        return;
    }

    private function setSiteID($site_id) {
        $this->query .= " WHERE sc.site_id = ".$site_id;
        return;
    }

    private function buildRowArray($row) {
        $item = array(
            "site_contact_id"       => $row['site_contact_id'],
            "site_id"               => $row['site_id'],
            "contact_type"          => $row['contact_type'],
            "contact_name"          => $row['contact_last_name'].", ".$row['contact_first_name'],
            "contact_tel_no"        => $row['contact_tel_no'],
            "contact_email_address" => $row['contact_email_address']
        );
        return($item);
    }

    public function getSiteContactsForSite($site_id) {
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

    public function getAllSiteContacts() {
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
