<?php
include_once '../config/database.php';
include_once '../objects/site.php';

$database          = new Database();
$db                = $database->getConnection();
$site              = new Site($db);
$data              = json_decode(file_get_contents("php://input"));
$site->id          = $data->id;
if ($site->delete()) {
    echo "Site removed from System!";
} else {
    echo "Unable to remove Site from System!";
}
?>
