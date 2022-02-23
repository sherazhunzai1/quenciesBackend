 <?php

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['userName'])&& isset($_POST['wallet_address'])) 
{
  
  $userName = $_POST['userName'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $wallet_address = $_POST['wallet_address'];
    $email = $_POST['email'];
     $password = $_POST['password'];
    $password=md5($password);
    
    include_once '../../config/Database.php';
    include_once '../../models/Login.php';
    include_once '../../models/Owners.php';
    

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
 
    // Instantiate category object
    $login = new Login($db);
    $ownerss = new Owners($db);
   

 
    
    // Category read query
  
  $result = $login->signup($userName,$password,$email,$firstName,$lastName,$wallet_address);
     

$result2 = $ownerss->owners_signup($userName,$password,$email,$firstName,$lastName,$address);
 
    // Check if any categories
    if ($result2) {
        echo json_encode(
            array('owners_signup' => true,
              "message"=>"user has been registered successfully")
        );
    } else {
        // No Categories
        echo json_encode(
            array('owners_signup' => false,
              "message"=>"error in signup")
        );
    }

}
else{
      echo json_encode(
            array('message' => "No parameters passed")
        );
}