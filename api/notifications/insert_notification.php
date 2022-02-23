<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once '../../config/Database.php';
      include_once '../../models/Bidding.php';
    // include_once '../../models/Creators.php';
     include_once '../../models/Auction.php';
       include_once '../../models/Notification.php';

  

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();


        
$Auction = new Auction($db);
//  $creator = new Creators($db);
    $bidding = new Bidding($db);
     $notification = new Notification($db);
    

    
$rows=$Auction->nft_arts();

  while ($rowss = $rows->fetch(PDO::FETCH_ASSOC)) {
      
$difference_in_seconds = (strtotime($rowss['end_date'])*1000) - (strtotime($rowss['CURRENT_TIMESTAMP()'])*1000);


if($difference_in_seconds <= 0){
    
    
    
    
$id=$rowss['tocken_id'];
   
 
    // Instantiate category object
   
  
   $row= $bidding->get_bidding($id);
   
   $bid_count = $row->rowCount();
   
   
    $row2 = $row->fetch(PDO::FETCH_ASSOC);
    
   
    // check the start and end variables are recieved or not ////
   
     
     
      $check = $notification->check_notification($row2['owner_addreess'],$row2['owner_addreess'],$id,$row2['price']);
     

     $count = $check->rowCount();
        
     if($count <= 0 && $bid_count > 0){
        
     
          $live = $notification->insert_notification($row2['owner_addreess'],$row2['owner_addreess'],$id,$row2['price']);
                
     if($live){
         
           echo json_encode(true);
     }
     else{
          echo json_encode(false);
     }
  
 
         
     }

    
}

} 
    /////// getting required data from models ////////