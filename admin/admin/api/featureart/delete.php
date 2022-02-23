<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

   include_once '../../../config/database.php';
   include_once '../../model/Features.php';
   include_once '../../../config/constants.php';

$database = new Database();
$db = $database->connect();

$id=$_GET['id'];
$featureartworks = new Features($db);
$result = $featureartworks->delete($id);



 if($result){
    //  header("Location:". base_url ."admin/view/dashboard.php");
     echo ("Deleted....");
 }
 else{
     header(" 401 Unauthorized");
     echo json_encode(
         array('message' => 'no request found')
     );
 }

