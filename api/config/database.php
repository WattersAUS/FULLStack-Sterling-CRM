<?php
class Database{

    // specify your own database credentials
    private $host = "localhost";
    //private $db_name = "c2SS_Data"; 
    private $db_name = "c2ssdata";
    private $username = "c2ssdbuser";
    private $password = "IgG2q3RQYa";
    public $conn;

    // get the database connection
    public function getConnection(){ $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
