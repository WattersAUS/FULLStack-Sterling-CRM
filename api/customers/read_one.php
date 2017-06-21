<?php 
// include database and object files 
include_once '../config/database.php'; 
include_once '../objects/customers.php'; 
 
// get database connection 
$database = new Database(); 
$db = $database->getConnection();
 
// prepare product object
$customers = new Customers($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));     
 
// set ID property of product to be edited
$customers->id = $data->id;
 
// read the details of product to be edited
$customers->readOne();
 
// create array
$customers_arr[] = array(
    "id" =>  $customers->id,
    "Username" => $customers->Username,
    "First_name" => $customers->First_name,
    "Last_name" => $customers->Last_name,
    "Email" => $customers->Email,
    "Status" => $customers->Status
);
 
// make it json format
print_r(json_encode($customers_arr));
?>