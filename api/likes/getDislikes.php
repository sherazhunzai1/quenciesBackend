<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods:GET,PUT,POST,DELETE,PATCH,OPTIONS');
   
    include_once '../../config/Database.php';
     include_once '../../models/likes.php';
  
 if(isset($_POST['nftId']) && isset($_POST['creatorId']))
    { 
        $nftId=$_POST['nftId'];
        $creatorId=$_POST['creatorId'];
   
  
    
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $likes = new likes($db);
    // check the start and end variables are recieved or not ////
      
     
    /////// getting required data from models ////////
     // $postVote = $likes-> getTotalLikes($nftId);
    //  $userVote = $likes-> getUserLikes($nftId,$creatorId);
     
$live = $likes->deleteLikes($nftId,$creatorId);
            
       
     if($live){
          echo json_encode(true);
     }
     else{
          echo json_encode(false);
     }
     
    }
    
    else
    {
         echo json_encode(http_response_code(401));
    
    }
    