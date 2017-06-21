<?php
include_once '../config/database.php';
include_once '../objects/delivery_option.php';

$database           = new Database();
$db                 = $database->getConnection();
$deliveryOption     = new DeliveryOption($db);
$data               = json_decode(file_get_contents("php://input"));
$deliveryOption->id = $data->id;
if ($deliveryOption->delete()) {
    echo "Delivery Option removed from System!";
} else {
    echo "Unable to remove Delivery Option from System!";
}
?>
