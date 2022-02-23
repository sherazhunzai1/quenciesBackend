<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    
 if(isset($_GET['order_id'])) {
      $order_id=$_GET['order_id'];
       
       
   include_once '../../config/Database.php';
    include_once '../../models/Orders.php';

 
$database = new Database();
$db = $database->connect();

  
//$nfts = new Nfts($db);
 $Orders = new Orders($db);
   
    // Category read query
   
      $feature = $Orders-> orderDetails($order_id);

$cat_arr=array();
            
 $cat_arr['getOrderDetails'] = array();
           
  
   while ($row = $feature->fetch(PDO::FETCH_ASSOC)) {
      
        
       $cat_item=array(
           "order_id"=>$row['order_id'],
           "order_number"=>$row['order_number'],
           "order_total_amount"=>$row['order_total_amount'],
          "transaction_id"=>$row['transaction_id'],
          "card_cvc"=>$row['card_cvc'],
          "card_expiry_month "=>$row['card_expiry_month'],
          "card_holder_number"=>$row['card_holder_number'],
          "email_address"=>$row['email_address'],
          "customer_name"=>$row['customer_name'],
           "customer_address"=>$row['customer_address'],
            "customer_city"=>$row['customer_city'],
           "customer_pin"=>$row['customer_pin'],
          "customer_state"=>$row['customer_state'],
           "customer_country"=>$row['customer_country'],
            "order_itemId"=>$row['order_itemId'],
           "orderID"=>$row['orderID'],
           "order_item_rca_id"=>$row['order_item_rca_id'],
           "order_itemQuantity"=>$row['order_itemQuantity'],
          "order_price"=>$row['order_price'],
           "total_amount "=>$row['total_amount'],
          "created_at "=>$row['created_at'],
          "RCA_title "=>$row['title']
           );

      // Push to "data"
    array_push($cat_arr['getOrderDetails'], $cat_item);
  } 
   echo json_encode($cat_arr);
 }
   else{
        
         echo json_encode(http_response_code(401));
}


   