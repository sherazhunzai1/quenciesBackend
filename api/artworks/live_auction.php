<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

   
    

    include_once '../../config/Database.php';
      
    include_once '../../models/Auction.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auction = new Auction($db);
       
    // check the start and end variables are recieved or not ////
    
     if(isset($_GET['pageno'])){
               
           $end=((($_GET['pageno'])*4)-1);
            $start=($end-3);
               
           }
           else{
         $start=0;
           $end=3;
           }
    
    /////// getting required data from models ////////
       $live = $Auction->live_auction_arts($start,4);
      $result = $Auction->total_live_auction_arts();
      $totalauctions = $result->rowCount();
      $totalpage=$totalauctions/4;
       $totalpage=ceil( $totalpage);
     $currentpage=$end/4;
     $currentpage=ceil($currentpage);
     
     /// save the data from models to arrays //////
     
       $cat_arr = array();
  
   $cat_arr['liveAuction'] = array();
   $cat_arr['totalLiveAuction'] = $totalauctions;
   $cat_arr['totalPages'] = $totalpage;
    $cat_arr['currentPage'] = $currentpage;
 

  ///////////   fetching data from models to variables using while loop      /////////////
 
    while ($row = $live->fetch(PDO::FETCH_ASSOC)) {
      
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
    array_push($cat_arr['liveAuction'], $cat_item);
  }
 
    
 echo json_encode($cat_arr);
  
  

   