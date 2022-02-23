<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers

   include_once '../../config/Database.php';
   include_once '../../models/hot_collections.php';
   
   if(isset($_POST['nft_id'])){
       $nft_id= $_POST['nft_id'];
       
     
       
       $database = new Database();
       $db = $database->connect();
       
         
       $Hot_collections = new Hot_collections($db);
       
       
       $live = $Hot_collections->add_Hot_coll_Art($nft_id);
       
       if($live){
          echo json_encode(true);
     }
     else{
          echo json_encode(false);
     }
  
     }
   
   else {
       echo json_encode(http_response_code(401));
   }
   
   ?>