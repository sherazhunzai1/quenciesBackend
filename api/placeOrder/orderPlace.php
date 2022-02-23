<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers

   include_once '../../config/Database.php';
    include_once '../../models/PlaceOrder.php';
  
     if(isset($_POST['order_id']) && isset($_POST['order_item_rca_id']) && isset($_POST['order_itemQuantity']) && isset($_POST['order_price'])){
         
         $order_id=$_POST['order_id'];
         $order_item_rca_id=$_POST['order_item_rca_id'];
         $order_itemQuantity=$_POST['order_itemQuantity'];
         $order_price=$_POST['order_price'];




  
$database = new Database();
$db = $database->connect();

//$nfts = new Nfts($db);
 $Order = new PlaceOrder($db);
  
//   exit();
    // Category read query

      $result = $Order->place_order($order_id,$order_item_rca_id,$order_itemQuantity,$order_price);
 
  
     if($result){
          echo json_encode(true);
     }
     else{
          echo json_encode(false);
     }
  
     }
  
  
  else{
       
         echo json_encode(http_response_code(401));
}


   