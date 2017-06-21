<?php
// include database and object file
include_once '../config/database.php';
include_once '../objects/customers.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$customers = new Customers($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$customers->Username = $data->Username;
$customers->First_name = $data->First_name;
$customers->Last_name = $data->Last_name;
$customers->Email = $data->Email;
$customers->Status = $data->Status;

// create the product
if($customers->create()){
    echo "Customer was created.";
}
 
// if unable to create the product, tell the user
else{
    echo "Unable to create customer.";
}
?>