<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers

   include_once '../../config/Database.php';
   include_once '../../models/trendingcollections.php';
   
     if(isset($_POST['nft_id']) ){
         
         $nft_id=$_POST['nft_id'];
        
  
$database = new Database();
$db = $database->connect();

  
//$nfts = new Nfts($db);
 $Trending_collections = new Trending_collections($db);
  
    // Category read query
   
      $live = $Trending_collections->add_trending_coll_Art($nft_id);

   
     if($live){
          echo json_encode(true);
     }
     else{
          echo json_encode(false);
     }
  
     }
  
  
  else{
        
         echo json_encode(http_response_code(401));
}


   