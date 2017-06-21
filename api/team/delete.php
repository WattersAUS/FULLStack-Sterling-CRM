<?php
include_once '../config/database.php';
include_once '../objects/team.php';

$database          = new Database();
$db                = $database->getConnection();
$team              = new Team($db);
$data              = json_decode(file_get_contents("php://input"));
$team->id          = $data->id;
if ($team->delete()) {
    echo "Team removed from System!";
} else {
    echo "Unable to remove Team from System!";
}
?>
