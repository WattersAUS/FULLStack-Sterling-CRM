<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/job.php';

$data     = json_decode(file_get_contents("php://input"));
$database = new Database();
$db       = $database->getConnection();
$job      = new Job($db);
$json     = $job->getJobsForCustomer($data->customer_id);
echo($json);
?>
