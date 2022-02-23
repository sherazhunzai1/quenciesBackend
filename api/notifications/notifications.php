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
   
      $feature = $creator->notifications($walletAddress);
      
     
     
       $cat_arr = array();
   $cat_arr['notifications'] = array();
 

  while ($row = $feature->fetch(PDO::FETCH_ASSOC)) {
     $settle=false;
if($row['status']== 1){
    $settle=true;
}
else{
    $settle=false;
}
        
      $cat_item=array(
          "notificationId"=>$row['notifications_id'],
           "artId"=>$row['product_id'],
          "artTitle"=>$row['product_name'],
          "artImg"=>$row['image'],
          "auctionPrice"=>$row['auction_price'],
            "tokenId"=>$row['tocken_id'],
             "creatorUsername"=>$row['username'],
          "ownerAddress"=>$row['owner_address'],
           "isSettleable"=>$settle,
          "createdAt"=>$row['created'],
           "type"=>$row['type']
        );

    // Push to "data"
    array_push($cat_arr['notifications'], $cat_item);
  }
  
 echo json_encode($cat_arr);
  
}
else{
     echo json_encode("no request found");
}

   