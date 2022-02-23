<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

   if(isset($_GET['id'])){
    
$id=$_GET['id'];
    include_once '../../config/Database.php';
      
    include_once '../../models/Auction.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auction = new Auction($db);
   
    // check the start and end variables are recieved or not ////
     
               
         
       
     
    /////// getting required data from models ////////
       $live = $Auction->single_art($id);
      
     
     /// save the data from models to arrays //////
     
       $cat_arr = array();
       $new=array("artId"=> $live["id"],
               "nft_catagory"=> $live["nft_catagory"],
        "artName"=> $live["nft_name"],
        "artDescription"=> $live["description"],
        "artPriceUsd"=> $live["nft_price"],
         "artPriceEth"=> $live["nft_price"],
          "higgestBid" => $live['max(b.price)'],
        "artGif"=> $live["gif"],
        "artImage"=> $live["image"],
         "auctionTime"=> (strtotime($live['end_time'])*1000) - (strtotime($live['CURRENT_TIMESTAMP()'])*1000),
      "creatorId"=>  $live[ "id"],
       "creatorUsername"=>  $live["userName"],
       "creatorFirstName"=>  $live["firstName"],
        "creatorLastName"=> $live["lastName"],
        "creatorImage"=> $live["img"],
         "creatorBio"=> $live["bio"],
        "OwnerUsername"=>  $live["owner_userName"],
        "OwnerImage"=> $live["owner_img"],
         "owner_walletAddress"=> $live["owner_walletAddress"],
           );
  
   $cat_arr['artDetails'] = $new;
  
 
    
 echo json_encode($cat_arr);
  
   }
         
  else{
        
         echo json_encode(http_response_code(401));
           }

   