<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/team.php';

$database = new Database();
$db       = $database->getConnection();
$team     = new Team($db);
$json     = $team->getAllTeams();
echo($json);
?>
