<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods:GET,PUT,POST,DELETE,PATCH,OPTIONS');
   
    include_once '../../config/Database.php';
    include_once '../../models/likes.php';
  
 if(isset($_POST['nftId'])){  
     $nftId=$_POST['nftId'];
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
    
    // Instantiate category object
     $likes = new likes($db);
    /////// getting required data from models ////////
     // $postVote = $likes-> getTotalLikes($nftId);
    
        
      $result = $likes->getTotalLikes($nftId);
         
    //      // Get row count
    $num = $result->rowCount();
     echo json_encode($num);
    echo $num;
    
 }
  else
    {
         echo json_encode(http_response_code(401));
    
    }