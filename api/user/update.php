<?php 
// include database and object files 
include_once '../config/database.php'; 
include_once '../objects/user.php'; 
 
// get customers connection 
$database = new Database(); 
$db = $database->getConnection();
 
// prepare product object
$user = new User($db);
 
// get id of customers to be edited
$data = json_decode(file_get_contents("php://input"));     
 
// set ID property of customers to be edited
$user->id = $data->id;
 
// set product property values
$user->title = $data->title;
$user->first_name = $data->first_name;
$user->last_name = $data->last_name;
$user->email_address = $data->email_address;
$user->start_date = $data->start_date;
$user->end_date = $data->end_date;
$user->password = $data->password;
$user->user_level = $data->user_level;
 
// update the product
if($user->update()){
    echo "user was updated.";
}
 
// if unable to update the product, tell the user
else{
    echo "Unable to update user.";
}
?>