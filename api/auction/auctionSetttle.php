<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    include_once '../../config/Database.php';
    include_once '../../models/Auction.php';
 include_once '../../models/Bidding.php';

 if(isset($_POST['saleid']) && isset($_POST['price'])  && isset($_POST['token_id'])  && isset($_POST['owwerAddress'])){
              
         
    $saleid=$_POST['saleid'];
    $price=$_POST['price'];
    $token_id=$_POST['token_id'];
    $owner_id=$_POST['owwerAddress'];


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
  
    $Auctions = new Auction($db);
    $biddings = new Bidding($db);
   

   if($owner_id!="0x0000000000000000000000000000000000000000"){
   
  $transfer = $Auctions->update_owner($owner_id,$token_id);
   }
   
      
          
   
          
        //   exit();
          $settle = $Auctions->settleStatuslisting($saleid);
   
            $Biddingstatus = $biddings->settleStatus($saleid,$owner_id);
             $auctionoff = $Auctions->offSecondarySale($token_id);
   
       http_response_code(201);
       
        echo json_encode(
            array('message' => "NFT Tranfered")
               );
   
   
   
}
else{
        http_response_code(401);
    //  header("Status: 401 UNAUTHORIZED");
      echo json_encode(
          
            array('message' => "No request found")
        );
}
   