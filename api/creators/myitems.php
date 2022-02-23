<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

   
    include_once '../../config/Database.php';
     include_once '../../models/Auction.php';
 if(isset($_GET['userName']))
    { 
        $userName=$_GET['userName'];
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auction = new Auction($db);
   
    // check the start and end variables are recieved or not ////
     
   
    /////// getting required data from models ////////
       $totalArts = $Auction-> myitems($userName);
      
         $cat_arr=array();
          $cat_arr['myItems'] = array();
        
  
   while ($row = $totalArts->fetch(PDO::FETCH_ASSOC)) {
//$difference_in_seconds = (strtotime($row['end_date'])*1000) - (strtotime($row['CURRENT_TIMESTAMP()'])*1000);
       $cat_item=array(
          "id"=>$row['id'],
          "nft_name"=>$row['nft_name'],
          "creator_name"=>$row['creatorName'],
           //  "creator_img"=>$row['img'],
          //  "creator_walletAddress"=>$row['wallet_address'],
            // "owner_name"=>$row['owner_userName'],
            //  "owner_img"=>$row['owner_img'],
            // "owner_walletAddress"=>$row['owner_walletAddress'],
          "art_img"=>$row['image'],
        //   "art_gif"=>$row['gif'],
        //   "start_time"=>$row['start_time'],
        //     "art_price"=>$row['nft_price'],
        //   "end_time"=>$difference_in_seconds,
        //   "higgestBid" => $row['max(b.price)']
        );
    // Push to "data"
    array_push($cat_arr['myItems'], $cat_item);
  } 
   echo json_encode($cat_arr);
    
    }
    else{
         echo json_encode(http_response_code(401));
    
    }
    



  
  
   