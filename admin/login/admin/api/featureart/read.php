<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/database.php';
include_once '../../model/featureart.php';

$database = new Database();
$db = $database->connect();

$featureartworks = new Art($db);
$result = $featureartworks->read();


//row count
$num = $result->rowCount();

//checking post
if ($num>0) {
    //post array
    $featureartworks_arr = array();
    $featureartworks_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $featureartworks_item = array(
            'id' => $product_id,
            'sequence' => $sequence,
            'product_name' => $product_name,            
            'description' => $description,            
            'type' => $type,            
            'art_price' => $art_price,
            'image' => $image,
            // 'owner_id' => $owner_id,
            'creator_name' =>$username,
            // 'owner_id' => $owner_id,
            'owner_name' => $owner_username
        

        );
        
        
             array_push($featureartworks_arr['data'], $featureartworks_item);
        
        // push to data
       
    }

    //turn to JSON
    echo json_encode($featureartworks_arr);
}else{
    //No Post

    echo json_encode(
        array('message' => 'No data Found')
    );

}
?>