<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    
if(isset($_GET['walletAddress'])){
    
$walletAddress=$_GET['walletAddress'];
    include_once '../../config/Database.php';
      
    include_once '../../models/Auction.php';
    include_once '../../models/Notification.php';


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
 
    // Instantiate category object
  
    $creator = new Notification($db);
   
    // Category read query
   
      $feature = $creator->winner_notifications($walletAddress);
      
     
     
       $cat_arr = array();
   $cat_arr['winnerNotifications'] = array();
 

  while ($row = $feature->fetch(PDO::FETCH_ASSOC)) {
 
        
      $cat_item=array(
          "notificationId"=>$row['Auction_winner_notifications'],
           "artId"=>$row['product_id'],
          "artTitle"=>$row['product_name'],
          "artImg"=>$row['image'],
          "type"=>$row['type']
        
          
        );

    // Push to "data"
    array_push($cat_arr['winnerNotifications'], $cat_item);
  }
  
 echo json_encode($cat_arr);
  
}
else{
     echo json_encode("no request found");
}

   