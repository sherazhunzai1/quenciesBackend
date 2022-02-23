<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    

    include_once '../../config/Database.php';
      
    include_once '../../models/Auction.php';
 include_once '../../models/Creators.php';
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
 
    // Instantiate category object
      $Auction = new Auction($db);
   
//   $creator = new Creators($db);
    // Category read query
    //   $cat_arr = array();
//   $cat_arr['TopSellers'] = array();
 
  $live = $Auction->sellers();
     
     $cat_arr = array();
   $cat_arr['TopSellers'] = array();

  while ($row = $live->fetch(PDO::FETCH_ASSOC)) { 
     
      $cat_item=array(
        //   "id"=>$row['id'],
          "creator_name"=>$row['userName'],
             "creator_img"=>$row['img'],
             "creator_cover"=>$row['cover'],
             "creator_Bio"=>$row['bio'],
              "creator_walletAddress"=> $row["wallet_address"]
          
          );

    // Push to "data"
    array_push($cat_arr['TopSellers'], $cat_item);
  }
    echo json_encode($cat_arr);

  /// save the data from models to arrays //////
     
//       $cat_arr = array();
//       $new=array(  "creatorId"=> $live["id"],
//           "creatorUsername"=>  $live["userName"],
//       "creatorFirstName"=>  $live["firstName"],
//         "creatorLastName"=> $live["lastName"],
//          "creatorImage"=> $live["img"],
//          "creator_walletAddress"=> $live["creator_wallet_address"],
          
//           );
  
//   $cat_arr['TopSellers'] = $new;
  
 
    
//  echo json_encode($cat_arr);
  
//   }
         
//   else{
        
//          echo json_encode("no request found");
//           }

  
 
   