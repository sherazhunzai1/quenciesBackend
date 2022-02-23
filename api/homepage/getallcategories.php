<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

   
  
    include_once '../../config/Database.php';
     include_once '../../models/Categories.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Categories = new Categories($db);
   
    // check the start and end variables are recieved or not ////
     
     
    /////// getting required data from models ////////
       $live = $Categories-> getAllCategories();
      
         $cat_arr=array();
         $cat_arr['AllCategories'] = array();



    while ($row = $live->fetch(PDO::FETCH_ASSOC)) {
     
       
    //   $cat_item=array(
    //       "id"=>$row['nft_category_id'],
    //         "category_name"=>$row['category_name'],
    //       "art_img"=>$row['icon']
    //       );
          // $difference_in_seconds = (strtotime($row['end_date'])*1000) - (strtotime($row['CURRENT_TIMESTAMP()'])*1000);
        
      $cat_item=array(
          "id"=>$row['nftId'],
          "category_name"=>$row['category_name'],
           "categoryId"=>$row['nft_catagory_id'],
          "nft_name"=>$row['nft_name'],
           "art_description"=>$row['description'],
        "creator_name"=>$row['userName'],
             "creator_img"=>$row['img'],
            "creator_walletAddress"=>$row['wallet_address'],
          "art_img"=>$row['image'],
          "art_gif"=>$row['gif'],
          "start_time"=>$row['start_time'],
            "nft_price"=>$row['nft_price'],
          "end_time"=>$row['end_time'],
          // "higgestBid" => $row['max(b.price)']
          );
          


    // Push to "data"
   
    array_push($cat_arr['AllCategories'], $cat_item);
  
  }
   echo json_encode($cat_arr);
    
      



  
  
   