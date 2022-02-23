 <?php

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['userName'])&& isset($_POST['wallet_address'])) 
{
  
  
    include_once '../../config/Database.php';
    include_once '../../models/Login.php';
    

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $login = new Login($db);
    
 
    $userName = $_POST['userName'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $wallet_address = $_POST['wallet_address'];
    $email = $_POST['email'];
     $password = $_POST['password'];
     $salt="1234567890.';asdfghjkl";
     $salt=md5($salt);
    $password=md5($password);
    $password=$salt.$password.$salt;
    // Category read query
    
   
 
 
   $checkWallet = $login->check_login($wallet_address);
   $check1 = $checkWallet->rowCount();
   
 
   $checkuserName = $login->checkuserName($userName);
   $check2 = $checkuserName->rowCount();
   $checkEmail = $login->checkEmail($email);
   $check3 = $checkEmail->rowCount();

if($check1 || $check2 || $check3 > 0){
    
    http_response_code(409);
}
else{
      
    $result1 = $login->signup($userName,$password,$email,$firstName,$lastName,$wallet_address);
    // Check if any categories
    if ($result1) {
        http_response_code(201);

        echo json_encode(
            array('signup' => true,
               "message"=>"user has been registered successfully")
        );
    } else 
    {
        http_response_code(409);

        // No Categories
        echo json_encode(
            array('signup' => false,
               "message"=>"error in signup")
        );
    }
}
}
else{
    http_response_code(400);

      echo json_encode(
            array('message' => "No parameters passed")
        );
}
