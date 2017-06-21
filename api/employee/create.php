<?php
// include database and object file
include_once '../config/database.php';
include_once '../objects/employee.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$employee = new Employee($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$employee->division_id = $data->division_id;
$employee->emp_no = $data->emp_no;
$employee->is_manager = $data->is_manager;
$employee->job_role = $data->job_role;
$employee->job_title = $data->job_title;
$employee->manager_id = $data->manager_id;
$employee->team_id = $data->team_id;
$employee->user_id = $data->user_id;
 
// create the product
if($product->create()){
    echo "Employee was created.";
}
 
// if unable to create the employee, tell the user
else{
    echo "Unable to create employee.";
}
?>