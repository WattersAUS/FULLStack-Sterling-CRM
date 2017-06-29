<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/user.php';

$data                     = json_decode(file_get_contents("php://input"));
$database                 = new Database();
$db                       = $database->getConnection();
$user                     = new User($db);
$user->user_title         = $data->user_title;
$user->user_first_name    = $data->user_first_name;
$user->user_last_name     = $data->user_last_name;
$user->user_email_address = $data->user_email_address;
$user->user_password      = $data->user_password;
$user->user_level         = $data->user_level;
$json                     = $user->insertUser();
echo($json);
?>
