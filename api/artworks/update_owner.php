<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once '../../config/Database.php';
          include_once '../../models/Notification.php';
      
    include_once '../../models/Auction.php';

   if(isset($_POST['artId']) && isset($_POST['ownerAddress'])){
    

$artId=$_POST['artId'];
$ownerAddress=$_POST['ownerAddress'];


    

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auction = new Auction($db);
      $notification = new Notification($db);
   
    // check the start and end variables are recieved or not ////
   
     
     
       $update=$notification->insert_winner_notification($ownerAddress,$artId);
     
    /////// getting required data from models ////////
       $live = $Auction->update_owner($artId,$ownerAddress);
                 
        
      
     if($live){
          echo json_encode(true);
     }
     else{
          echo json_encode(false);
     }
  
 
    

  
   }
         
  else{
        
         echo json_encode("no request found");
}

   