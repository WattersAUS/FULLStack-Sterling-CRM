<?php
// include database and object file
include_once '../config/database.php';
include_once '../objects/event.php';

// get database connection
$database               = new Database();
$db                     = $database->getConnection();
$jobStatus              = new Event($db);
$data                   = json_decode(file_get_contents("php://input"));
$Event->id          = $data->id;
$Event->description = $data->description;

if ($jobStatus->create()) {
    echo "Event added to system.";
} else {
    echo "Unable to Event Status for system.";
}
?>
