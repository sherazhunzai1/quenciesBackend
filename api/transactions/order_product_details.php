<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
   include_once '../../config/Database.php';
    include_once '../../models/transactions.php';

 
$database = new Database();
$db = $database->connect();

  
//$nfts = new Nfts($db);
// $Orders = new Orders($db);
  $Transactions = new Transactions($db); 
    // Category read query
   
      $feature = $Transactions->get_payment_info();

$cat_arr=array();
            
 $cat_arr['getOrderDetails'] = array();
           
  
   while ($row = $feature->fetch(PDO::FETCH_ASSOC)) {
      
        
       $cat_item=array(
           "id"=>$row['id'],
           "customer_name"=>$row['customer_name'],
           "customer_email"=>$row['customer_email'],
          "item_name"=>$row['item_name'],
          "item_number"=>$row['item_number'],
          "item_price "=>$row['item_price'],
          "item_price_currency"=>$row['item_price_currency'],
          "paid_amount"=>$row['paid_amount'],
          "paid_amount_currency"=>$row['paid_amount_currency'],
           "txn_id"=>$row['txn_id'],
            "total_amount"=>$row['total_amount'],
            "payment_status"=>$row['payment_status'],
             "Product_title"=>$row['title'],
          "Product_ID"=>$row['rcaId'],
           "created"=>$row['created'],
          "modified"=>$row['modified'],
          
           );

      // Push to "data"
    array_push($cat_arr['getOrderDetails'], $cat_item);
  } 
   echo json_encode($cat_arr);
    


   