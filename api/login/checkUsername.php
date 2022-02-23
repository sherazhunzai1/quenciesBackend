 <?php

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
if (isset($_GET['userName'])) 
{
  
  
    include_once '../../config/Database.php';
    include_once '../../models/Login.php';
    

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $login = new Login($db);
    
 
    $userName = $_GET['userName'];

    // Category read query
    
   
 
 
//   $checkWallet = $login->check_login($wallet_address);
//   $check1 = $checkWallet->rowCount();
   
 
   $checkuserName = $login->checkuserName($userName);
   $check2 = $checkuserName->rowCount();
//   $checkEmail = $login->checkEmail($email);
//   $check3 = $checkEmail->rowCount();

if($check2 > 0){
    
    http_response_code(409);
    exit();
}
else{

    http_response_code(200);
    
}
    
}
