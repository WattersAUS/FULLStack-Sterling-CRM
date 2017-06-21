<?php
// include database and object file
include_once '../config/database.php';
include_once '../objects/division.php';

// get database connection
$database              = new Database();
$db                    = $database->getConnection();
$division              = new Division($db);
$data                  = json_decode(file_get_contents("php://input"));
$division->id          = $data->id;
$division->description = $data->description;

if ($division->create()) {
    echo "Division added to system.";
} else {
    echo "Unable to create Division for system.";
}
?>
