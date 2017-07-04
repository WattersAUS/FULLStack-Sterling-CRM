<?php
class Employee {
    // database connection
    private $conn;

    // object properties (job data first, related after)
    public $employee_id;
	public $employee_user_id;
	public $employee_is_manager;
	public $employee_reports;
	public $employee_emp_no;
	public $employee_job_title;
    public $employee_job_role;
	public $employee_manager_id;
	public $employee_division_id;
	public $employee_team_id;

	public $user_title;
	public $user_first_name;
	public $user_last_name;
	public $user_full_name;
	public $user_email_address;
	public $user_start_date;
	public $user_end_date;
	public $user_password;

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
		$this->query  = "SELECT
                            e.id AS employee_id,
                            e.user_id AS employee_user_id,
                            e.is_manager AS employee_is_manager,
                            (CASE WHEN (e.is_manager = 1) THEN 'Yes' ELSE 'No' end) AS employee_reports,
                            e.emp_no AS employee_emp_no,
                            e.job_title AS employee_job_title,
                            e.job_role AS employee_job_role,
                            e.manager_id AS employee_manager_id,
                            e.division_id AS employee_division_id,
                            e.team_id AS employee_team_id,
                            u.title AS user_title,
                            u.first_name AS user_first_name,
                            u.last_name AS user_last_name,
                            u.email_address AS user_email_address,
                            u.start_date AS user_start_date,
                            u.end_date AS user_end_date,
                            u.password AS user_password,
                            d.description AS division_description,
                            t.description AS team_description,
                            m.title AS manager_title,
                            m.first_name AS manager_first_name,
                            m.last_name AS manager_last_name,
                            m.email_address AS manager_email_address";
		$this->query .= " FROM employee e";
		$this->query .= " LEFT JOIN user u ON e.user_id = u.id";
		$this->query .= " LEFT JOIN division d ON e.division_id = d.id";
		$this->query .= " LEFT JOIN team t ON e.team_id = t.id";
		$this->query .= " LEFT JOIN user m ON e.manager_id = m.id";
        return;
    }

    private function setActiveEmployees() {
        $this->query .= " WHERE u.end_date IS NULL";
        return;
    }

    private function setEmployeeID($id) {
        $this->query .= " WHERE e.id = ".$id;
    }

    private function setActiveManagers() {
        $this->query .= " WHERE e.is_manager = TRUE AND u.end_date IS NULL";
    }

    private function buildRowArray($row) {
        $item = array(
            "employee_id"           => $row['employee_id'],
            "employee_user_id"      => $row['employee_user_id'],
            "employee_is_manager"   => $row['employee_is_manager'],
            "employee_reports"      => $row['employee_reports'],
            "employee_emp_no"       => $row['employee_emp_no'],
            "employee_job_title"    => $row['employee_job_title'],
            "employee_job_role"     => $row['employee_job_role'],
            "employee_manager_id"   => $row['employee_manager_id'],
            "employee_division_id"  => $row['employee_division_id'],
            "employee_team_id"      => $row['employee_team_id'],
            "user_title"            => $row['user_title'],
            "user_first_name"       => $row['user_first_name'],
            "user_last_name"        => $row['user_last_name'],
            "user_full_name"        => $row['user_last_name'].', '.$row['user_first_name'],
            "user_email_address"    => $row['user_email_address'],
            "user_start_date"       => $row['user_start_date'],
            "user_end_date"         => $row['user_end_date'],
            "user_password"         => $row['user_password'],
            "division_description"  => $row['division_description'],
            "team_description"      => $row['team_description'],
            "manager_title"         => $row['manager_title'],
            "manager_first_name"    => $row['manager_first_name'],
            "manager_last_name"     => $row['manager_last_name'],
            "manager_email_address" => $row['manager_email_address']
        );
        return($item);
    }

    public function getEmployeeByID($employee_id) {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setEmployeeID($employee_id);
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

    public function getManagers() {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setActiveManagers();
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

    public function getActiveEmployees() {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setActiveEmployees();
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
        $this->query = "INSERT INTO employee (
                            user_id,
                            is_manager,
                            emp_no,
                            job_title,
                            job_role,
                            manager_id,
                            division_id,
                            team_id
                    ) VALUES (
                            :user_id,
                            :is_manager,
                            :emp_no,
                            :job_title,
                            :job_role,
                            :manager_id,
                            :division_id,
                            :team_id)";
        $stmt = $this->conn->prepare($this->query);
        $stmt->bindParam(':user_id',     $this->employee_user_id);
        $stmt->bindParam(':is_manager',  $this->employee_is_manager);
        $stmt->bindParam(':emp_no',      htmlspecialchars(strip_tags($this->employee_emp_no)));
        $stmt->bindParam(':job_title',   htmlspecialchars(strip_tags($this->employee_job_title)));
        $stmt->bindParam(':job_role',    htmlspecialchars(strip_tags($this->employee_job_role)));
        $stmt->bindParam(':manager_id',  $this->employee_manager_id);
        $stmt->bindParam(':division_id', $this->employee_division_id);
        $stmt->bindParam(':team_id',     $this->employee_team_id);
        if ($stmt->execute()) {
            $this->data["id"]      = $this->conn->lastInsertId();
            $this->data["success"] = "Ok";
            $this->data["count"]   = 1;
        }
        return json_encode($this->data);
    }

    public function updateEmployee() {
        $this->initialiseJSON();
        $this->query = "UPDATE employee SET
                            is_manager = :is_manager,
                            emp_no = :emp_no,
                            job_title = :job_title,
                            job_role = :job_role,
                            manager_id = :manager_id,
                            division_id = :division_id,
                            team_id = :team_id
                        WHERE id = :id";
        $stmt = $this->conn->prepare($this->query);
        $stmt->bindParam(':is_manager',  $this->employee_is_manager);
        $stmt->bindParam(':emp_no',      htmlspecialchars(strip_tags($this->employee_emp_no)));
        $stmt->bindParam(':job_title',   htmlspecialchars(strip_tags($this->employee_job_title)));
        $stmt->bindParam(':job_role',    htmlspecialchars(strip_tags($this->employee_job_role)));
        $stmt->bindParam(':manager_id',  $this->employee_manager_id);
        $stmt->bindParam(':division_id', $this->employee_division_id);
        $stmt->bindParam(':team_id',     $this->employee_team_id);
        $stmt->bindParam(':id',          $this->employee_id);
        if ($stmt->execute()) {
            $this->data["id"]      = $this->conn->lastInsertId();
            $this->data["success"] = "Ok";
            $this->data["count"]   = 1;
        }
        return json_encode($this->data);
    }

}
?>
