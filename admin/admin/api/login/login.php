<?php
session_start();
// Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
   
    
if (isset($_POST['username']) && isset($_POST['password'])) 
{
    
    
    $email=$_POST['username'];
    // $password= test;
    $password=$_POST['password'];
    $salt="1234567890.';asdfghjkl";
     $salt=md5($salt);
    $password=md5($password);
    $password=$salt.$password.$salt;
    
    // echo $password;
    // exit();


    include_once '../../../config/database.php';
     include_once '../../../config/constants.php';
    include_once '../../model/admin.php';


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();


    // Instantiate category object
    $login = new Admin($db);
    
   
    $result = $login->login($email,$password);
    
 
    // Get row count
    $num = $result->rowCount();

    // Check if any categories
    if ($num > 0) {
         $row = $result->fetch(PDO::FETCH_ASSOC);
      
        // $data=array(
        //             'login'=>true,
        //             'id'=>$row['id'],
        //             "username"=>$row['username']
                   
        //     );
        //       $_SESSION['username'] = $email;
               $_SESSION['user']=$row['username'];
          
             header("Location:".base_url. "admin/view/dashboard.php"); 
               
            
        echo json_encode($data);
        exit();
    } else {
              
        $_SESSION['error']="username or Password is incorrect";
            header("Location:".base_url."admin/view/login.php");
         exit();
    }
} else {
    header("Status: 401 UNAUTHORIZED");
      echo json_encode(
          
            array('message' => "no request found")
        );
        exit();
}
