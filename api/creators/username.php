<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    

    include_once '../../config/Database.php';
      
    include_once '../../models/Auction.php';
    include_once '../../models/Creators.php';

 if(isset($_GET['userName'])){
               
$userName  =  $_GET['userName'];



    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
  
    $creator = new Creators($db);
   
    // Category read query
  

      $creators = $creator->username_exist($userName);
    
      if($creators){
          echo json_encode(true);
      }
      else{
          echo json_encode(false);
      }


 
  
 }
 else{
     
     echo json_encode("no request found");
 }

   