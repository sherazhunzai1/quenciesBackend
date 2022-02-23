<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers

   include_once '../../config/Database.php';
    include_once '../../models/Orders.php';
   
     if(isset($_POST['order_number']) && isset($_POST['order_total_amount']) && isset($_POST['transaction_id']) && isset($_POST['card_cvc']) && isset($_POST['card_expiry_month']) && isset($_POST['card_holder_number'])  && isset($_POST['email_address'])  && isset($_POST['customer_name'])  && isset($_POST['customer_address']) && isset($_POST['customer_city'])&& isset($_POST['customer_pin'])&& isset($_POST['customer_state']) && isset($_POST['customer_country'])){
         
         $order_number=$_POST['order_number'];
         $order_total_amount=$_POST['order_total_amount'];
         $transaction_id=$_POST['transaction_id'];
         $card_cvc=$_POST['card_cvc'];
         $card_expiry_month=$_POST['card_expiry_month'];
         $card_holder_number=$_POST['card_holder_number'];
         $email_address=$_POST['email_address'];
         $customer_name=$_POST['customer_name'];
         $customer_address=$_POST['customer_address'];
         $customer_city=$_POST['customer_city'];
         $customer_pin=$_POST['customer_pin'];
         $customer_state=$_POST['customer_state'];
         $customer_country=$_POST['customer_country'];
    // Headers

   include_once '../../config/Database.php';
    include_once '../../models/Orders.php';

  
$database = new Database();
$db = $database->connect();

  
//$nfts = new Nfts($db);
 $Orders = new Orders($db);
   
    // Category read query
   
      $live = $Orders->insert_order($order_number,$order_total_amount,$transaction_id,$card_cvc,$card_expiry_month,$card_holder_number,$email_address,$customer_name,$customer_address,$customer_city,$customer_pin,$customer_state,$customer_country);

   
     if($live){
          echo json_encode(true);
     }
     else{
          echo json_encode(false);
     }
  
     }
  
  
  else{
        
         echo json_encode(http_response_code(401));
}


   