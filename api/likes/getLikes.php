<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods:GET,PUT,POST,DELETE,PATCH,OPTIONS');
   
    include_once '../../config/Database.php';
     include_once '../../models/likes.php';
  
 if(isset($_POST['nftId']) && isset($_POST['creatorId']))
    { 
        $nftId=$_POST['nftId'];
        $creatorId=$_POST['creatorId'];
   
 
    
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
  
    // Instantiate category object
    $likes = new likes($db);
    // check the start and end variables are recieved or not ////
 
     $cat_arr = array();
     $object = new stdClass();
    $exist = $likes->isUserAlreadyLiked($creatorId, $nftId);
 
     if($exist){
        
           $userVote = $likes->deleteLikes($nftId,$creatorId);
            $result = $likes->getTotalLikes($nftId);
           $num = $result->rowCount();
            $object->type = false;
             $object->likes = $num ;
           
           echo json_encode($object);
           
     }
     else {
         $likePost = $likes->createLikes($nftId,$creatorId);
          $result = $likes->getTotalLikes($nftId);
              $num = $result->rowCount();
            $object->type = true;
             $object->likes = $num ;
           
           echo json_encode($object);

             
    
     
}
 
   
         
    //      // Get row count
    // $num = $result->rowCount();
    // echo $num;
   
  
//   $cat_arr['liveAuction'] = array();
}

    else
    {
         echo json_encode(http_response_code(401));
    
    }
  
  
   