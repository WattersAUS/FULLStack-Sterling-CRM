<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/employee.php';

$database = new Database();
$db       = $database->getConnection();
$employee = new Employee($db);
$json     = $employee->getAllEmployees();
echo($json);
?>
