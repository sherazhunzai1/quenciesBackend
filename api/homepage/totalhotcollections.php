<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    

    include_once '../../config/Database.php';
     include_once '../../models/hot_collections.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
     $Hot_collections = new Hot_collections($db);
   
    // Category read query
   
     $total = $Hot_collections->read_total_hotColl_Arts();
     
     
//row count
$num = $total->rowCount();
header("Status: 200 OK");
            
echo json_encode(array(
                    "total"=>$num
                    ));
exit();

?>
   