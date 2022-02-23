<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

   if(isset($_GET['feature_id'])){
    
   $feature_id=$_GET['feature_id'];
   
    include_once '../../config/Database.php';
    include_once '../../models/Features.php';
    include_once '../../models/likes.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Features = new Features($db);
    $likes = new likes($db);
    // check the start and end variables are recieved or not ////
 
    /////// getting required data from models ////////
       $live = $Features->readSingleArt($feature_id);
   
  
     $cat_arr = array();
    
   $cat_arr['feature'] = array();
   
      
        while ($row = $live->fetch(PDO::FETCH_ASSOC)) {
   
      $result = $likes->getTotalLikes($row['feature_id']);
        $num = $result->rowCount();
        
        
        $endTime=(int) $row['endTimeInSeconds'];
        
       $cat_item=array(
           "id"=>$row['nft_id'],
           "art_name"=>$row['nft_name'],
            "art_price"=>$row['nft_price'],
            "description"=>$row['description'],
           "creator_walletAddress"=>$row['creator_id'],
           "creator_name"=>$row['creatorName'],
            "category_name"=>$row['nft_catagory'],
           "art_img"=>$row['image'],
                "sequence"=>$row['sequence'],
                 "like"=>$num,
             "views"=>$row['countViews'],
              "listingType"=>$row['listingType'],
             "highestBid"=>$row['highestBid'],
             "endTime"=>$endTime
           );

    // Push to "data"
    array_push($cat_arr['feature'], $cat_item);
  }

    
 echo json_encode($cat_arr);
  
   }
         
  else{
        
         echo json_encode(http_response_code(401));
           }

   