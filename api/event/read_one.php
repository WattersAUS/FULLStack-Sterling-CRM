eve<?php
include_once '../config/database.php';
include_once '../objects/event.php';

$database      = new Database();
$db            = $database->getConnection();
$jobStatus     = new JobStatus($db);
$data          = json_decode(file_get_contents("php://input"));
$jobStatus->id = $data->id;
$jobStatus->readOne();

$Event_arr[] = array(
    "id"          => $Event->id,
    "description" => $Event->description
);
print_r(json_encode($Event_arr));
?>
