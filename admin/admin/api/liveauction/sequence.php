<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/database.php';
include_once '../../../config/constants.php';
include_once '../../model/nfts.php';


$sequence=$_POST['sequence'];
$id=$_POST['id'];
$new_sequence=$sequence;

$database = new Database();
$db = $database->connect();

$featureartworks = new Nfts($db);


if($new_sequence = $sequence['id']){

$result = $featureartworks->get_sequence($sequence);

while($row = $result->fetch(PDO::FETCH_ASSOC)){


   $sequence++;
  
   if($row['id']!=$id){
       
     
        $update=$featureartworks->update_sequence($row['id'],$sequence);
        
   }
   else{
        $sequence--;
   }
}
$update=$featureartworks->update_sequence($id,$new_sequence);
}
else{
$result = $featureartworks->get_sequence($sequence);
while($row = $result->fetch(PDO::FETCH_ASSOC)){
   $sequence--;
   if($row['id']!=$id){
        $update=$featureartworks->update_sequence($row['id'],$sequence);
   }
   else{
        $sequence++;
   }
}
$update=$featureartworks->update_sequence($id,$new_sequence);
}
header("location:".base_url."/admin/view/liveauction.php");
?>