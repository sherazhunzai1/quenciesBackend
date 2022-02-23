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
    $timer = $Auction->auction_timer();
  
    //   $feature = $Auction->feature_arts();
    //   $sold = $Auction->sold_arts();
    //     $reserved = $Auction->reserved_arts();
    //   $live = $Auction->live_auction_arts();
      
       $cat_arr = array();
  
  
  $cat_arr['mainAuctionArt'] =  $timer;



 echo json_encode($cat_arr);
  
  

   