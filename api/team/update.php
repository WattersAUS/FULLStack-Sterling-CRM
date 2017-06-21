<?php
include_once '../config/database.php';
include_once '../objects/team.php';

$database          = new Database();
$db                = $database->getConnection();
$team              = new Team($db);
$data              = json_decode(file_get_contents("php://input"));
$team->id          = $data->id;
$team->description = $data->description;
if ($team->update()) {
    echo "Team was updated in System.";
} else {
    echo "Unable to update team in System.";
}
?>
