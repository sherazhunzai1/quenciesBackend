<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    

    include_once '../../config/Database.php';
    include_once '../../models/Auction.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auction = new Auction($db);
   
    // Category read query
   
      $feature = $Auction->total_live_auction_arts();
     
     
//row count
$num = $feature->rowCount();
header("Status: 200 OK");
            
echo json_encode(array(
                    "total"=>$num
                    ));
exit();

?>
   