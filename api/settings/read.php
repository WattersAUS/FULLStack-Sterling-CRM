<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/settings.php';
$database     = new Database();
$db           = $database->getConnection();
$settings     = new Settings($db);
$settings->id = 1;
$settings->readOne();
$data  = "";
$data .= '{';
$data .= '"id":"'.$settings->id.'",';
$data .= '"companyName":"'.$settings->companyName.'",';
$data .= '"shortName":"'.$settings->shortName.'",';
$data .= '"companyRegNo":"'.$settings->companyRegNo.'",';
$data .= '"webSite":"'.$settings->webSite.'",';
$data .= '"defaultEmail":"'.$settings->defaultEmail.'",';
$data .= '"address1":"'.$settings->address1.'",';
$data .= '"address2":"'.$settings->address2.'",';
$data .= '"city":"'.$settings->city.'",';
$data .= '"county":"'.$settings->county.'",';
$data .= '"postcode":"'.$settings->postcode.'",';
$data .= '"telephoneNumber":"'.$settings->telephoneNumber.'",';
$data .= '"vatRate":"'.$settings->vatRate.'",';
$data .= '"defaultKPIQuoteRtndBy":"'.$settings->defaultKPIQuoteRtndBy.'",';
$data .= '"defaultCreditHardLimit":"'.$settings->defaultCreditHardLimit.'",';
$data .= '"defaultCreditSoftLimit":"'.$settings->defaultCreditSoftLimit.'",';
$data .= '"dateUpdated":"'.$settings->dateUpdated.'"';
$data .= '}';

echo '{"records":['.$data.']}';
?>