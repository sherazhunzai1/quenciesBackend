<?php

header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    
 if(isset($_GET['id'])) {
   $id=$_GET['id'];
       

    // Headers
   include_once '../../config/Database.php';
    include_once '../../models/transactions.php';

 
$database = new Database();
$db = $database->connect();

//class name 
$Transactions = new Transactions($db); 



// Category read query
   
      $feature = $Transactions->delete($id);
if($feature){
 echo json_encode("Item deleted");
//  header('Location: http://quencies.alshumaal.com/admin/view/dashboard.php'); exit();
 }

  
   else{
        
         echo json_encode(http_response_code(401));


}}
   