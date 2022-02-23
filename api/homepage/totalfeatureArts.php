<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    

    include_once '../../config/Database.php';
    include_once '../../models/Features.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
     $Features = new Features($db);
   
    // Category read query
   
       $total = $Features->read_Total_featureArts();
     
     
//row count
$num = $total->rowCount();
header("Status: 200 OK");
            
echo json_encode(array(
                    "total"=>$num
                    ));
exit();

?>
   