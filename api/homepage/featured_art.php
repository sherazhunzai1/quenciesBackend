<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    

    include_once '../../config/Database.php';
      
    include_once '../../models/Auction.php';
    include_once '../../models/Creators.php';


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auction = new Auction($db);
    
    $creator = new Creators($db);

    // Category read query
   
      $feature = $Auction->feature_arts();
    //   $timer = $Auction->auction_timer();
     $totalfeatures = $feature->rowCount();
      
      $live = $Auction->live_auction_arts();
      
    $totalauctions = $live->rowCount();
 
      $creators = $creator->total_creators();
       
      $totalcreators = $creators->rowCount();

       $cat_arr = array();
   $cat_arr['feature'] = array();
   $cat_arr['featuredCreators'] = array();
   $cat_arr['liveAuctions'] = array();
    // $cat_arr['mainAuctionArt'] =  $timer;
  
   $cat_arr['totalfeaturedArts'] = $totalfeatures;
   $cat_arr['totalfeaturedCreators'] = $totalauctions;
   $cat_arr['totalLiveAuctions'] = $totalcreators;

  while ($row = $feature->fetch(PDO::FETCH_ASSOC)) {
      
$difference_in_seconds = (strtotime($row['end_date'])*1000) - (strtotime($row['CURRENT_TIMESTAMP()'])*1000);

       $cat_item=array(
          "id"=>$row['id'],
          "nft_name"=>$row['nft_name'],
          "creator_name"=>$row['creatorName'],
             "creator_img"=>$row['img'],
            "creator_walletAddress"=>$row['wallet_address'],
            "owner_name"=>$row['owner_userName'],
             "owner_img"=>$row['owner_img'],
            "owner_walletAddress"=>$row['owner_walletAddress'],
          "art_img"=>$row['image'],
          "art_gif"=>$row['gif'],
          "start_time"=>$row['start_time'],
            "art_price"=>$row['nft_price'],
          "end_time"=>$difference_in_seconds,
           "higgestBid" => $row['max(b.price)']);
    // Push to "data"
    array_push($cat_arr['feature'], $cat_item);
  } 


  while ($row = $live->fetch(PDO::FETCH_ASSOC)) {
     
$difference_in_seconds = (strtotime($row['end_date'])*1000) - (strtotime($row['CURRENT_TIMESTAMP()'])*1000);
        
      $cat_item=array(
          "id"=>$row['id'],
          "nft_name"=>$row['nft_name'],
        "creator_name"=>$row['userName'],
             "creator_img"=>$row['img'],
            "creator_walletAddress"=>$row['wallet_address'],
            "owner_name"=>$row['owner_userName'],
             "owner_img"=>$row['owner_img'],
            "owner_walletAddress"=>$row['owner_walletAddress'],
          "art_img"=>$row['image'],
          "art_gif"=>$row['gif'],
          "start_time"=>$row['start_time'],
            "nft_price"=>$row['nft_price'],
          "end_time"=>$difference_in_seconds,
          "higgestBid" => $row['max(b.price)']);
          
          
          
    //   $data=array(
    //       "id"=>$this->id,
    //       "art_name"=>$this->productname,
    //       "art_gif"=>$this->art_gif,
    //       "creator_name"=>$this->creatorname,
    //         "creator_img"=>$this->creator_img,
    //         "creator_walletAddress"=>$row['wallet_address'],
    //         "owner_name"=>$row['owner_username'],
    //         "owner_img"=>$row['owner_img'],
    //         "owner_walletAddress"=>$row['owner_walletAddress'],
    //       "art_img"=>$this->art_img,
    //       "start_date"=>$this->start_date,
    //       "end_date"=>$this->end_date,
    //       "art_price"=>$this->art_price,
    //       "tokenId" => $this->token_id
    //       );
          
          
          
          
          
          

    // Push to "data"
    array_push($cat_arr['liveAuctions'], $cat_item);
  }
    
  while ($row =$creators->fetch(PDO::FETCH_ASSOC))
  {
     

        
      $cat_item=array(
          "id"=>$row['id'],
          "username"=>$row['userName'],
          "firstName"=>$row['firstName'],
          "lastName"=>$row['lastName'],
           "bio"=>$row['bio'],
          "creator_img"=>$row['img'],
          "creator_cover"=>$row['cover']
          );
         
         

    // Push to "data"
    array_push($cat_arr['featuredCreators'], $cat_item);
  }



  echo json_encode($cat_arr);
  
  

   