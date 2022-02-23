<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 require '../../models/vendor/autoload.php';
  use \Firebase\JWT\JWT;


if (isset($_POST['address']) && $_POST['address'] != "")
{

    $address = $_POST['address'];

    include_once '../../config/Database.php';

    include_once '../../models/Login.php';
    
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $login = new Login($db);
    $result = $login->check_login($address);

    // Get row count
    $num = $result->rowCount();

  
    // Check if any categories
    if ($num > 0)
    {
        $row = $result->fetch(PDO::FETCH_ASSOC);

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
    }
    else
    {
      
            
              $salt=md5("1234567890.';asdfghjkl");
        $passwordHash=$salt.md5($address).$salt;
        
        $signup = $login->signupWithWallet($address);
        
        $id = $db->lastInsertId();
        // $signup = $login->owners_signup($address);
        
        $result = $login->get_user($id);
        $row = $result->fetch(PDO::FETCH_ASSOC);



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
                    "bio"=>$row['bio']);
        echo json_encode($data);

      
      
    }
}
else
{
    http_response_code(400);
    echo json_encode(array(
        'message' => "no request"
    ));
}

