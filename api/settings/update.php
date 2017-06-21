<?php
include_once '../config/database.php';
include_once '../objects/settings.php';

$database                         = new Database();
$db                               = $database->getConnection();
$settings                         = new Settings($db);
$data                             = json_decode(file_get_contents("php://input"));
$settings->id                     = $data->id;
$settings->companyName            = $data->companyName;
$settings->shortName              = $data->shortName;
$settings->companyRegNo           = $data->companyRegNo;
$settings->webSite                = $data->webSite;
$settings->defaultEmail           = $data->defaultEmail;
$settings->address1               = $data->address1;
$settings->address2               = $data->address2;
$settings->city                   = $data->city;
$settings->county                 = $data->county;
$settings->postcode               = $data->postcode;
$settings->telephoneNumber        = $data->telephoneNumber;
$settings->vatRate                = $data->vatRate;
$settings->defaultKPIQuoteRtndBy  = $data->defaultKPIQuoteRtndBy;
$settings->defaultCreditHardLimit = $data->defaultCreditHardLimit;
$settings->defaultCreditSoftLimit = $data->defaultCreditSoftLimit;
if ($settings->update()) {
    echo "System Settings were updated.";
} else {
    echo "Unable to update System Settings.";
}
?>
