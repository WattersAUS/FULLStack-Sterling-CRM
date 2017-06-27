<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/site.php';

$data     = json_decode(file_get_contents("php://input"));
$database = new Database();
$db       = $database->getConnection();
$site     = new Site($db);
$json     = $site->getSiteByID($data->site_id);
echo($json);
?>
