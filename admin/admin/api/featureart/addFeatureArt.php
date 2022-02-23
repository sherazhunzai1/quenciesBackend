<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers

   include_once '../../../config/database.php';
   include_once '../../model/Features.php';
   include_once '../../../config/constants.php';
   
     if(isset($_POST['id']) ){
         
         $id=$_POST['id'];
        
  
$database = new Database();
$db = $database->connect();


//$nfts = new Nfts($db);
 $Features = new Features($db);
 
 $seq=$Features-> getSeq();
 $row = $seq->fetch(PDO::FETCH_ASSOC);
 extract($row);
 
 $seq++;





      $live = $Features->add_featureArt($id,$seq);
    
      if($live){
        //   http_response_code(201);
          header("Location:". base_url ."admin/view/addFeatureArt.php");
          exit();
      }

  }
  else{
    //   http_response_code(401);
      header("Location:". base_url ."admin/view/addFeatureArt.php");
      exit();
  }