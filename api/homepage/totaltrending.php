<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    

    include_once '../../config/Database.php';
   include_once '../../models/trendingcollections.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
     $Trending_collections = new Trending_collections($db);
   
    // Category read query
   
      $feature = $Trending_collections->read_total_trendingCollArts();
     
     
//row count
$num = $feature->rowCount();
header("Status: 200 OK");
            
echo json_encode(array(
                    "total"=>$num
                    ));
exit();

?>
   