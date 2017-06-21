<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/site.php';
$database = new Database();
$db       = $database->getConnection();
$site     = new Site($db);
$stmt     = $site->readAll();
$num      = $stmt->rowCount();
$data     = "";

if ($num>0) {
    $x = 1;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $data .= '{';
        $data .= '"id":"'.$id.'",';
        $data .= '"customerId":"'.$customer_id.'",';
        $data .= '"name":"'.$name.'",';
        $data .= '"shortName":"'.$shortname.'",';
        $data .= '"address1":"'.$address1.'",';
        $data .= '"address2":"'.$address2.'",';
        $data .= '"city":"'.$city.'",';
        $data .= '"county":"'.$county.'",';
        $data .= '"postcode":"'.$postcode.'",';
        $data .= '"customerName":"'.$customer_name.'"';
        $data .= '}';
        $data .= $x<$num ? ',' : '';
        $x++;
    }
}
echo '{"records":['.$data.']}';
?>
