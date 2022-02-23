<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once '../../config/Database.php';
      
    include_once '../../models/Auction.php';
    include_once '../../models/Bidding.php';

   if(isset($_POST['listing_id']) && isset($_POST['token_id']) && isset($_POST['bidder_address'])  && isset($_POST['price'] )  && isset($_POST['txHash'] )){
    
$listing_id=$_POST['listing_id'];
$token_id=$_POST['token_id'];
$bidder_address=$_POST['bidder_address'];
$price=$_POST['price'];
$txHash=$_POST['txHash'];



   

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auctions = new Auction($db);
    $bidding = new Bidding($db);
 
 $getOwner = $Auctions->getOwner($token_id);
 
 $address=$getOwner->fetch(PDO::FETCH_ASSOC);

    /////// getting required data from models ////////
       $live = $bidding->startBidding($listing_id,$token_id,$bidder_address,$address['owner_id'],$price,$txHash);
       
      
     if($live){
         $highestBid= $bidding->updateHighestBid($token_id,$price);
          http_response_code(201);
        // header("Status: 201 CREATED");
        echo json_encode(
            array('bidding' => true,
               'listing_id' => $listing_id,
               'token_id' => $token_id,
               'bidder_address' => $bidder_address,
               'price' => $price
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
    //  header("Status: 401 UNAUTHORIZED");
      echo json_encode(
          
            array('message' => "No request found")
        );
}

   