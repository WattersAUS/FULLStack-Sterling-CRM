<?php
include_once '../config/database.php';
include_once '../objects/event.php';

$database               = new Database();
$db                     = $database->getConnection();
$jobStatus              = new JobStatus($db);
$data                   = json_decode(file_get_contents("php://input"));
$jobStatus->id          = $data->id;
$jobStatus->description = $data->description;
if ($jobStatus->update()) {
    echo "Event was updated in System.";
} else {
    echo "Unable to update Event in System.";
}
?>
