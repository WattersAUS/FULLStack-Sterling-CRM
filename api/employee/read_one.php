<?php 
// include database and object files 
include_once '../config/database.php'; 
include_once '../objects/employee.php'; 
 
// get database connection 
$database = new Database(); 
$db = $database->getConnection();
 
// prepare product object
$employee = new Product($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));     
 
// set ID property of product to be edited
$employee->id = $data->id;
 
// read the details of product to be edited
$employee->readOne();
 
// create array
$employee_arr[] = array(
    "id" =>  $employee->id,
    "division_id" => $employee->division_id,
    "emp_no" => $employee->emp_no,
    "is_manager" => $employee->is_manager,
    "job_role" => $employee->job_role,
    "job_title" => $employee->job_title,
    "manager_id" => $employee->manager_id,
    "team_id" => $employee->team_id,
    "user_id" => $employee->user_id
);
 
// make it json format
print_r(json_encode($employee_arr));
?>