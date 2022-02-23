<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    
 if(isset($_GET['order_id'])) {
   $order_id=$_GET['order_id'];
       
   include_once '../../config/Database.php';
    include_once '../../models/contants.php';
    include_once '../../models/order.php';

  
$database = new Database();
$db = $database->connect();

  
//$nfts = new Nfts($db);
 $Orders = new Orders($db);
   
    // Category read query
   
      $feature = $Orders->delete($order_id);
if($feature){
 echo json_encode("Item deleted");
 header('Location:'.base_url.'admin/view/dashboard.php'); exit();
 }

  
   else{
        
        http_response_code(400);


}}
   