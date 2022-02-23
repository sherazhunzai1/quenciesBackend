<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Features.php';
include_once '../../models/constants.php';



$sequence=$_POST['sequence'];
$feature_id=$_POST['feature_id'];
$new_sequence=$sequence;

$database = new Database();
$db = $database->connect();

$featureart = new Features($db);

if($new_sequence = $sequence['feature_id']){

$result = $featureart->get_sequence_nfts($sequence);
while($row = $result->fetch(PDO::FETCH_ASSOC)){
   $sequence++;
   if($row['feature_id']!=$feature_id){
        $update=$featureart->update_sequence($row['feature_id'],$sequence);
   }
   else{
        $sequence--;
   }
}
$update=$featureart->update_sequence($feature_id,$new_sequence);
}
else{
$result = $featureart->get_sequence_nfts($sequence);
while($row = $result->fetch(PDO::FETCH_ASSOC)){
   $sequence--;
   if($row['feature_id']!=$feature_id){
        $update=$featureart->update_sequence($row['feature_id'],$sequence);
   }
   else{
        $sequence++;
   }
}
$update=$featureart->update_sequence($feature_id,$new_sequence);
}
// header("location:". BASE_URL ."admin/view/featureApro.php");
?>