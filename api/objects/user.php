<?php
class User{
    // database connection and table name
    private $conn;
    private $table_name = "user";

    // object properties
    public $id;
    public $title;
    public $first_name;
    public $last_name;
    public $email_address;
    public $start_date;
    public $end_date;
    public $password;
    public $userGUID;
    public $user_level;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    
  // delete the product
function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}
  
    
    // update the product
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                title = :title,
                first_name = :first_name,
                last_name = :last_name,
                email_address = :email_address,
                start_date = :start_date,
                end_date = :end_date,
                password = :password,
                userGUID = :userGUID,
                user_level = :user_level
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->title=htmlspecialchars(strip_tags($this->title));
    $this->first_name=htmlspecialchars(strip_tags($this->first_name));
    $this->last_name=htmlspecialchars(strip_tags($this->last_name));
    $this->email_address=htmlspecialchars(strip_tags($this->email_address));
    $this->start_date=htmlspecialchars(strip_tags($this->start_date));
    $this->end_date=htmlspecialchars(strip_tags($this->end_date));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->userGUID=htmlspecialchars(strip_tags($this->userGUID));
    $this->user_level=htmlspecialchars(strip_tags($this->user_level));
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind new values
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':first_name', $this->first_name);
    $stmt->bindParam(':last_name', $this->last_name);
    $stmt->bindParam(':email_address', $this->email_address);
    $stmt->bindParam(':start_date', $this->start_date);
    $stmt->bindParam(':end_date', $this->end_date);
    $stmt->bindParam(':password', $this->password);
    $stmt->bindParam(':userGUID', $this->userGUID);
    $stmt->bindParam(':user_level', $this->user_level);
    $stmt->bindParam(':id', $this->id);
    
 
 
    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}


    
    // used when filling up the update product form
function readOne(){
     
    // query to read single record
    $query = "SELECT 
                title, first_name, last_name,  email_address,  start_date, end_date, password, userGUID, user_level
            FROM 
                " . $this->table_name . "
            WHERE 
                id = ? 
            LIMIT 
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
     
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
     
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    // set values to object properties
    $this->title = $row['title'];
    $this->first_name = $row['first_name'];
    $this->last_name = $row['last_name'];
    $this->email_address = $row['email_address'];
    $this->start_date = $row['start_date'];
    $this->end_date = $row['end_date'];
    $this->password = $row['password'];
    $this->userGUID = $row['userGUID'];
    $this->user_level = $row['user_level'];
}


    
    // create product
function create(){
     
    // query to insert record
    $query = "INSERT INTO 
                " . $this->table_name . "
            SET 
                title=:title, first_name=:first_name, last_name=:last_name, email_address=:email_address, start_date=:start_date, end_date=:end_date, password=:password, user_level=:user_level";
     
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // posted values
    $this->title=htmlspecialchars(strip_tags($this->title));
    $this->first_name=htmlspecialchars(strip_tags($this->first_name));
    $this->last_name=htmlspecialchars(strip_tags($this->last_name));
    $this->email_address=htmlspecialchars(strip_tags($this->email_address));
    $this->start_date=htmlspecialchars(strip_tags($this->start_date));
    $this->end_date=htmlspecialchars(strip_tags($this->end_date));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->user_level=htmlspecialchars(strip_tags($this->user_level));
 
    // bind values
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':first_name', $this->first_name);
    $stmt->bindParam(':last_name', $this->last_name);
    $stmt->bindParam(':email_address', $this->email_address);
    $stmt->bindParam(':start_date', $this->start_date);
    $stmt->bindParam(':end_date', $this->end_date);
    $stmt->bindParam(':password', $this->password);
    $stmt->bindParam(':user_level', $this->user_level);
     
    // execute query
    if($stmt->execute()){
        return true;
    }else{
        echo "<pre>";
            print_r($stmt->errorInfo());
        echo "</pre>";
 
        return false;
    }
}
 
 // read products
function readAll(){
    // select all query
    $query = "SELECT
                id, title, first_name, last_name,  email_address,  start_date, end_date, password, userGUID, user_level
            FROM
                " . $this->table_name . "
            ORDER BY
                id DESC";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

   
    
}
?>
