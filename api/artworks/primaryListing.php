<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/Auction.php';
 

   if(isset($_POST['id']) && isset($_POST['nft_price'])) 
   {
      

 $id = $_POST['id'];
$nft_price = $_POST['nft_price'];
// $sell = $_POST['sell'];



    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
  
    // Instantiate category object
    $Auction = new Auction($db);
    



if($id!='' && $nft_price!=''){

    $result = $Auction->updateSell($id,$nft_price);
    
    $set = $Auction->onList($id,$nft_price);
    //create function for listing set nftId, type = primary action = fixed\\price
     http_response_code(201);
     echo json_encode(
            array(
                'id' => $id,
               'art_price' => $nft_price)
        );
    
    
    }
    else{
        http_response_code(400);
        
    }
       
   }
    else{
     http_response_code(400);

}
