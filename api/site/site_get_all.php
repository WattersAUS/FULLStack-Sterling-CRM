<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/site.php';

$database = new Database();
$db       = $database->getConnection();
$site     = new Site($db);
$json     = $site->getAllSites();
echo($json);
?>
