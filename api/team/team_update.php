<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/team.php';

$data                    = json_decode(file_get_contents("php://input"));
$database                = new Database();
$db                      = $database->getConnection();
$team                    = new Team($db);
$team->team_id          = $data->team_id;
$team->team_description = $data->team_description;
$json                    = $team->updateTeam();
echo($json);
?>
