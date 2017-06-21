<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/mot.php';
$database = new Database();
$db       = $database->getConnection();
$mot     = new mot($db);
$stmt     = $mot->readAll();
$num      = $stmt->rowCount();
$data     = "";

if ($num>0) {
    $x = 1;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $data .= '{';
        $data .= '"id":"'.$id.'",';
        $data .= '"asset_id":"'.$asset_id.'",';
        $data .= '"due_date":"'.$due_date.'",';
        $data .= '"notes":"'.$notes.'",';
        $data .= '"booked_date":"'.$booked_date.'",';
        $data .= '"booked_garage":"'.$booked_garage.'",';
        $data .= '"cost":"'.$cost.'"';
        $data .= '}';
        $data .= $x<$num ? ',' : '';
        $x++;
    }
}
echo '{"records":['.$data.']}';
?>
