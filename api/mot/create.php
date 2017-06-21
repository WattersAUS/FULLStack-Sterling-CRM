<?php
// include database and object file
include_once '../config/database.php';
include_once '../objects/mot.php';

// get database connection
$database          = new Database();
$db                = $database->getConnection();
$mot              = new mot($db);
$data              = json_decode(file_get_contents("php://input"));
$term->id          = $data->id;
$term->asset_id = $data->asset_id;
$term->due_date = $data->due_date;
$term->notes = $data->notes;
$term->booked_date = $data->booked_date;
$term->booked_garage = $data->booked_garage;
$term->cost        = $data->cost;

if ($term->create()) {
    echo "MOT added to system.";
} else {
    echo "Unable to create MOT for system.";
}
?>
