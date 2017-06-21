<?php
include_once '../config/database.php';
include_once '../objects/division.php';

$database              = new Database();
$db                    = $database->getConnection();
$division              = new Division($db);
$data                  = json_decode(file_get_contents("php://input"));
$division->id          = $data->id;
$division->description = $data->description;
if ($division->update()) {
    echo "Division was updated in System.";
} else {
    echo "Unable to update Division in System.";
}
?>
