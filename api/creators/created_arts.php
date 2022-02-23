<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    if(isset($_GET['walletAddress'])){

    include_once '../../config/Database.php';
      
    include_once '../../models/Auction.php';
    include_once '../../models/Creators.php';


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
 
    // Instantiate category object
    $Auction = new Auction($db);
    $creator = new Creators($db);
    $address=$_GET['walletAddress'];
    // Category read query
   
      $feature = $Auction->created_arts($address);
    
     
     
       $cat_arr = array();
   $cat_arr['createdArts'] = array();
  

  while ($row = $feature->fetch(PDO::FETCH_ASSOC)) {
      
$difference_in_seconds = (strtotime($row['end_time'])*1000) - (strtotime($row['CURRENT_TIMESTAMP()'])*1000);

       $cat_item=array(
          "id"=>$row['id'],
          "art_name"=>$row['nft_name'],
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
    // Push to "data"
    array_push($cat_arr['createdArts'], $cat_item);
  } 
    echo json_encode($cat_arr);
  
    }
    else{
         echo json_encode("no parameter is passed");
    }

   