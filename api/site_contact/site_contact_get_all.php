<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/site_contact.php';

$database    = new Database();
$db          = $database->getConnection();
$siteContact = new SiteContact($db);
$json        = $siteContact->getAllSiteContacts();
echo($json);
?>
