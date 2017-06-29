<?php
class User {
    // database connection and table name
    private $conn;

    // object properties
    public $user_id;
    public $user_title;
    public $user_first_name;
    public $user_last_name;
    public $user_email_address;
    public $user_start_date;
    public $user_end_date;
    public $user_password;
    public $user_GUID;
    public $user_level;

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
        $this->query = "SELECT u.id AS user_id,
                            u.title AS user_title,
                            u.first_name AS user_first_name,
                            u.last_name AS user_last_name,
                            u.email_address AS user_email_address,
                            u.start_date AS user_start_date,
                            u.end_date AS user_end_date,
                            u.password AS user_password,
                            u.userGUID AS user_GUID,
                            u.user_level AS user_level
                            FROM user u";
        return;
    }

    private function setUserID($id) {
        $this->query .= " WHERE u.id = ".$id;
        return;
    }

    private function buildRowArray($row) {
        $item = array(
            "user_id"            => $row['user_id'],
            "user_title"         => $row['user_title'],
            "user_first_name"    => $row['user_first_name'],
            "user_last_name"     => $row['user_last_name'],
            "user_email_address" => $row['user_email_address'],
            "user_start_date"    => $row['user_start_date'],
            "user_end_date"      => $row['user_end_date'],
            "user_password"      => $row['user_password'],
            "user_GUID"          => $row['user_GUID'],
            "user_level"         => $row['user_level']
        );
        return($item);
    }

    public function getUserByID($user_id) {
        $this->initialiseJSON();
        $this->setDefaultQuery();
        $this->setUserID($user_id);
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

    public function getAllUsers() {
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

    public function insertUser() {
        $this->initialiseJSON();
        $query  = "INSERT INTO user (title, first_name, last_name, email_address, start_date, password, user_level) ";
        $query .= " VALUES (:title, :first_name, :last_name, :email_address, now(), :password, :user_level)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':title',         htmlspecialchars(strip_tags($this->user_title)));
        $stmt->bindParam(':first_name',    htmlspecialchars(strip_tags($this->user_first_name)));
        $stmt->bindParam(':last_name',     htmlspecialchars(strip_tags($this->user_last_name)));
        $stmt->bindParam(':email_address', htmlspecialchars(strip_tags($this->user_email_address)));
        $stmt->bindParam(':password',      htmlspecialchars(strip_tags($this->user_password)));
        $stmt->bindParam(':user_level',    $this->user_level);
        if ($stmt->execute()) {
            $this->data["id"]      = $this->conn->lastInsertId();
            $this->data["success"] = "Ok";
            $this->data["count"]   = $stmt->rowCount();
        }
        return json_encode($this->data);
    }

    public function updateUser() {
        $this->initialiseJSON();
        $query = "UPDATE user SET
                        title         = :title,
                        first_name    = :first_name,
                        last_name     = :last_name,
                        email_address = :email_address,
                        password      = :password,
                        user_level    = :user_level
                    WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':title',         htmlspecialchars(strip_tags($this->user_title)));
        $stmt->bindParam(':first_name',    htmlspecialchars(strip_tags($this->user_first_name)));
        $stmt->bindParam(':last_name',     htmlspecialchars(strip_tags($this->user_last_name)));
        $stmt->bindParam(':email_address', htmlspecialchars(strip_tags($this->user_email_address)));
        $stmt->bindParam(':password',      htmlspecialchars(strip_tags($this->user_password)));
        $stmt->bindParam(':user_level',    $this->user_level);
        $stmt->bindParam(':id',            $this->user_id);
        if ($stmt->execute()) {
            $this->data["success"] = "Ok";
            $this->data["count"]   = $stmt->rowCount();
        }
        return json_encode($this->data);
    }

    public function deactivateUser() {
        $this->initialiseJSON();
        $query = "UPDATE user SET
                        end_date = now(),
                        user_level = 0
                    WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->user_id);
        if ($stmt->execute()) {
            $this->data["success"] = "Ok";
            $this->data["count"]   = $stmt->rowCount();
        }
        return json_encode($this->data);
    }

    public function activateUser() {
        $this->initialiseJSON();
        $query = "UPDATE user SET
                        end_date = NULL,
                        user_level = 0
                    WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->user_id);
        if ($stmt->execute()) {
            $this->data["success"] = "Ok";
            $this->data["count"]   = $stmt->rowCount();
        }
        return json_encode($this->data);
    }

}
?>
