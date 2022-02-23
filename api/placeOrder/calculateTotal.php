<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/PlaceOrder.php';

   
   if(isset($_POST['order_itemId'])) {
       $order_itemId=$_POST['order_itemId'];

 


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
  
    // Instantiate category object
   // $Auction = new Auction($db);
    $PlaceOrder = new PlaceOrder($db);
    
  
              /////// getting required data from models ////////
       $live = $PlaceOrder->totalAmount($order_itemId);
    //   exit();
     if($live){
        
         $view= $PlaceOrder->total($order_itemId);
        
           $cat_arr = array();
   $cat_arr['orderDetails'] = array();

  while ($row = $view->fetch(PDO::FETCH_ASSOC)) { 
     
      $cat_item=array(
           "order_itemId"=>$row['order_itemId'],
          "total_amount"=>$row['total_amount']
          );

    // Push to "data"
    array_push($cat_arr['orderDetails'], $cat_item);
  }
    echo json_encode($cat_arr);
     }
     else{
          echo json_encode("No amount calculated");
     }
  
  
   }
         
  else{
        
         echo json_encode(http_response_code(401));
}

   