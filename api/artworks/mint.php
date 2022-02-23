<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once '../../config/Database.php';
      
    include_once '../../models/Auction.php';

   if(isset($_POST['artworkName']) && isset($_POST['description']) && isset($_POST['nft_catagory']) && isset($_POST['price']) && isset($_POST['creatorWalletId'])){
  
$artworkName=$_POST['artworkName'];
$description=$_POST['description'];
$nft_catagory=$_POST['nft_catagory'];
$price=$_POST['price'];
// $uri=$_POST['uri'];
// $url=$_POST['url'];
$creatorWalletId=$_POST['creatorWalletId'];
//$tockenId=$_POST['tockenId'];
    
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auction = new Auction($db);
   
    // check the start and end variables are recieved or not ////
   
     
     

       
     
    /////// getting required data from models ////////
       $live = $Auction->mint($artworkName,$description,$price,$creatorWalletId,$nft_catagory);
                 
       
     if($live){
          echo json_encode(true);
     }
     else{
          echo json_encode(false);
     }
  
 
    

  
   }
         
  else{
        
         echo json_encode("no request found");
}

   