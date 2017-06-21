<?php
include_once '../config/database.php';
include_once '../objects/settings.php';

$database = new Database();
$db       = $database->getConnection();
$settings = new Settings($db);
$data     = json_decode(file_get_contents("php://input"));
$settings->id = 1;
$settings->readOne();
$settings_arr[] = array(
    "id"                     => $settings->id,
    "companyName"            => $settings->companyName,
    "shortName"              => $settings->shortName,
    "companyRegNo"           => $settings->companyRegNo,
    "webSite"                => $settings->webSite,
    "defaultEmail"           => $settings->defaultEmail,
    "address1"               => $settings->address1,
    "address2"               => $settings->address2,
    "city"                   => $settings->city,
    "county"                 => $settings->county,
    "postcode"               => $settings->postcode,
    "telephoneNumber"        => $settings->telephoneNumber,
    "vatRate"                => $settings->vatRate,
    "defaultKPIQuoteRtndBy"  => $settings->defaultKPIQuoteRtndBy,
    "defaultCreditHardLimit" => $settings->defaultCreditHardLimit,
    "defaultCreditSoftLimit" => $settings->defaultCreditSoftLimit,
    "dateUpdated"            => $settings->dateUpdated
);
print_r(json_encode($settings_arr));
?>
