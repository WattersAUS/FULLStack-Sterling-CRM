<?php
include_once '../config/database.php';
include_once '../objects/job_status.php';

$database               = new Database();
$db                     = $database->getConnection();
$jobStatus              = new JobStatus($db);
$data                   = json_decode(file_get_contents("php://input"));
$jobStatus->id          = $data->id;
$jobStatus->description = $data->description;
if ($jobStatus->update()) {
    echo "Job Status was updated in System.";
} else {
    echo "Unable to update Job Status in System.";
}
?>
