<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/database.php';
include_once '../../../config/constants.php';
include_once '../../model/hot_collections.php';


$sequence=$_POST['sequence'];
$hot_coll_id=$_POST['hot_coll_id'];
$new_sequence=$sequence;

$database = new Database();
$db = $database->connect();

$featureartworks = new Hot_collections($db);


if($new_sequence = $sequence['hot_coll_id']){

$result = $featureartworks->get_sequence_nfts($sequence);

while($row = $result->fetch(PDO::FETCH_ASSOC)){


   $sequence++;
  
   if($row['hot_coll_id']!=$hot_coll_id){
       
     
        $update=$featureartworks->update_sequence($row['hot_coll_id'],$sequence);
        
   }
   else{
        $sequence--;
   }
}
$update=$featureartworks->update_sequence($hot_coll_id,$new_sequence);
}
else{
$result = $featureartworks->get_sequence_nfts($sequence);
while($row = $result->fetch(PDO::FETCH_ASSOC)){
   $sequence--;
   if($row['hot_coll_id']!=$hot_coll_id){
        $update=$featureartworks->update_sequence($row['hot_coll_id'],$sequence);
   }
   else{
        $sequence++;
   }
}
$update=$featureartworks->update_sequence($hot_coll_id,$new_sequence);
}
header("location:".base_url."admin/view/hotcollections.php");
?>