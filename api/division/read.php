<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/division.php';
$database = new Database();
$db       = $database->getConnection();
$division = new Division($db);
$stmt     = $division->readAll();
$num      = $stmt->rowCount();
$data     = "";

if ($num>0) {
    $x = 1;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $data .= '{';
        $data .= '"id":"'.$id.'",';
        $data .= '"description":"'.$description.'"';
        $data .= '}';
        $data .= $x<$num ? ',' : '';
        $x++;
    }
}
echo '{"records":['.$data.']}';
?>
