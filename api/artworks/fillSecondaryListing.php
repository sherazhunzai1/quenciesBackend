<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/Auction.php';
 
   
  
   if(isset($_POST['saleid']) && isset($_POST['tokenId']) && isset($_POST['ownerWallet']) && isset($_POST['txHash'])) 
   {
      

 $saleid = $_POST['saleid'];
$tokenId = $_POST['tokenId'];
$ownerWallet = $_POST['ownerWallet'];
$txHash = $_POST['txHash'];



    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
  
    // Instantiate category object
    $Auction = new Auction($db);

 
    $result = $Auction->fillsecondaryListing($tokenId,$ownerWallet);
    

     $listingOff = $Auction->offSecondaryListing($tokenId);
     $saleoff = $Auction->offSecondarySale($tokenId);
    
    //sellOff function
  
     http_response_code(201);
     echo json_encode(
            array(
                'tokenId' => $tokenId)
        );
    
    
   
       
   }
    else{
        echo "test";
     http_response_code(400);

}
