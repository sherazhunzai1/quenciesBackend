<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/trendingcollections.php';
include_once '../../models/constants.php';



$sequence=$_POST['sequence'];
$trending_coll_id=$_POST['trending_coll_id'];
$new_sequence=$sequence;

$database = new Database();
$db = $database->connect();

$featureart = new Trending_collections($db);

if($new_sequence = $sequence['trending_coll_id']){

$result = $featureart->get_sequence_nfts($sequence);
while($row = $result->fetch(PDO::FETCH_ASSOC)){
   $sequence++;
   if($row['trending_coll_id']!=$trending_coll_id){
        $update=$featureart->update_sequence($row['trending_coll_id'],$sequence);
   }
   else{
        $sequence--;
   }
}
$update=$featureart->update_sequence($trending_coll_id,$new_sequence);
}
else{
$result = $featureart->get_sequence_nfts($sequence);
while($row = $result->fetch(PDO::FETCH_ASSOC)){
   $sequence--;
   if($row['trending_coll_id']!=$trending_coll_id){
        $update=$featureart->update_sequence($row['trending_coll_id'],$sequence);
   }
   else{
        $sequence++;
   }
}
$update=$featureart->update_sequence($trending_coll_id,$new_sequence);
}

header("location:".base_url."/admin/view/trendingcollections.php");
?>