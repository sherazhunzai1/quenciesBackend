<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once '../../config/Database.php';
    
       include_once '../../models/Notification.php';

  
    

if(isset($_GET['ownerAddress']) && isset($_GET['artId'])){
    

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();


     $notification = new Notification($db);
  
    

$live=$notification->insert_winner_notification($_GET['ownerAddress'],$_GET['artId']);

 
                 
     
     if($live){
         
        
           echo json_encode(true);
     }
     else{
          echo json_encode(false);
     }
  
 
         
     }
     else{
         http_response_code(400);
     }
     
    
    
    
    
 /////// getting required data from models ////////