<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    
 if(isset($_GET['id'])) {
      $id=$_GET['id'];
       
    include_once '../../config/Database.php';
    include_once '../../models/RCAs.php';
  
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $RCAs = new RCA($db);
   
    // Category read query
   
      $feature = $RCAs->getRCA($id);
  
 $row = $feature->fetch(PDO::FETCH_ASSOC);
        
       $cat_arr=array(
           "rcaId"=>$row['rcaId'],
           "title"=>$row['title'],
           "description"=>$row['description'],
           "image"=>$row['image'],
        //   "image1"=>$row['image1'],
        //   "image2"=>$row['image2'],
        //   "image3"=>$row['image3'],
        //   "image4"=>$row['image4'],
        //   "image5"=>$row['image5'],
           "price"=>$row['price'],
            "views"=>$row['countViews'],
           
           );

  

    
 echo json_encode($cat_arr);
 }
  
   else{
        
         echo json_encode(http_response_code(401));
}


   