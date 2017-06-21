<?php
include_once '../config/database.php';
include_once '../objects/team.php';

$database = new Database();
$db       = $database->getConnection();
$team     = new Team($db);
$data     = json_decode(file_get_contents("php://input"));
$team->id = $data->id;
$team->readOne();

$team_arr[] = array(
    "id"          => $team->id,
    "description" => $team->description
);
print_r(json_encode($team_arr));
?>
