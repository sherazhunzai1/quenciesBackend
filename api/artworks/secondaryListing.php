<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/Auction.php';
 
   
   
   if(isset($_POST['tokenid']) && isset($_POST['price'])) 
   {
      

 $tokenid = $_POST['tokenid'];
$price = $_POST['price'];
$txHash = $_POST['txHash'];
$saleId = $_POST['saleId'];
$nft_id = $_POST['nft_id'];



    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
  
    // Instantiate category object
    $Auction = new Auction($db);
    
    //  $result = $Auction->onListing($tokenid,$price);

    $result = $Auction->secondaryListing($nft_id,$tokenid,$price,$txHash,$saleId);
    
    $putOnSale= $Auction->onSale($tokenid);
    
   
     http_response_code(201);
     echo json_encode(
            array(
                'nft_id'=>$nft_id,
                'tokenid' => $tokenid,
               'price' => $price,
               "txHash"=>$txHash,
               "saleId"=>$saleId)
        );
    
    
    
       
   }
    else{
     http_response_code(400);

}
