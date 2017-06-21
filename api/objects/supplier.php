<?php

class Supplier {
    // database connection and table name
    private $conn;
    private $table_name = "supplier";

    // object properties
    public $id;
    public $employee_id;
    public $name;
    public $shortname;
    public $companyregno;
    public $website;
    public $quote_email;
    public $experian_score;
    public $credit_score;
    public $credit_hard_limit;
    public $credit_soft_limit;
    public $credit_outstanding;
    public $date_updated;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function delete() {
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
        $query  = "UPDATE ".$this->table_name." SET employee_id = :employee_id, name = :name, shortname = :short_name, companyregno = :companyregno, website= :website, quote_email = :quote_email, ";
        $query .= "experian_score = :experian_score, credit_score = :credit_score, credit_hard_limit = :credit_hard_limit, credit_soft_limit = :credit_soft_limit, ";
        $query .= "credit_outstanding = :credit_outstanding, date_updated = now() WHERE id = :id";
        $stmt   = $this->conn->prepare($query);
        $this->name          = htmlspecialchars(strip_tags($this->name));
        $this->shortname     = htmlspecialchars(strip_tags($this->shortname));
        $this->companyregno  = htmlspecialchars(strip_tags($this->companyregno));
        $this->website       = htmlspecialchars(strip_tags($this->website));
        $this->quote_email   = htmlspecialchars(strip_tags($this->quote_email));

        $stmt->bindParam(':employee_id',        $this->employee_id);
        $stmt->bindParam(':name',               $this->name);
        $stmt->bindParam(':shortname',          $this->shortname);
        $stmt->bindParam(':companyregno',       $this->namcompanyregnoe);
        $stmt->bindParam(':website',            $this->website);
        $stmt->bindParam(':quote_email',        $this->quote_email);
        $stmt->bindParam(':experian_score',     $this->experian_score);
        $stmt->bindParam(':credit_score',       $this->credit_score);
        $stmt->bindParam(':credit_hard_limit',  $this->credit_hard_limit);
        $stmt->bindParam(':credit_soft_limit',  $this->credit_soft_limit);
        $stmt->bindParam(':credit_outstanding', $this->credit_outstanding);
        $stmt->bindParam(':id',                 $this->id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function readOne() {
        $query = "SELECT id, employee_id, name, shortname, companyregno, website, quote_email, experian_score, credit_score, credit_hard_limit, credit_soft_limit, credit_outstanding, date_updated FROM ".$this->table_name." WHERE id = ? LIMIT 0,1";
        $stmt  = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row                      = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->employee_id        = $row['employee_id'];
        $this->name               = $row['name'];
        $this->shortname          = $row['shortname'];
        $this->companyregno       = $row['companyregno'];
        $this->website            = $row['website'];
        $this->quote_email        = $row['quote_email'];
        $this->experian_score     = $row['experian_score'];
        $this->credit_score       = $row['credit_score'];
        $this->credit_hard_limit  = $row['credit_hard_limit'];
        $this->credit_soft_limit  = $row['credit_soft_limit'];
        $this->credit_outstanding = $row['credit_outstanding'];
        $this->date_updated       = $row['date_updated'];
    }

    function create() {
        $query  = "INSERT INTO ".$this->table_name." SET employee_id = :employee_id, name = :name, shortname = :short_name, companyregno = :companyregno, website= :website, quote_email = :quote_email, ";
        $query .= "experian_score = :experian_score, credit_score = :credit_score, credit_hard_limit = :credit_hard_limit, credit_soft_limit = :credit_soft_limit, ";
        $query .= "credit_outstanding = :credit_outstanding, date_updated = now()";
        $stmt   = $this->conn->prepare($query);
        $this->name          = htmlspecialchars(strip_tags($this->name));
        $this->shortname     = htmlspecialchars(strip_tags($this->shortname));
        $this->companyregno  = htmlspecialchars(strip_tags($this->companyregno));
        $this->website       = htmlspecialchars(strip_tags($this->website));
        $this->quote_email   = htmlspecialchars(strip_tags($this->quote_email));

        $stmt->bindParam(':employee_id',        $this->employee_id);
        $stmt->bindParam(':name',               $this->name);
        $stmt->bindParam(':shortname',          $this->shortname);
        $stmt->bindParam(':companyregno',       $this->namcompanyregnoe);
        $stmt->bindParam(':website',            $this->website);
        $stmt->bindParam(':quote_email',        $this->quote_email);
        $stmt->bindParam(':experian_score',     $this->experian_score);
        $stmt->bindParam(':credit_score',       $this->credit_score);
        $stmt->bindParam(':credit_hard_limit',  $this->credit_hard_limit);
        $stmt->bindParam(':credit_soft_limit',  $this->credit_soft_limit);
        $stmt->bindParam(':credit_outstanding', $this->credit_outstanding);
        if ($stmt->execute()) {
            return true;
        }
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
        return false;
    }

    function readAll() {
        $query = "SELECT id, employee_id, name, shortname, companyregno, website, quote_email, experian_score, credit_score, credit_hard_limit, credit_soft_limit, credit_outstanding, date_updated FROM ".$this->table_name." ORDER BY id DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
}
?>
