<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    
 if(isset($_GET['rcaId'])) {
      $rcaId=$_GET['rcaId'];
       
      
    include_once '../../config/Database.php';
    include_once '../../models/RCAs.php';
  
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $RCAs = new RCA($db);
   
    // Category read query
   
      $feature = $RCAs->delete( $rcaId);

// $cat_arr = array();
           
  if($feature){
 echo json_encode("Item deleted");
 header('Location: http://quencies.alshumaal.com/admin/view/dashboard.php'); exit();
 }
  
   else{
        
         echo json_encode(http_response_code(401));
}

}
   