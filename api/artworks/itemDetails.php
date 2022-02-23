<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    
 if(isset($_GET['nftId'])) {
      $nftId=$_GET['nftId'];
       
    include_once '../../config/Database.php';
    include_once '../../models/Auction.php';
 include_once '../../models/likes.php';
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auction = new Auction($db);
    $likes = new likes($db);
    // Category read query
   
      $feature = $Auction->itemDetails($nftId);

// $cat_arr = array();
            $num = $feature->rowCount();
            if($num > 0){
  
   $row = $feature->fetch(PDO::FETCH_ASSOC);
   
     
        //likes count function
        $result = $likes->getTotalLikes($nftId);
        $num = $result->rowCount();
        
        
        $id = (int)$_GET['nftId'];
        $sell = (int)$row['sell'];
        $auction = (int)$row['auction'];
        $row['saleid']=(int) $row['saleid'];
       $endTime=(int) $row['endTimeInSeconds'];
        
       $cat_item=array(
           "id"=>$id,
           "nft_name"=>$row['nft_name'],
            "art_price"=>$row['saleprice'],
            "description"=>$row['description'],
           "creator_name"=>$row['userName'],
            "creator_walletAddress"=>$row['wallet_address'],
            "owner_name"=>$row['owner_username'],
            "owner_img"=>$row['ownerImg'],
            "owner_walletAddress"=>$row['owner_wallet'],
            "category_name"=>$row['nft_catagory'],
             "creator_img"=>$row['img'],
           "art_img"=>$row['image'],
           "art_gif"=>$row['gif'],
            "like"=>$num,
             "views"=>$row['countViews'],
               "auction"=>$auction,
                 "sell"=>$sell,
                 "type"=>$row['type'],
                 "metadataURI"=>$row['metaData'],
                 "tokenId"=>$row['tokenId'],
                 "saleid"=>$row['saleid'],
                 "listingType"=>$row['listingType'],
                 "endTime"=>$endTime,
                 "highestBid"=>$row['highestBid']
           );

    // Push to "data"
  //  array_push($cat_arr['feature'], $cat_item);
   echo json_encode($cat_item);
            }
            else{
                http_response_code(400);
                  echo json_encode("not found");
            }

    
 
 }
  
   else{
        
         echo json_encode(http_response_code(401));
}


   