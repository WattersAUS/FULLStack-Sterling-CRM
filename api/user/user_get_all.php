<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/user.php';

$database = new Database();
$db       = $database->getConnection();
$user     = new User($db);
$json     = $user->getAllUsers();
echo($json);
?>
