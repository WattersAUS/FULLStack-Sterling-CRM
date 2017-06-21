<?php
include_once '../config/database.php';
include_once '../objects/supplier.php';

$database         = new Database();
$db               = $database->getConnection();
$supplier         = new Supplier($db);
$data             = json_decode(file_get_contents("php://input"));

$supplier->id         = $data->id;
$supplier->employee_id        = $data->employee_id;
$supplier->name               = $data->name;
$supplier->shortname          = $data->shortname;
$supplier->companyregno       = $data->companyregno;
$supplier->website            = $data->website;
$supplier->quote_email        = $data->quote_email;
$supplier->experian_score     = $data->experian_score;
$supplier->credit_score       = $data->credit_score;
$supplier->credit_hard_limit  = $data->credit_hard_limit;
$supplier->credit_soft_limit  = $data->credit_soft_limit;
$supplier->credit_outstanding = $data->credit_outstanding;

if ($supplier->update()) {
    echo "Supplier was updated in System.";
} else {
    echo "Unable to update Supplier in System.";
}
?>
