<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../model/Auction.php';
include_once '../../models/constants.php';

$database = new Database();
$db = $database->connect();
$id=$_GET['id'];
$featureart = new Auction($db);

$result = $featureart->delete($id);

 if($result){
     header("Location:". base_url ."admin/view/dashboard.php");
     echo ("Deleted....");
 }
 else{
     http_response_code(401);
    //  header(" 401 Unauthorized");
     echo json_encode(
         array('message' => 'no request found')
     );
 }

