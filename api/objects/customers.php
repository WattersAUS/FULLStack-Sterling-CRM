<?php
class Customers{
    // database connection and table name
    private $conn;
    private $table_name = "customers";

    // object properties
    public $id;
    public $Username;
    public $First_name;
    public $Last_name;
    public $Email;
    public $Status;

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
                Username = :Username,
                First_name = :First_name,
                Last_name = :Last_name,
                Email = :Email,
                Status = :Status
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->Username=htmlspecialchars(strip_tags($this->Username));
    $this->First_name=htmlspecialchars(strip_tags($this->First_name));
    $this->Last_name=htmlspecialchars(strip_tags($this->Last_name));
    $this->Email=htmlspecialchars(strip_tags($this->Email));
    $this->Status=htmlspecialchars(strip_tags($this->Status));
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind new values
    $stmt->bindParam(':Status', $this->Status);
    $stmt->bindParam(':Email', $this->Email);
    $stmt->bindParam(':Last_name', $this->Last_name);
    $stmt->bindParam(':First_name', $this->First_name);
    $stmt->bindParam(':Username', $this->Username);
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
                Username, First_name, Last_name,  Email,  Status
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
    $this->Username = $row['Username'];
    $this->First_name = $row['First_name'];
    $this->Last_name = $row['Last_name'];
    $this->Email = $row['Email'];
    $this->Status = $row['Status'];
}


    
    // create product
function create(){
     
    // query to insert record
    $query = "INSERT INTO 
                " . $this->table_name . "
            SET 
                Username=:Username, First_name=:First_name, Last_name=:Last_name, Email=:Email, Status=:Status";
     
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // posted values
    $this->Username=htmlspecialchars(strip_tags($this->Username));
    $this->First_name=htmlspecialchars(strip_tags($this->First_name));
    $this->Last_name=htmlspecialchars(strip_tags($this->Last_name));
    $this->Email=htmlspecialchars(strip_tags($this->Email));
    $this->Status=htmlspecialchars(strip_tags($this->Status));
 
    // bind values
    $stmt->bindParam(':Status', $this->Status);
    $stmt->bindParam(':Email', $this->Email);
    $stmt->bindParam(':Last_name', $this->Last_name);
    $stmt->bindParam(':First_name', $this->First_name);
    $stmt->bindParam(':Username', $this->Username);
     
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
                id, Username, First_name, Last_name,  Email,  Status
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
