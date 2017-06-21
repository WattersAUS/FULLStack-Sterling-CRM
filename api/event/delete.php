<?php
include_once '../config/database.php';
include_once '../objects/event.php';

$database      = new Database();
$db            = $database->getConnection();
$jobStatus     = new Event($db);
$data          = json_decode(file_get_contents("php://input"));
$jobStatus->id = $data->id;
if ($Event->delete()) {
    echo "Event removed from System!";
} else {
    echo "Unable to remove Event from System!";
}
?>
