<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/Auction.php';
 
   
   
   if(isset($_POST['id']) && isset($_POST['tokenId']) && isset($_POST['ownerWallet']) && isset($_POST['txHash'])) 
   {
      

 $id = $_POST['id'];
$tokenId = $_POST['tokenId'];
$ownerWallet = $_POST['ownerWallet'];
$txHash = $_POST['txHash'];



    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
  
    // Instantiate category object
    $Auction = new Auction($db);
    



if($id!='' && $tokenId!='' && $ownerWallet!='' && $txHash!=''){

    $result = $Auction->fillPrimaryListing($id,$tokenId,$ownerWallet,$txHash);
   
    // listing off 
   $listingOff = $Auction->offListing($id);
  
    //sellOff function
   $saleOff = $Auction->offSale($id);
     http_response_code(201);
     echo json_encode(
            array(
                'tokenId' => $tokenId)
        );
    
    
    }
    else{
        http_response_code(400);
        
    }
       
   }
    else{
     http_response_code(400);

}
