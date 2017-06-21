<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/work_option.php';

$database   = new Database();
$db         = $database->getConnection();
$workoption = new WorkOption($db);
$stmt       = $workoption->readAll();
$num        = $stmt->rowCount();
$data       = "";

if ($num>0) {
    $x = 1;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $data .= '{';
        $data .= '"id":"'.$id.'",';
        $data .= '"category_id":"'.$category_id.'",';
        $data .= '"code":"'.$code.'",';
        $data .= '"description":"'.$description.'",';
        $data .= '"default_pricing":"'.$default_pricing.'"';
        $data .= '}';
        $data .= $x<$num ? ',' : '';
        $x++;
    }
}
echo '{"records":['.$data.']}';
?>
