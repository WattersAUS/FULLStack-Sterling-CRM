<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/job_history.php';

$data     = json_decode(file_get_contents("php://input"));
$database = new Database();
$db       = $database->getConnection();
$jh       = new JobHistory($db);
$json     = $jh->getJobHistoryForJobFirstRecord($data->job_history_job_id);
echo($json);
?>
