<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers

   include_once '../../../config/database.php';
   include_once '../../model/liveAuctions.php';
   include_once '../../../config/constants.php';
   
   
   $database = new Database();
   $db = $database->connect();
  
  
  // Instantiate category object
    $Auction = new Live_Auction ($db);
   
    // Category read query
   
      $feature = $Auction->read_Total_LiveAuction_Arts();
     
     
//row count
$num = $feature->rowCount();
header("Status: 200 OK");
            
echo json_encode(array(
                    "total"=>$num
                    ));
exit();

?>