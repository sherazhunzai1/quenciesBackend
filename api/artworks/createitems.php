<?php
    // Headers  ////
   header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    header('Access-Control-Allow-Methods:GET,PUT,POST,DELETE,PATCH,OPTIONS');
    include_once '../../config/Database.php';
     include_once '../../models/Auction.php';
 include_once '../../models/contants.php';
 
 if(isset($_POST['artworkName']) && isset($_POST['description'])
   && isset($_POST['metaData']) && isset($_POST['walletAddress']) && isset($_POST['imageUri']) && isset($_POST['categoryId']))
   {
  
$artworkName=$_POST['artworkName'];
$description=$_POST['description'];

$metaData=$_POST['metaData'];

$creator_id=$_POST['walletAddress'];
$imageUri=$_POST['imageUri'];
$nft_catagory_id=$_POST['categoryId'];
$owner_id=$_POST['walletAddress'];
   


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auction = new Auction($db);
   
 
    /////// getting required data from models ////////
       $live = $Auction->mint($artworkName,$description,$metaData,$imageUri,$creator_id,$nft_catagory_id,$owner_id);
    
    
    //   echo $live;
        // $message = 'success';
     if($live>0){
      http_response_code(201);
         echo json_encode(
            array('message' => "minted successfully",
            "id"=>$live
                   
                    ));
                    exit();
         // echo json_encode("Item created successfully");
     }
     else{
          echo json_encode("Item not created");
     }
 
   
   }
         
  else{
        
http_response_code(401);
}

   