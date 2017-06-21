<?php
include_once '../config/database.php';
include_once '../objects/job_status.php';

$database      = new Database();
$db            = $database->getConnection();
$jobStatus     = new JobStatus($db);
$data          = json_decode(file_get_contents("php://input"));
$jobStatus->id = $data->id;
if ($jobStatus->delete()) {
    echo "Job Status removed from System!";
} else {
    echo "Unable to remove Job Status from System!";
}
?>
