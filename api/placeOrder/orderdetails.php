<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    
 if(isset($_GET['order_id'])) {
      $order_id=$_GET['$order_id'];
       
    include_once '../../config/Database.php';
    include_once '../../models/PlaceOrder.php';
  
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $PlaceOrder = new PlaceOrder($db);
   
    // Category read query
   
      $feature = $PlaceOrder->orderDetails($order_id);


           
  
 $row = $feature->fetch(PDO::FETCH_ASSOC);
        
       $cat_arr=array(
           "order_itemId"=>$row['order_itemId'],
           "title"=>$row['title'],
           "order_item_rca_id"=>$row['order_item_rca_id'],
           "order_id"=>$row['order_id'],
          "order_price"=>$row['order_price'],
          "total_amount"=>$row['total_amount'],
           "order_itemQuantity"=>$row['order_itemQuantity'],
    
           
           );

  

    
 echo json_encode($cat_arr);
 }
  
   else{
        
         echo json_encode(http_response_code(401));
}


   