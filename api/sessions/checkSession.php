<?php

// ini_set("display_errors", 1);
// Headers
  header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: * ");
    
    
  include_once '../../config/Database.php';
    include_once '../../models/Login.php';
    
    include_once '../../models/Sessions.php';
    require '../../models/vendor/autoload.php';
  use \Firebase\JWT\JWT;
    
   
   
   $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $login = new Login($db);
    

 
    
    if(isset($_POST['Authorization'])){
         $Authorization=$_POST['Authorization'];
        
        if(!empty($Authorization)){
        try{
             $secret_key = "owt125";

            $decodeddata = JWT::decode($Authorization, $secret_key,array('HS512'));
            // print_r($decodeddata);
          $new=$decodeddata->data;
   
              $data= array(
                    
                     'id'=>$new->id,
                    'walletAddress'=>$new->walletAddress,
                    'firstName'=>$new->firstName,
                    "lastName"=>$new->lastName,
                    "userName"=>$new->userName,
                    "email"=>$new->email,
                    "img"=>$new->img,
                    "cover"=>$new->cover,
                    "bio"=>$new->bio
                 
            );
                   $iss="localhost";
            $iat=time();
            $nbf=$iat;
            $exp=$iat + 1200;
            $aud="myusers";
                    $payload_info=array(
            "iss"=> $iss,
            "iat"=>$iat,
            "nbf"=> $nbf,
            "exp"=>$exp,
            "aud"=>$aud,
            "data"=>$data
            
            );
                    $jwt = JWT::encode($payload_info,$secret_key,'HS512');
                   
                 $data1= array(
                    'token'=>$jwt,
                     'id'=>$new->id,
                    'walletAddress'=>$new->walletAddress,
                    'firstName'=>$new->firstName,
                    "lastName"=>$new->lastName,
                    "userName"=>$new->userName,
                    "email"=>$new->email,
                    "img"=>$new->img,
                    "cover"=>$new->cover,
                    "bio"=>$new->bio
                   
                 
            
                  );    
           
        //   exit();
        http_response_code(200);
        //   header("Status: 200 OK");
         echo json_encode($data1
        );
        }
    
        catch(Exception $ex){
            http_response_code(401);
            //  header("Status:401 UNAUTHORIZED");
             echo json_encode(
            array(
               "status" => 0,
               "message" => $ex->getMessage()
                )
        );
        }
        
}
else{
    http_response_code(400);
    // header("Status:400 BAD REQUEST ");
}
}
else{
    http_response_code(400);
    // header("Status:404 NOT FOUND ");
}