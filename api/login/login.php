<?php
// Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
 
 
  include_once '../../config/Database.php';
    include_once '../../models/Login.php';
    
    include_once '../../models/Sessions.php';
    require '../../models/vendor/autoload.php';
  use \Firebase\JWT\JWT;

    
if (isset($_POST['email']) && isset($_POST['password'])) 
{
    
    
       
    $email=$_POST['email'];
    $password=$_POST['password'];
    $salt="1234567890.';asdfghjkl";
     $salt=md5($salt);
    $password=md5($password);
    $password=$salt.$password.$salt; 

   

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $login = new Login($db);
    
    $sessions = new Sessions($db);
   
//   exit();

    $result = $login->login($email,$password);
    
    // Get row count
    $num = $result->rowCount();
   
    // Check if any categories
    if ($num > 0) {
         $row = $result->fetch(PDO::FETCH_ASSOC);
      
        // jwd token  creation
        //iat: issued at = current time.
        //nbf: can use token just after issued.
        //exp:  token will expire after one day
        
            $iss="localhost";
            $iat=time();
            $nbf=$iat;
            $exp=$iat + 1200;
            $aud="myusers";
             $data=array('id'=>$row['id'],
                    'walletAddress'=>$row['wallet_address'],
                    'firstName'=>$row['firstName'],
                    "lastName"=>$row['lastName'],
                    "userName"=>$row['userName'],
                    "email"=>$row['email'],
                    "img"=>$row['img'],
                    "cover"=>$row['cover'],
                    "bio"=>$row['bio']
            );
            
            $secret_key = "owt125";
            
        $payload_info=array(
            "iss"=> $iss,
            "iat"=>$iat,
            "nbf"=> $nbf,
            "exp"=>$exp,
            "aud"=>$aud,
            "data"=>$data
            
            );
        
        $jwt = JWT::encode($payload_info,$secret_key,'HS512');
        
        
        $data1=array(
                    'token'=>$jwt,
                     'id'=>$row['id'],
                    'walletAddress'=>$row['wallet_address'],
                    'firstName'=>$row['firstName'],
                    "lastName"=>$row['lastName'],
                    "userName"=>$row['userName'],
                    "email"=>$row['email'],
                    "img"=>$row['img'],
                    "cover"=>$row['cover'],
                    "bio"=>$row['bio']
                 
            );
            
        
        
        
        
       http_response_code(200);
            //   header("Status: 200 OK");
               
            
        echo json_encode($data1);
        exit();
    } else {
       http_response_code(403);
    // header("Status: 403 FORBIDDEN");
      echo json_encode(
          
            array('message' => "Email or Password is incorrect")
        );
       exit();
       
       
    }
} else {
    http_response_code(401);
    // header("Status: 401 UNAUTHORIZED");
      echo json_encode(
          
            array('message' => "no request found")
        );
        exit();
}
