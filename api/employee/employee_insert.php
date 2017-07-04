<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/employee.php';

$data                           = json_decode(file_get_contents("php://input"));
$database                       = new Database();
$db                             = $database->getConnection();
$employee                       = new Employee($db);
$employee->employee_user_id     = $data->employee_user_id;
$employee->employee_is_manager  = $data->employee_is_manager;
$employee->employee_reports     = $data->employee_reports;
$employee->employee_emp_no      = $data->employee_emp_no;
$employee->employee_job_title   = $data->employee_job_title;
$employee->employee_job_role    = $data->employee_job_role;
$employee->employee_manager_id  = $data->employee_manager_id;
$employee->employee_division_id = $data->employee_division_id;
$employee->employee_team_id     = $data->employee_team_id;
$json                           = $employee->insertEmployee();
echo($json);
?>
