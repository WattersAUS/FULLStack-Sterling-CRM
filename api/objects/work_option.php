<?php
class WorkOption {
    // database connection and table name
    private $conn;

    // object properties
    public $work_option_id;
    public $work_option_category_id;
    public $work_option_code;
    public $work_option_description;
    public $work_option_default_quantity;
    public $work_option_default_pricing;

    public $category_id;
    public $category_code;
    public $category_description;

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
        $this->query = "SELECT
                            w.id AS work_option_id,
                            w.category_id AS work_option_category_id,
                            w.code AS work_option_code,
                            w.description AS work_option_description,
                            w.default_quantity AS work_option_default_quantity,
                            w.default_pricing AS work_option_default_pricing,
                            c.id AS category_id,
                            c.code AS category_code,
                            c.description AS category_description
                        FROM work_option w
                        LEFT JOIN category c ON c.id = w.category_id";
        return;
    }

    private function setWorkOptionID($id) {
        $this->query .= " WHERE w.id = ".$id;
        return;
    }

    private function buildRowArray($row) {
        $item = array(
            "work_option_id"               => $row['work_option_id'],
            "work_option_category_id"      => $row['work_option_category_id'],
            "work_option_code"             => $row['work_option_code'],
            "work_option_description"      => $row['work_option_description'],
            "work_option_default_quantity" => $row['work_option_default_quantity'],
            "work_option_default_pricing"  => $row['work_option_default_pricing'],
            "category_id"                  => $row['category_id'],
            "category_code"                => $row['category_code'],
            "category_description"         => $row['category_description']
        );
        return($item);
    }

    public function getWorkOptionByID($id) {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setWorkOptionID($id);
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

    public function getAllWorkOptions() {
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

    public function insertWorkOption() {
        $this->initialiseJSON();
        $query  = "INSERT INTO work_option (category_id, code, description, default_quantity, default_pricing) ";
        $query .= " VALUES (:category_id, :code, :description, :default_quantity, :default_pricing)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':category_id',      $this->work_option_category_id);
        $stmt->bindParam(':code',             htmlspecialchars(strip_tags($this->work_option_code)));
        $stmt->bindParam(':description',      htmlspecialchars(strip_tags($this->work_option_description)));
        $stmt->bindParam(':default_quantity', $this->work_option_default_quantity);
        $stmt->bindParam(':default_pricing',  $this->work_option_default_pricing);
        if ($stmt->execute()) {
            $this->data["id"]      = $this->conn->lastInsertId();
            $this->data["success"] = "Ok";
            $this->data["count"]   = $stmt->rowCount();
        }
        return json_encode($this->data);
    }

    public function updateWorkOption() {
        $this->initialiseJSON();
        $query = "UPDATE work_option SET
                        category_id      = :category_id,
                        code             = :code,
                        description      = :description,
                        default_quantity = :default_quantity,
                        default_pricing  = :default_pricing
                    WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':category_id',      $this->work_option_category_id);
        $stmt->bindParam(':code',             htmlspecialchars(strip_tags($this->work_option_code)));
        $stmt->bindParam(':description',      htmlspecialchars(strip_tags($this->work_option_description)));
        $stmt->bindParam(':default_quantity', $this->work_option_default_quantity);
        $stmt->bindParam(':default_pricing',  $this->work_option_default_pricing);
        $stmt->bindParam(':id',               $this->work_option_id);
        if ($stmt->execute()) {
            $this->data["success"] = "Ok";
            $this->data["count"]   = $stmt->rowCount();
        }
        return json_encode($this->data);
    }

    public function deleteWorkOption() {
        $this->initialiseJSON();
        $this->query = "DELETE FROM work_option WHERE id = :id";
        $stmt  = $this->conn->prepare($this->query);
        $stmt->bindParam(':id', $this->work_option_id);
        if ($stmt->execute()) {
            $this->data["id"]      = $this->work_option_id;
            $this->data["success"] = "Ok";
            $this->data["count"]   = $stmt->rowCount();
        }
        return json_encode($this->data);
    }

}
?>
