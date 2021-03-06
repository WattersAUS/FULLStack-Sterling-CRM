<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/job_status.php';

$data     = json_decode(file_get_contents("php://input"));
$database = new Database();
$db       = $database->getConnection();
$js       = new JobStatus($db);
$json     = $js->getJobStatusByID($data->job_status_id);
echo($json);
?>
