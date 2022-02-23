<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers

       
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
   
      $feature = $Auction->auction_arts();


            $num = $feature->rowCount();
            if($num > 0){
  
    $cat_arr = array();
   while ($row = $feature->fetch(PDO::FETCH_ASSOC)) {
     
        //likes count function
    //  print_r($row);

        
        $id = (int)$row['nftid'];
        $sell = (int)$row['sell'];
        $auction = (int)$row['auction'];
        $row['saleid']=(int) $row['saleid'];
       $cat_item=array(
           "id"=>$id,
           "art_name"=>$row['nft_name'],
            "art_price"=>$row['saleprice'],
            "description"=>$row['description'],
           "creator_name"=>$row['userName'],
            "creator_walletAddress"=>$row['wallet_address'],
            "owner_name"=>$row['owner_username'],
            "owner_walletAddress"=>$row['owner_wallet'],
            "category_name"=>$row['nft_catagory'],
             "creator_img"=>$row['img'],
           "art_img"=>$row['image'],
           "art_gif"=>$row['gif'],
           "start_time"=>$row['start_time'],
           "endTime"=>$row['endTimeInSeconds'],
             "views"=>$row['countViews'],
               "auction"=>$auction,
                 "sell"=>$sell,
                 "type"=>$row['type'],
                 "metadataURI"=>$row['metaData'],
                 "tokenId"=>$row['tokenId'],
                 "saleid"=>$row['saleid'],
                 "listingType"=>$row['listingType']
           );

    // Push to "data"
    
   array_push($cat_arr, $cat_item);
   
            }
            
             echo json_encode(["liveAuction"=>$cat_arr]);
            }
            
            else{
                http_response_code(400);
                  echo json_encode(array());
            }

    


   