<?php
include_once '../config/database.php';
include_once '../objects/supplier.php';

$database = new Database();
$db       = $database->getConnection();
$supplier = new Supplier($db);
$data     = json_decode(file_get_contents("php://input"));
$supplier->id = $data->id;
$supplier->readOne();

$supplier_arr[] = array(
    "id"                 => $supplier->id,
    "employee_id"        => $supplier->employee_id,
    "name"               => $supplier->name,
    "shortname"          => $supplier->shortname,
    "companyregno"       => $supplier->companyregno,
    "website"            => $supplier->website,
    "quote_email"        => $supplier->quote_email,
    "experian_score"     => $supplier->experian_score,
    "credit_score"       => $supplier->credit_score,
    "credit_hard_limit"  => $supplier->credit_hard_limit,
    "credit_soft_limit"  => $supplier->credit_soft_limit,
    "credit_outstanding" => $supplier->credit_outstanding
);
print_r(json_encode($supplier_arr));
?>
