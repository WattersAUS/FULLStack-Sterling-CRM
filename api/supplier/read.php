<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/supplier.php';
$database = new Database();
$db       = $database->getConnection();
$supplier = new Supplier($db);
$stmt     = $supplier->readAll();
$num      = $stmt->rowCount();
$data     = "";

if ($num>0) {
    $x = 1;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $data .= '{';
        $data .= '"id":"'.$id.'",';
        $data .= '"employee_id":"'.$employee_id.'",';
        $data .= '"name":"'.$name.'",';
        $data .= '"shortname":"'.$shortname.'",';
        $data .= '"companyregno":"'.$companyregno.'",';
        $data .= '"website":"'.$website.'",';
        $data .= '"quote_email":"'.$quote_email.'",';
        $data .= '"experian_score":"'.$experian_score.'",';
        $data .= '"credit_score":"'.$credit_score.'",';
        $data .= '"credit_hard_limit":"'.$credit_hard_limit.'",';
        $data .= '"credit_soft_limit":"'.$credit_soft_limit.'",';
        $data .= '"credit_outstanding":"'.$credit_outstanding.'"';
        $data .= '}';
        $data .= $x<$num ? ',' : '';
        $x++;
    }
}
echo '{"records":['.$data.']}';
?>
