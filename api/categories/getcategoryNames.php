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
       $totalArts = $Categories->  getcategoriesName();
      
         $cat_arr=array();
          $cat_arr['getcategoriesNames'] = array();
         
  
   while ($row = $totalArts->fetch(PDO::FETCH_ASSOC)) {
      

       $cat_item=array(
          "id"=>$row['nft_category_id'],
        "nft_category"=>$row['category_name'],
         "avater"=>$row['icon'],
          );
    // Push to "data"
    array_push($cat_arr['getcategoriesNames'], $cat_item);
  } 
   echo json_encode($cat_arr);
    
   
    



  
  
   