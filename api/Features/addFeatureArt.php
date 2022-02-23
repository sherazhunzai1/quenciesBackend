<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers

   include_once '../../config/Database.php';
   include_once '../../models/Features.php';
   include_once '../../models/constants.php';
   
     if(isset($_POST['nft_id']) ){
         
         $nft_id=$_POST['nft_id'];
        
  
$database = new Database();
$db = $database->connect();

  
//$nfts = new Nfts($db);
 $Features = new Features($db);
  
    // Category read query
   
      $live = $Features->add_featureArt($nft_id);

   
     if($live){
         http_response_code(201);
         
          echo json_encode("Item Added");
         header('location:'.BASE_URL.'admin/view/addFeatureArt.php');
         exit();
     }
     else{
          echo json_encode(false);
     }
  
     }
  
  
  else{
        
         echo json_encode(http_response_code(401));
}

// header("location:".base_url."/admin/view/addFeatureArt.php");

   ?>