<?php
include_once '../config/database.php';
include_once '../objects/mot.php';

$database          = new Database();
$db                = $database->getConnection();
$mot              = new mot($db);
$data              = json_decode(file_get_contents("php://input"));
$term->id          = $data->id;
if ($term->delete()) {
    echo "MOT removed from System!";
} else {
    echo "Unable to remove MOT from System!";
}
?>
