<?php
// include database and object file
include_once '../config/database.php';
include_once '../objects/job_status.php';

// get database connection
$database               = new Database();
$db                     = $database->getConnection();
$jobStatus              = new JobStatus($db);
$data                   = json_decode(file_get_contents("php://input"));
$jobStatus->id          = $data->id;
$jobStatus->description = $data->description;
$jobStatus->template_page = $data->template_page;

if ($jobStatus->create()) {
    echo "Job Status added to system.";
} else {
    echo "Unable to create Job Status for system.";
}
?>
