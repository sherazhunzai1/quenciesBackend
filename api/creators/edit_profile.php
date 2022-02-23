<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    

    include_once '../../config/Database.php';

    include_once '../../models/Creators.php';
    

 if(isset($_POST['id'])){
               
$id =  $_POST['id'];
$firstName =  $_POST['firstName'];
$lastName =  $_POST['lastName'];
$bio = $_POST['bio'];



    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
  
    $creator = new Creators($db);
  
   
    // Category read query
   

      $creators = $creator->update_profile($firstName,$lastName,$bio,$id);
      
    
      if($creators){
          echo json_encode(true);
          http_response_code(201);
      }
      else{
          echo json_encode(false);
      }

  
 }
 else{
      http_response_code(400);
     echo json_encode("no request found");
 }

   