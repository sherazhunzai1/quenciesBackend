<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
   
    
if (isset($_GET['token'])) 
{
    // Headers
    

    include_once '../../config/Database.php';
     include_once '../../models/Sessions.php';
       include_once '../../models/Creators.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
     $user = new Creators($db);
    // Instantiate category object
  
    $session=new Sessions($db);
    $tocken = $_GET['token'];
  
    // Category read query
    $result = $session->check_session($tocken);

    // Get row count
    $num = $result->rowCount();

    // Check if any categories
    if ($num > 0) {
         $row = $result->fetch(PDO::FETCH_ASSOC);
         
         $userdata = $user->single_creator($row['user_id']);
       
         $userdata = $userdata->fetch(PDO::FETCH_ASSOC);
         
        echo json_encode(
            array('session' => true,
                  'userData'=>$userdata)
        );
    } else {
        // No Categories
        header("status: 404 NOT FOUND");
        echo json_encode(
            array('session' => false,
            "message"=>"session is invalid or ended"
            )
        );
    }
} else {
    header("status: 403 FORBIDDEN");
    echo json_encode(
        array('message' => "no request found")
    );
}
