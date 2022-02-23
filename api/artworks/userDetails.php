<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

   
    include_once '../../config/Database.php';
     include_once '../../models/Auction.php';
 if(isset($_GET['userId']))
    { 
        $userName=$_GET['userId'];
        
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auction = new Auction($db);
  
    // check the start and end variables are recieved or not ////
     
   
    /////// getting required data from models ////////
       $totalArts = $Auction-> userDetails($userId);
      
         $cat_arr=array();
          $cat_arr['myItems'] = array();
        
  
   while ($row = $totalArts->fetch(PDO::FETCH_ASSOC)) {

       $cat_item=array(
          "items"=>$row['nft_name'],
          "owners"=>$row['creatorName'],
          "averagePrice"=>$row['AVG(a.nft_price)'],
          "voumeTrade"=>$row['MAX(nft_price)']
        );
    // Push to "data"
    array_push($cat_arr['myItems'], $cat_item);
  } 
   echo json_encode($cat_arr);
    
    }
    else{
         echo json_encode(http_response_code(401));
    
    }
    



  
  
   