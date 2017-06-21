<?php 
// include database and object files 
include_once '../config/database.php'; 
include_once '../objects/user.php'; 
 
// get database connection 
$database = new Database(); 
$db = $database->getConnection();
 
// prepare product object
$user = new User($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));     
 
// set ID property of product to be edited
$user->id = $data->id;
 
// read the details of product to be edited
$user->readOne();
 
// create array
$user_arr[] = array(
    "id" =>  $user->id,
    "title" => $user->title,
    "first_name" => $user->first_name,
    "last_name" => $user->last_name,
    "email_address" => $user->email_address,
    "start_date" => $user->start_date,
    "end_date" => $user->end_date,
    "password" => $user->password,
    "user_level" => $user->user_level
);
 
// make it json format
print_r(json_encode($user_arr));
?>