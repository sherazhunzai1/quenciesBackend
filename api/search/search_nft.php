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
   
    if(isset($_GET['search'])){

  // Search value
  $search=$_GET['search'];


 
   //including data model 
      $search_nft = $Auction->search_nft($search);
    
     $search_nfts['search_nft'] = array();
    
      while ($row = $search_nft->fetch(PDO::FETCH_ASSOC)) {
      
//$difference_in_seconds = (strtotime($row['end_time'])*1000) - (strtotime($row['CURRENT_TIMESTAMP()'])*1000);

       $cat_item=array(
          "id"=>$row['id'],
          "art_name"=>$row['nft_name'],
           "nft_catagory_id"=>$row['nft_catagory_id'],
          "creator_name"=>$row['creatorName'],
             "creator_img"=>$row['img'],
            "creator_walletAddress"=>$row['wallet_address'],
            "owner_name"=>$row['userName'],
             "owner_img"=>$row['owner_img'],
            "owner_walletAddress"=>$row['owner_walletAddress'],
          "art_img"=>$row['image'],
          "art_gif"=>$row['gif'],
          "start_time"=>$row['start_time'],
            "nft_price"=>$row['nft_price'],
          "end_time"=>$row['end_time'],
         //  "higgestBid" => $row['max(b.price)']
         );
    // Push to "data"
    array_push($search_nfts['search_nft'], $cat_item);
  }
  
   echo json_encode($search_nfts['search_nft']);
    }
    else{
        
           echo json_encode("no request found");
    }