<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    
 if(isset($_GET['id'])) {
      $id=$_GET['id'];
      
   include_once '../../config/Database.php';
    include_once '../../models/PlaceOrder.php';

  
$database = new Database();
$db = $database->connect();

  
//$nfts = new Nfts($db);
 $Order = new PlaceOrder($db);
    
    // Category read query
   
      $feature = $Order->numofOrders($id);

$cat_arr=array();
            
 $cat_arr['getOrderDetails'] = array();
           
  
   while ($row = $feature->fetch(PDO::FETCH_ASSOC)) {
        
       $cat_item=array(
           "order_itemId"=>$row['order_itemId'],
           "order_id"=>$row['order_id'],
           "order_item_rca_id"=>$row['order_item_rca_id'],
           "order_itemQuantity"=>$row['order_itemQuantity'],
          "order_price"=>$row['order_price'],
          "total_amount "=>$row['total_amount'],
          
            
           );

      // Push to "data"
    array_push($cat_arr['getOrderDetails'], $cat_item);
  } 
   echo json_encode($cat_arr);
 }
   else{
        
         echo json_encode(http_response_code(401));
}


   