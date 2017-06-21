<?php 
// include database and object files 
include_once '../config/database.php'; 
include_once '../objects/employee.php'; 
 
// get database connection 
$database = new Database(); 
$db = $database->getConnection();
 
// prepare employee object
$employee = new Employee($db);
 
// get id of employee to be edited
$data = json_decode(file_get_contents("php://input"));     
 
// set ID employee of product to be edited
$employee->id = $data->id;
 
// set employee property values
$employee->division_id = $data->division_id;
$employee->emp_no = $data->emp_no;
$employee->is_manager = $data->is_manager;
$employee->job_role = $data->job_role;
$employee->job_title = $data->job_title;
$employee->manager_id = $data->manager_id;
$employee->team_id = $data->team_id;
$employee->user_id = $data->user_id;
 
// update the employee
if($employee->update()){
    echo "Employee was updated.";
}
 
// if unable to update the employee, tell the user
else{
    echo "Unable to update employee.";
}
?>