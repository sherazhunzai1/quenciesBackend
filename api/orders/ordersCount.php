<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

  include_once '../../config/Database.php';
   include_once '../../models/order.php';

  
$database = new Database();
$db = $database->connect();

  
//$nfts = new Nfts($db);
 $Orders = new Orders($db);

$result = $Orders->  total_getAllOrder();


//row count
$num = $result->rowCount();
header("Status: 200 OK");
            
echo json_encode(array(
                    "total"=>$num
                    ));
exit();

?>