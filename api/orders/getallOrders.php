<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers

   include_once '../../config/Database.php';
    include_once '../../models/Orders.php';

  
$database = new Database();
$db = $database->connect();

  
//$nfts = new Nfts($db);
 $Orders = new Orders($db);
   
    // Category read query
   
      $feature = $Orders->getAllOrder();

$cat_arr=array();
            
 $cat_arr['getallOrders'] = array();
           
  
   while ($row = $feature->fetch(PDO::FETCH_ASSOC)) {
        
       $cat_item=array(
           "order_id"=>$row['order_id'],
        //   "order_number"=>$row['order_number'],
           "order_total_amount"=>$row['order_total_amount'],
        //   "transaction_id"=>$row['transaction_id'],
        //   "card_cvc"=>$row['card_cvc'],
        //   "card_expiry_month "=>$row['card_expiry_month'],
        //   "card_holder_number"=>$row['card_holder_number'],
        //   "email_address"=>$row['email_address'],
          "customer_name"=>$row['customer_name'],
        //   "customer_address"=>$row['customer_address'],
        //     "customer_city"=>$row['customer_city'],
        //   "customer_pin"=>$row['customer_pin'],
        //   "customer_state"=>$row['customer_state'],
        //   "customer_country"=>$row['customer_country'],
        "created_at"=>$row['created_at']
            
           );

    // Push to "data"
    array_push($cat_arr['getallOrders'], $cat_item);
  } 
   echo json_encode($cat_arr);
    
  
  
//   else{
        
//          echo json_encode(http_response_code(401));
// }


   