<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/database.php';
include_once '../../../config/constants.php';
include_once '../../model/Features.php';


$sequence=$_POST['sequence'];
$feature_id=$_POST['feature_id'];
$new_sequence=$sequence;

$database = new Database();
$db = $database->connect();

$featureartworks = new Features($db);


if($new_sequence = $sequence['feature_id']){

$result = $featureartworks->get_sequence_nfts($sequence);

while($row = $result->fetch(PDO::FETCH_ASSOC)){


   $sequence++;
  
   if($row['feature_id']!=$feature_id){
       
     
        $update=$featureartworks->update_sequence($row['feature_id'],$sequence);
        
   }
   else{
        $sequence--;
   }
}
$update=$featureartworks->update_sequence($feature_id,$new_sequence);
}
else{
$result = $featureartworks->get_sequence_nfts($sequence);
while($row = $result->fetch(PDO::FETCH_ASSOC)){
   $sequence--;
   if($row['feature_id']!=$feature_id){
        $update=$featureartworks->update_sequence($row['feature_id'],$sequence);
   }
   else{
        $sequence++;
   }
}
$update=$featureartworks->update_sequence($feature_id,$new_sequence);
}
header("location:".base_url."admin/view/featuresArtwork.php");
?>