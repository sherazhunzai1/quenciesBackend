<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once '../../config/Database.php';

    include_once '../../models/Bidding.php';
   

   if(isset($_GET['bidding_id'])){
    
$bidding_id=$_GET['bidding_id'];




   

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
     $bidding = new Bidding($db);
 
 
    // exit();
    
    $off= $bidding->bidStatusOff($bidding_id);
    
    if($off){
          http_response_code(201);
   
      echo json_encode(
          
            array(
                'bidStatusOff' => true,
                'biddingf_id' => $bidding_id
              
                )
        );
    }
    else{
          http_response_code(401);
    
      echo json_encode(
          
            array('message' => "No request found")
        );
        
    }
 
   }
   else{
         http_response_code(401);
      echo json_encode(
          
            array('message' => "No request found")
        );
   }