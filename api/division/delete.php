<?php
include_once '../config/database.php';
include_once '../objects/division.php';

$database     = new Database();
$db           = $database->getConnection();
$division     = new Division($db);
$data         = json_decode(file_get_contents("php://input"));
$division->id = $data->id;
if ($division->delete()) {
    echo "Division removed from System!";
} else {
    echo "Unable to remove Division from System!";
}
?>
