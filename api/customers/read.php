<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/customers.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$customers = new Customers($db);
 
// query customers
$stmt = $customers->readAll();
$num = $stmt->rowCount();
 
$data="";
 
// check if more than 0 record found
if($num>0){
 
     
    $x=1;
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $data .= '{';
            $data .= '"id":"'  . $id . '",';
            $data .= '"Username":"'   . $Username . '",';
            $data .= '"First_name":"'   . $First_name . '",';
            $data .= '"Last_name":"' . $Last_name . '",';
            $data .= '"Email":"' . $Email . '",';
            $data .= '"Status":"' . $Status . '"';
        $data .= '}';
 
        $data .= $x<$num ? ',' : '';
 
        $x++;
    }
}
 
// json format output
echo '{"records":[' . $data . ']}';
?>
