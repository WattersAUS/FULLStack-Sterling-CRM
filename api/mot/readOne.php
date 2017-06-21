<?php
include_once '../config/database.php';
include_once '../objects/mot.php';

$database = new Database();
$db       = $database->getConnection();
$mot     = new mot($db);
$data     = json_decode(file_get_contents("php://input"));
$term->id = $data->id;
$term->readOne();

$term_arr[] = array(
    "id"          => $mot->id,
    "asset_id" => $mot->asset_id,
    "due_date" => $mot->due_date,
    "notes" => $mot->notes,
    "booked_date" => $mot->booked_date,
    "booked_garage" => $mot->booked_garage,
    "cost"        => $mot->cost
);
print_r(json_encode($term_arr));
?>
