<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/site_contact.php';

$data        = json_decode(file_get_contents("php://input"));
$database    = new Database();
$db          = $database->getConnection();
$siteContact = new SiteContact($db);
$json        = $siteContact->getSiteContactsForSite($data->site_id);
echo($json);
?>
