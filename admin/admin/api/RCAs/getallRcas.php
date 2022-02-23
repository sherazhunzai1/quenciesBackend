<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
       
    include_once '../../config/Database.php';
    include_once '../../models/RCAs.php';
  
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
 
    // Instantiate category object
    $RCAs = new RCA($db);
 
    // Category read query
   
      $feature = $RCAs->getAllrcas();

 
            $cat_arr=array();
            
          $cat_arr['getallRCAs'] = array();
         
 
   while ($row = $feature->fetch(PDO::FETCH_ASSOC)) {
       
  $cat_item=array(
          "rcaId"=>$row['rcaId'],
          "title"=>$row['title'],
            "description"=>$row['description'],
          "image1"=>$row['image1'],
          "image2"=>$row['image2'],
          "image3"=>$row['image3'],
          "image4"=>$row['image4'],
          "image5"=>$row['image5'],
          "image"=>$row['image'],
          "price"=>$row['price']
           
         );
    // Push to "data"
    array_push($cat_arr['getallRCAs'], $cat_item);
  } 
   echo json_encode($cat_arr);
    
  

   