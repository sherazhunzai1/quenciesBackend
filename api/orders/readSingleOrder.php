<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    
 if(isset($_GET['order_id'])) {
     
      $order_id=$_GET['order_id'];
       
   include_once '../../config/Database.php';
   include_once '../../models/order.php';

  
$database = new Database();
$db = $database->connect();

 
//$nfts = new Nfts($db);
 $Orders = new Orders($db);
    
    // Category read query
//   exit();
      $result = $Orders->getsingleDetail($order_id);

//   $cat_arr=array();
            // exit();
//  $cat_arr['getOrderDetails'] = array();
           
  
  $row = $result->fetch(PDO::FETCH_ASSOC);
        
       $cat_item=array(
           "order_id"=>$row['order_id'],
          "customer_name"=>$row['customer_name'],
          "phoneNo"=>$row['phoneNo'],
           "customer_city"=>$row['customer_city'],
          "customer_state"=>$row['customer_state'],
          "customer_address"=>$row['customer_address'],
          "zip"=>$row['zip'],
          "rca_id"=>$row['rca_id'],
          "rcaName"=>$row['title'],
          "rcaPrice"=>$row['price'],
          "description"=>$row['description']
          
            
           );

      // Push to "data"

   echo json_encode($cat_item);
   exit();
}
   else{
        
         http_response_code(400);
}


   