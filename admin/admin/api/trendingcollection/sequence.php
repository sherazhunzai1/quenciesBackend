<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/database.php';
include_once '../../../config/constants.php';
include_once '../../model/nfts.php';



$sequence=$_POST['sequence'];
$trending_coll_id=$_POST['trending_coll_id'];
$new_sequence=$sequence;

$database = new Database();
$db = $database->connect();

$featureartworks = new Nfts($db);


if($new_sequence = $sequence['trending_coll_id']){

$result = $featureartworks->get_sequence($sequence);

while($row = $result->fetch(PDO::FETCH_ASSOC)){


   $sequence++;
  
   if($row['trending_coll_id']!=$trending_coll_id){
       
     
        $update=$featureartworks->update_sequence($row['trending_coll_id'],$sequence);
        
   }
   else{
        $sequence--;
   }
}
$update=$featureartworks->update_sequence($trending_coll_id,$new_sequence);
}
else{
$result = $featureartworks->get_sequence($sequence);
while($row = $result->fetch(PDO::FETCH_ASSOC)){
   $sequence--;
   if($row['trending_coll_id']!=$trending_coll_id){
        $update=$featureartworks->update_sequence($row['trending_coll_id'],$sequence);
   }
   else{
        $sequence++;
   }
}
$update=$featureartworks->update_sequence($trending_coll_id,$new_sequence);
}
header("location:".base_url."admin/view/trendingcollections.php");
?>