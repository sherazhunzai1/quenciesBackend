<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers

   include_once '../../config/Database.php';
    include_once '../../models/transactions.php';
   
     if(isset($_POST['customer_name']) && isset($_POST['customer_email']) && isset($_POST['item_name']) && isset($_POST['item_number']) && isset($_POST['item_price']) && isset($_POST['item_price_currency'])  && isset($_POST['paid_amount'])  && isset($_POST['paid_amount_currency'])  && isset($_POST['txn_id']) && isset($_POST['payment_status'])&& isset($_POST['created'])&& isset($_POST['modified'])){
        
         $customer_name=$_POST['customer_name'];
         $customer_email=$_POST['customer_email'];
         $item_name=$_POST['item_name'];
         $item_number=$_POST['item_number'];
         $item_price=$_POST['item_price'];
         $item_price_currency=$_POST['item_price_currency'];
         $paid_amount=$_POST['paid_amount'];
         $paid_amount_currency=$_POST['paid_amount_currency'];
         $txn_id=$_POST['txn_id'];
         $payment_status=$_POST['payment_status'];
         $created=$_POST['created'];
         $modified=$_POST['modified'];
    // Headers

   include_once '../../config/Database.php';
    include_once '../../models/transactions.php';

  
$database = new Database();
$db = $database->connect();

  
//$nfts = new Nfts($db);
 $Transactions = new Transactions($db);
   
    // Category read query
   
      $live = $Transactions->insert_transction_info($customer_name,$customer_email,$item_name,$item_number,$item_price,$item_price_currency,$paid_amount,$paid_amount_currency,$txn_id,$payment_status,$created,$modified);

   
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


   