<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/customer.php';

$data                                    = json_decode(file_get_contents("php://input"));
$database                                = new Database();
$db                                      = $database->getConnection();
$customer                                = new Customer($db);
$customer->customer_employee_id          = $data->customer_employee_id;
$customer->customer_name                 = $data->customer_name;
$customer->customer_shortname            = $data->customer_shortname;
$customer->customer_type                 = $data->customer_type;
$customer->customer_companyregno         = $data->customer_companyregno;
$customer->customer_website              = $data->customer_website;
$customer->customer_quote_email          = $data->customer_quote_email;
$customer->customer_kpi_quote_rtnd_by    = $data->customer_kpi_quote_rtnd_by;
$customer->customer_experian_score       = $data->customer_experian_score;
$customer->customer_credit_score         = $data->customer_credit_score;
$customer->customer_credit_hard_limit    = $data->customer_credit_hard_limit;
$customer->customer_credit_soft_limit    = $data->customer_credit_soft_limit;
$customer->customer_credit_outstanding   = $data->customer_credit_outstanding;
$customer->customer_terms_id             = $data->customer_terms_id;
$customer->customer_kpi_agreed           = $data->customer_kpi_agreed;
$customer->customer_quote_breakdown_rqrd = $data->customer_quote_breakdown_rqrd;
$customer->customer_quote_rtn_trigger    = $data->customer_quote_rtn_trigger;
$customer->customer_days_to_review       = $data->customer_days_to_review;
$json                                    = $customer->insertCustomer();
echo($json);
?>
