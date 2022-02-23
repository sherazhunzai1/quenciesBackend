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
    //  $arts = $Auction->nft_arts();
    //   $feature = $Auction->feature_arts();
    //   $sold = $Auction->sold_arts();
    //     $reserved = $Auction->reserved_arts();
    //   $live = $Auction->live_auction_arts();
      
       $cat_arr = array();
//   $cat_arr['nftArts'] = array();
  
  $cat_arr['auctionArt'] =  $timer;

//   while ($row = $arts->fetch(PDO::FETCH_ASSOC)) {
     
// $difference_in_seconds = (strtotime($row['end_date'])*1000) - (strtotime($row['CURRENT_TIMESTAMP()'])*900);
        
//       $cat_item=array(
//           "id"=>$row['id'],
//           "art_name"=>$row['product_name'],
//           "creator_name"=>$row['name'],
//             "creator_img"=>$row['img'],
//           "art_img"=>$row['image'],
//           "art_gif"=>$row['gif'],
//           "start_date"=>$row['start_date'],
//           "end_date_in_milliseconds"=>$difference_in_seconds);

//     // Push to "data"
//     array_push($cat_arr['nftArts'], $cat_item);
//   }

 echo json_encode($cat_arr);
  
  

   