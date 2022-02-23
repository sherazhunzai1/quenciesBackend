<?php
 header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    
if(isset($_GET['id'])){
     
$id=$_GET['id'];
    include_once '../../config/Database.php';
    include_once '../../models/Notification.php';
    
   

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
  
    $notification = new Notification($db);
     
    // Category read query
    
      $settle = $notification->settle_notification($id);
      if($settle){
          
          
          http_response_code(200);
      }
      else{
           http_response_code(400);
      }
}
// }
else{
      http_response_code(401);
    
}