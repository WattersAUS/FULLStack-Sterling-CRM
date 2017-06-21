<?php 
// include database and object files 
include_once '../config/database.php'; 
include_once '../objects/customers.php'; 
 
// get customers connection 
$database = new Database(); 
$db = $database->getConnection();
 
// prepare product object
$customers = new Customers($db);
 
// get id of customers to be edited
$data = json_decode(file_get_contents("php://input"));     
 
// set ID property of customers to be edited
$customers->id = $data->id;
 
// set product property values
$customers->Username = $data->Username;
$customers->First_name = $data->First_name;
$customers->Last_name = $data->Last_name;
$customers->Email = $data->Email;
$customers->Status = $data->Status;
 
// update the product
if($customers->update()){
    echo "Customer was updated.";
}
 
// if unable to update the product, tell the user
else{
    echo "Unable to update customer.";
}
?>