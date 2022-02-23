<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once '../../config/Database.php';
      
    include_once '../../models/Auction.php';
    include_once '../../models/Bidding.php';
    include_once '../../models/Creators.php';

   if(isset($_GET['userName'])){
    
$userName=$_GET['userName'];




   

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auctions = new Auction($db);
    $bidding = new Bidding($db);
    $creator = new Creators($db);
 
 $bidderAddress = $creator->get_useraddress($userName);
 
 
 $Bidhistory=$bidding->BiddingHistory($bidderAddress);
 
  $cat_arr = array();
   $cat_arr['BiddingHistory'] = array();
 
  while ($row =$Bidhistory->fetch(PDO::FETCH_ASSOC))
  {
      $nftDetails=$Auctions->nftDetails($row['token_id']);
      $row1 =$nftDetails->fetch(PDO::FETCH_ASSOC);
  $cat_item=array(
          "bidding_id"=>$row['bidding_id'],
          "saleId"=>$row['listing_id'],
            "token_id"=>$row['token_id'],
          "bidder_address"=>$row['bidder_address'],
          "price"=>$row['price'],
          "txHash" =>$row['txHash'],
          "created_at"=>$row['created_at'],
          "status"=>$row['status'],
          "art_name" => $row1['nft_name'],
          "art_img" =>$row1['image']
          
          );
         
 
    // Push to "data"
    array_push($cat_arr['BiddingHistory'], $cat_item);
  }


 echo json_encode($cat_arr);
 
 
   }
   
   else{
       echo json_encode("no parameters found");
   }