<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/Auction.php';
    
   if(isset($_POST['id'])  && isset($_POST['nft_price']) && isset($_POST['nft_catagory_id']) ) {
  
$id=$_POST['id'];
$nft_price=$_POST['nft_price'];
$nft_catagory_id=$_POST['nft_catagory_id'];



    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
  
    // Instantiate category object
    $Auction = new Auction($db);
  
   
    // check the start and end variables are recieved or not ////
   
       
    
    /////// getting required data from models ////////
       $live = $Auction->setprice($id,$nft_price,$nft_catagory_id);
          
   
     if($live){
          echo json_encode("price set successfully");
     }
     else{
          echo json_encode("price not set yet");
     }
  
  
   }
         
  else{
        
         echo json_encode(http_response_code(401));
}

   