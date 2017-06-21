<?php
class Employee {
    // database connection
    private $conn;

    // object properties (job data first, related after)
    public $employee_id;
	public $user_id;
	public $is_manager;
	public $reports;
	public $emp_no;
	public $job_title;
    public $job_role;
	public $manager_id;
	public $division_id;
	public $team_id;

	public $title;
	public $first_name;
	public $last_name;
	public $full_name;
	public $email_address;
	public $start_date;
	public $end_date;
	public $password;

	public $division_description;

	public $team_description;

	public $manager_title;
	public $manager_first_name;
	public $manager_last_name;
	public $manager_email_address;

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
		$this->query  = "SELECT e.id AS employee_id, e.user_id AS user_id, e.is_manager AS is_manager, (CASE WHEN (e.is_manager = 1) THEN 'Yes' ELSE 'No' end) AS reports, e.emp_no AS emp_no, e.job_title AS job_title, e.job_role AS job_role, e.manager_id AS manager_id, e.division_id AS division_id, e.team_id AS team_id, u.title AS title, u.first_name AS first_name, u.last_name AS last_name, u.email_address AS email_address, u.start_date AS start_date, u.end_date AS end_date, u.password AS password, d.description AS division_description, t.description AS team_description, m.title AS manager_title, m.first_name AS manager_first_name, m.last_name AS manager_last_name, m.email_address AS manager_email_address";
		$this->query .= " FROM employee e";
		$this->query .= " LEFT JOIN user u ON e.user_id = u.id";
		$this->query .= " LEFT JOIN division d ON e.division_id = d.id";
		$this->query .= " LEFT JOIN team t ON e.team_id = t.id";
		$this->query .= " LEFT JOIN user m ON e.manager_id = m.id";
        return;
    }

    private function setActiveEmployess() {
        $this->query .= " WHERE u.end_date IS NULL";
        return;
    }

    private function buildRowArray($row) {
        $item = array(
            "employee_id"           => $row['employee_id'],
            "user_id"               => $row['user_id'],
            "is_manager"            => $row['is_manager'],
            "reports"               => $row['reports'],
            "emp_no"                => $row['emp_no'],
            "job_title"             => $row['job_title'],
            "job_role"              => $row['job_role'],
            "manager_id"            => $row['manager_id'],
            "division_id"           => $row['division_id'],
            "team_id"               => $row['team_id'],
            "title"                 => $row['title'],
            "first_name"            => $row['first_name'],
            "last_name"             => $row['last_name'],
            "full_name"             => $row['last_name'].', '.$row['first_name'],
            "email_address"         => $row['email_address'],
            "start_date"            => $row['start_date'],
            "end_date"              => $row['end_date'],
            "password"              => $row['password'],
            "division_description"  => $row['division_description'],
            "team_description"      => $row['team_description'],
            "manager_title"         => $row['manager_title'],
            "manager_first_name"    => $row['manager_first_name'],
            "manager_last_name"     => $row['manager_last_name'],
            "manager_email_address" => $row['manager_email_address']
        );
        return($item);
    }

	public function getAllEmployees() {
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

    public function insertEmployee() {
        $this->initialiseJSON();
        $query = "INSERT INTO employee (user_id, is_manager, emp_no, job_title, job_role, manager_id, division_id, team_id) VALUES (:user_id, :is_manager, :emp_no, :job_title, :job_role, :manager_id, :division_id, :team_id)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':user_id',     $this->user_id);
        $stmt->bindParam(':is_manager',  $this->is_manager);
        $stmt->bindParam(':emp_no',      htmlspecialchars(strip_tags($this->emp_no)));
        $stmt->bindParam(':job_title',   htmlspecialchars(strip_tags($this->job_title)));
        $stmt->bindParam(':job_role',    htmlspecialchars(strip_tags($this->job_role)));
        $stmt->bindParam(':manager_id',  $this->manager_id);
        $stmt->bindParam(':division_id', $this->division_id);
        $stmt->bindParam(':team_id',     $this->team_id);
        if ($stmt->execute()) {
            $this->data["id"]      = $this->conn->lastInsertId();
            $this->data["success"] = "Ok";
            $this->data["count"]   = 1;
        }
        return json_encode($this->data);
    }

}
?>
