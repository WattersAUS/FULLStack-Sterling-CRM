<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/employee.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$employee = new Employee($db);
 
// query employee
$stmt = $employee->readAll();
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
            $data .= '"division_id":"'   . $division_id . '",';
            $data .= '"emp_no":"'   . $emp_no . '",';
            $data .= '"is_manager":"' . $is_manager . '"';
            $data .= '"job_role":"' . $job_role . '"';
            $data .= '"job_title":"' . $job_title . '"';
            $data .= '"manager_id":"' . $manager_id . '"';
            $data .= '"team_id":"' . $team_id . '"';
            $data .= '"user_id":"' . $user_id . '"';
        $data .= '}';
 
        $data .= $x<$num ? ',' : '';
 
        $x++;
    }
}
 
// json format output
echo '{"records":[' . $data . ']}';
?>