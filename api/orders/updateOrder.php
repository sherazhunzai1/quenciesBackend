<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers

   include_once '../../config/Database.php';
    include_once '../../models/order.php';
    include_once '../../models/contants.php';
   
     if(isset($_POST['customer_name']) && isset($_POST['phoneNo']) && isset($_POST['customer_city']) && isset($_POST['customer_state']) && isset($_POST['customer_address']) && isset($_POST['order_id'])){
         

         $customer_name=$_POST['customer_name'];
         $phoneNo=$_POST['phoneNo'];
         $customer_city=$_POST['customer_city'];
         $customer_state=$_POST['customer_state'];
         $customer_address=$_POST['customer_address'];
         $order_id=$_POST['order_id'];
        //  $rca_id=$_POST['rca_id'];
         
    // Headers

  

  
$database = new Database();
$db = $database->connect();

  
//$nfts = new Nfts($db);
 $Orders = new Orders($db);
   
    // Category read query
   
      $result = $Orders->updateOrderDeatils($customer_name,$phoneNo,$customer_city,$customer_state,$customer_address, $order_id);

   
     if($result){
         
        //  $order_id = $db->lastInsertId();
         
         http_response_code(201);
         echo json_encode(array(
             "message" => 'order details updated'
             ));
          exit();
     }
     else{
         
         http_response_code(400);
        //  header("location:". BASE_URL ."buyrca/".$rca_id."");
     }
  
     }
  
  
  else{
        http_response_code(400);
        //  header("location:". BASE_URL ."buyrca/".$rca_id."");
}


   