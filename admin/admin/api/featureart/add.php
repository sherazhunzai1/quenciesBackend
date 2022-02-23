<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/database.php';

include_once '../../model/featureart.php';

$id=$_GET['id'];

$database = new Database();
$db = $database->connect();

$featureartworks = new Art($db);

$result = $featureartworks->add($id);


 
// exit();

if($result){
     header("Location:https://libertynft.org/admin/view/featureart.php");
     echo ("..");
 }
 else{
     header(" 401 Unauthorized");
     echo json_encode(
         array('message' => 'no request found')
     );
 }



