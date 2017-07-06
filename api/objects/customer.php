<?php
class Customer {
    // database connection and table name
    private $conn;

    // object properties
	public $customer_id;
    public $customer_employee_id;
    public $customer_name;
    public $customer_shortname;
    public $customer_type;
    public $customer_companyregno;
    public $customer_website;
    public $customer_quote_email;
    public $customer_kpi_quote_rtnd_by;
    public $customer_experian_score;
    public $customer_credit_score;
    public $customer_credit_hard_limit;
    public $customer_credit_soft_limit;
    public $customer_credit_outstanding;
    public $customer_terms_id;
    public $customer_kpi_agreed;
    public $customer_quote_breakdown_rqrd;
    public $customer_quote_rtn_trigger;
    public $customer_days_to_review;

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
        $this->query  = "SELECT c.id AS customer_id,
                                c.employee_id AS customer_employee_id,
                                c.name AS customer_name,
                                c.shortname AS customer_shortname,
                                c.type AS customer_type,
                                c.companyregno AS customer_companyregno,
                                c.website AS customer_website,
                                c.quote_email AS customer_quote_email,
                                c.kpi_quote_rtnd_by AS customer_kpi_quote_rtnd_by,
                                c.experian_score AS customer_experian_score,
                                c.credit_score AS customer_credit_score,
                                c.credit_hard_limit AS customer_credit_hard_limit,
                                c.credit_soft_limit AS customer_credit_soft_limit,
                                c.credit_outstanding AS customer_credit_outstanding,
                                c.terms_id AS customer_terms_id,
                                c.kpi_agreed AS customer_kpi_agreed,
                                c.quote_breakdown_rqrd AS customer_quote_breakdown_rqrd,
                                c.quote_rtn_trigger AS customer_quote_rtn_trigger,
                                c.days_to_review AS customer_days_to_review,
                                c.date_updated AS customer_date_updated,
                                e.id AS employee_id,
                                u.id AS user_id,
                                u.first_name AS user_first_name,
                                u.last_name AS user_last_name,
                                t.id AS terms_id,
                                t.description AS terms_description,
                                t.days AS terms_days";
        $this->query .= " FROM customer c";
        $this->query .= " LEFT JOIN terms t ON c.terms_id = t.id";
        $this->query .= " LEFT JOIN employee e ON c.employee_id = e.id";
        $this->query .= " LEFT JOIN user u ON e.user_id = u.id";
        return;
    }

    private function setCustomerID($id) {
        $this->query .= " WHERE c.id = ".$id;
        return;
    }

    private function buildRowArray($row) {
        $item = array(
            "customer_id"                   => $row['customer_id'],
            "customer_employee_id"          => $row['customer_employee_id'],
            "customer_name"                 => $row['customer_name'],
            "customer_shortname"            => $row['customer_shortname'],
            "customer_type"                 => $row['customer_type'],
            "customer_companyregno"         => $row['customer_companyregno'],
            "customer_website"              => $row['customer_website'],
            "customer_quote_email"          => $row['customer_quote_email'],
            "customer_kpi_quote_rtnd_by"    => $row['customer_kpi_quote_rtnd_by'],
            "customer_experian_score"       => $row['customer_experian_score'],
            "customer_credit_score"         => $row['customer_credit_score'],
            "customer_credit_hard_limit"    => $row['customer_credit_hard_limit'],
            "customer_credit_soft_limit"    => $row['customer_credit_soft_limit'],
            "customer_credit_outstanding"   => $row['customer_credit_outstanding'],
            "customer_terms_id"             => $row['customer_terms_id'],
            "customer_kpi_agreed"           => $row['customer_kpi_agreed'],
            "customer_quote_breakdown_rqrd" => $row['customer_quote_breakdown_rqrd'],
            "customer_quote_rtn_trigger"    => $row['customer_quote_rtn_trigger'],
            "customer_days_to_review"       => $row['customer_days_to_review'],
            "customer_date_updated"         => $row['customer_date_updated'],
            "employee_id"                   => $row['employee_id'],
            "user_id"                       => $row['user_id'],
            "user_first_name"               => $row['user_first_name'],
            "user_last_name"                => $row['user_last_name'],
            "user_full_name"                => $row['user_last_name'].', '.$row['user_first_name'],
            "terms_id"                      => $row['terms_id'],
            "terms_description"             => $row['terms_description'],
            "terms_days"                    => $row['terms_days']
        );
        return($item);
    }

    public function getCustomerByID($customer_id) {
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

    public function insertCustomer() {
        $this->initialiseJSON();
        $this->query = "INSERT INTO customer (
                            employee_id,
                            name,
                            shortname,
                            type,
                            companyregno,
                            website,
                            quote_email,
                            kpi_quote_rtnd_by,
                            experian_score,
                            credit_score,
                            credit_hard_limit,
                            credit_soft_limit,
                            credit_outstanding,
                            terms_id,
                            kpi_agreed,
                            quote_breakdown_rqrd,
                            quote_rtn_trigger,
                            days_to_review
                        ) VALUES (
                            :employee_id,
                            :name,
                            :shortname,
                            :type,
                            :companyregno,
                            :website,
                            :quote_email,
                            :kpi_quote_rtnd_by,
                            :experian_score,
                            :credit_score,
                            :credit_hard_limit,
                            :credit_soft_limit,
                            :credit_outstanding,
                            :terms_id,
                            :kpi_agreed,
                            :quote_breakdown_rqrd,
                            :quote_rtn_trigger,
                            :days_to_review
                        )";
        $stmt  = $this->conn->prepare($this->query);
        $stmt->bindParam(':employee_id',          $this->customer_employee_id);
        $stmt->bindParam(':name',                 htmlspecialchars(strip_tags($this->customer_name)));
        $stmt->bindParam(':shortname',            htmlspecialchars(strip_tags($this->customer_shortname)));
        $stmt->bindParam(':type',                 $this->customer_type);
        $stmt->bindParam(':companyregno',         htmlspecialchars(strip_tags($this->customer_companyregno)));
        $stmt->bindParam(':website',              htmlspecialchars(strip_tags($this->customer_website)));
        $stmt->bindParam(':quote_email',          htmlspecialchars(strip_tags($this->customer_quote_email)));
        $stmt->bindParam(':kpi_quote_rtnd_by',    $this->customer_kpi_quote_rtnd_by);
        $stmt->bindParam(':experian_score',       htmlspecialchars(strip_tags($this->customer_experian_score)));
        $stmt->bindParam(':credit_score',         htmlspecialchars(strip_tags($this->customer_credit_score)));
        $stmt->bindParam(':credit_hard_limit',    $this->customer_credit_hard_limit);
        $stmt->bindParam(':credit_soft_limit',    $this->customer_credit_soft_limit);
        $stmt->bindParam(':credit_outstanding',   $this->customer_credit_outstanding);
        $stmt->bindParam(':terms_id',             $this->customer_terms_id);
        $stmt->bindParam(':kpi_agreed',           $this->customer_kpi_agreed);
        $stmt->bindParam(':quote_breakdown_rqrd', $this->customer_quote_breakdown_rqrd);
        $stmt->bindParam(':quote_rtn_trigger',    $this->customer_quote_rtn_trigger);
        $stmt->bindParam(':days_to_review',       $this->customer_days_to_review);
        if ($stmt->execute()) {
            $this->data["id"]      = $this->conn->lastInsertId();
            $this->data["success"] = "Ok";
            $this->data["count"]   = 1;
        }
        return json_encode($this->data);
    }

    public function updateCustomer() {
        $this->initialiseJSON();
        $this->query = "UPDATE customer SET
                            employee_id          = :employee_id,
                            name                 = :name,
                            shortname            = :shortname,
                            type                 = :type,
                            companyregno         = :companyregno,
                            website              = :website,
                            quote_email          = :quote_email,
                            kpi_quote_rtnd_by    = :kpi_quote_rtnd_by,
                            experian_score       = :experian_score,
                            credit_score         = :credit_score,
                            credit_hard_limit    = :credit_hard_limit,
                            credit_soft_limit    = :credit_soft_limit,
                            credit_outstanding   = :credit_outstanding,
                            terms_id             = :terms_id,
                            kpi_agreed           = :kpi_agreed,
                            quote_breakdown_rqrd = :quote_breakdown_rqrd,
                            quote_rtn_trigger    = :quote_rtn_trigger,
                            days_to_review       = :days_to_review
                        WHERE id = :id";
        $stmt  = $this->conn->prepare($this->query);
        $stmt->bindParam(':employee_id',          $this->customer_employee_id);
        $stmt->bindParam(':name',                 htmlspecialchars(strip_tags($this->customer_name)));
        $stmt->bindParam(':shortname',            htmlspecialchars(strip_tags($this->customer_shortname)));
        $stmt->bindParam(':type',                 $this->customer_type);
        $stmt->bindParam(':companyregno',         htmlspecialchars(strip_tags($this->customer_companyregno)));
        $stmt->bindParam(':website',              htmlspecialchars(strip_tags($this->customer_website)));
        $stmt->bindParam(':quote_email',          htmlspecialchars(strip_tags($this->customer_quote_email)));
        $stmt->bindParam(':kpi_quote_rtnd_by',    $this->customer_kpi_quote_rtnd_by);
        $stmt->bindParam(':experian_score',       htmlspecialchars(strip_tags($this->customer_experian_score)));
        $stmt->bindParam(':credit_score',         htmlspecialchars(strip_tags($this->customer_credit_score)));
        $stmt->bindParam(':credit_hard_limit',    $this->customer_credit_hard_limit);
        $stmt->bindParam(':credit_soft_limit',    $this->customer_credit_soft_limit);
        $stmt->bindParam(':credit_outstanding',   $this->customer_credit_outstanding);
        $stmt->bindParam(':terms_id',             $this->customer_terms_id);
        $stmt->bindParam(':kpi_agreed',           $this->customer_kpi_agreed);
        $stmt->bindParam(':quote_breakdown_rqrd', $this->customer_quote_breakdown_rqrd);
        $stmt->bindParam(':quote_rtn_trigger',    $this->customer_quote_rtn_trigger);
        $stmt->bindParam(':days_to_review',       $this->customer_days_to_review);
        $stmt->bindParam(':id',                   $this->customer_id);
        if ($stmt->execute()) {
            $this->data["success"] = "Ok";
            $this->data["count"]   =  $stmt->rowCount();
        }
        return json_encode($this->data);
    }

}
?>
