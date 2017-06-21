<?php
// include database and object file
include_once '../config/database.php';
include_once '../objects/team.php';

// get database connection
$database          = new Database();
$db                = $database->getConnection();
$team              = new Team($db);
$data              = json_decode(file_get_contents("php://input"));
$team->id          = $data->id;
$team->description = $data->description;

if ($team->create()) {
    echo "Team added to system.";
} else {
    echo "Unable to create Term for system.";
}
?>
