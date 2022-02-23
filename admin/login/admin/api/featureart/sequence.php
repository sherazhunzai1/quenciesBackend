<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/database.php';
include_once '../../model/featureart.php';


$sequence=$_POST['sequence'];
$product_id=$_POST['productid'];
$new_sequence=$sequence;

$database = new Database();
$db = $database->connect();

$featureartworks = new Art($db);

if($new_sequence = $sequence){

$result = $featureartworks->get_sequence($sequence);
while($row = $result->fetch(PDO::FETCH_ASSOC)){
   $sequence++;
   if($row['product_id']!=$product_id){
        $update=$featureartworks->update_sequence($row['product_id'],$sequence);
   }
   else{
        $sequence--;
   }
}
$update=$featureartworks->update_sequence($product_id,$new_sequence);
}
else{
$result = $featureartworks->get_sequence($sequence);
while($row = $result->fetch(PDO::FETCH_ASSOC)){
   $sequence--;
   if($row['product_id']!=$product_id){
        $update=$featureartworks->update_sequence($row['product_id'],$sequence);
   }
   else{
        $sequence++;
   }
}
$update=$featureartworks->update_sequence($product_id,$new_sequence);
}
header("location:http://localhost/login/New%20folder/featureart.php");
?>