<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/site.php';

$data                   = json_decode(file_get_contents("php://input"));
$database               = new Database();
$db                     = $database->getConnection();
$site                   = new Site($db);
$site->site_customer_id = $data->site_customer_id;
$site->site_name        = $data->site_name;
$site->site_shortname   = $data->site_shortname;
$site->site_address1    = $data->site_address1;
$site->site_address2    = $data->site_address2;
$site->site_city        = $data->site_city;
$site->site_county      = $data->site_county;
$site->site_postcode    = $data->site_postcode;
$json                   = $site->insertSite();
echo($json);
?>
