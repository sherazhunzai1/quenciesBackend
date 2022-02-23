<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods:GET,PUT,POST,DELETE,PATCH,OPTIONS');
   
    include_once '../../config/Database.php';
     include_once '../../models/followers.php';
  
 if(isset($_POST['followedUserid']))
    { 
       
        $followedUserid=$_POST['followedUserid'];
   

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
 
    
    // Instantiate category object
    $followers = new followers($db);
    // check the start and end variables are recieved or not ////
  
   
     $object = new stdClass();
    $exist = $followers->isUserAlreadyFollowing($followedUserid);
 
     if($exist){
        
          $userVote = $followers->unfollow($followedUserid);
             $result = $followers->getTotalfollowers();
           $num = $result->rowCount();
            $object->type = false;
            $object->followers = $num ;
           
          echo json_encode($object);
         
           
     }
     else {
         $likePost = $followers->follow($followedUserid);
           $result = $followers->getTotalfollowers();
               $num = $result->rowCount();
              $object->type = true;
           $object->followers = $num ;
           
           echo json_encode($object);
        //  $row = $result->fetch(PDO::FETCH_ASSOC);
        //  $data=array('user_id'=>$row['id'],
        //             'userName'=>$row['userName'],
        //             'user_img'=>$row['img'] );
                    
        // echo json_encode(
        //     array('following' => true,
        //           'user_id'=>$row['id'],
        //           'userName'=>$row['userName'],
        //             'user_img'=>$row['img'],
        //             'user_cover'=>$row['cover'],
        //             'user_walletAddress'=>$row['wallet_address'],
        //             'user_bio'=>$row['bio']));

             
    
     
}
 
}

    else
    {
         echo json_encode(http_response_code(401));
    
    }
  
  
   