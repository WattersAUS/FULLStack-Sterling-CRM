<?php
include_once '../config/database.php';
include_once '../objects/mot.php';

$database          = new Database();
$db                = $database->getConnection();
$mot              = new mot($db);
$data              = json_decode(file_get_contents("php://input"));
$mot->id          = $data->id;
$mot->asset_id = $data->asset_id;
$mot->due_date = $data->due_date;
$mot->notes = $data->notes;
$mot->booked_date = $data->booked_date;
$mot->booked_garage = $data->booked_garage;
$mot->cost        = $data->cost;
if ($term->update()) {
    echo "MOT was updated in System.";
} else {
    echo "Unable to update MOT in System.";
}
?>
