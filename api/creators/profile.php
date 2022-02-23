<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
 
   
    include_once '../../config/Database.php';
     include_once '../../models/Creators.php';
     
 if(isset($_GET['username']))
    { 
        
        $username=$_GET['username'];
        
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auction = new Creators($db);
   
    // check the start and end variables are recieved or not ////
     
 
    /////// getting required data from models ////////
       $profile = $Auction->profile($username);

 $row = $profile->fetch(PDO::FETCH_ASSOC);

       $cat_item=array(
          "userid"=>$row['id'],
          "username"=>$row['userName'],
           "firstname"=>$row['firstName'],
            "lastname"=>$row['lastName'],
           "walletAddress"=>$row['wallet_address'],
          "image"=>$row['img'],
           "cover"=>$row['cover'],
           "bio"=>$row['bio'],
       
        );
    // Push to "data"
   $cat_arr['profile']=$cat_item;
  
   echo json_encode($cat_arr['profile']);
    
    }
    else{
         http_response_code(401);
    
    }
    



  
  
   