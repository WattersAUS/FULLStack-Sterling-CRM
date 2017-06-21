<?php
include_once '../config/database.php';
include_once '../objects/supplier.php';

$database          = new Database();
$db                = $database->getConnection();
$supplier          = new Supplier($db);
$data              = json_decode(file_get_contents("php://input"));
$supplier->id      = $data->id;
if ($supplier->delete()) {
    echo "Supplier removed from System!";
} else {
    echo "Unable to remove Supplier from System!";
}
?>
