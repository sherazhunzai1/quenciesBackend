<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    

    include_once '../../config/Database.php';
    include_once '../../models/Auction.php';
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auction = new Auction($db);
    
    // Category read query
   
      $feature = $Auction->images();
     
    
       $cat_arr = array();

   $cat_arr['CreatorImg'] = array();
 
  
   while ($row = $feature->fetch(PDO::FETCH_ASSOC)) {
     

       $cat_item=array(
           "id"=>$row['id'],
             "creator_img"=>$row['img'],
             
             );

    // Push to "data"
    array_push($cat_arr['CreatorImg'], $cat_item);
  }

    
 echo json_encode($cat_arr);
  
  

   