<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/database.php';
include_once '../../model/nfts.php';

$database = new Database();
$db = $database->connect();

$nfts = new Nfts($db);

$result = $nfts->readimg();


//row count
$num = $result->rowCount();

//checking post
if ($num>0) {
    //post array
    $nfts_arr = array();
    $nfts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $nfts_item = array(
            'product_id' => $product_id,
            'product_name' => $product_name,            
            'description' => $description,            
            // 'type' => $type,            
            'art_price' => $art_price,
            'image' => $image,
            // 'creator_id' => $creator_id,
            'creator_name' =>$username,
            // 'owner_id' => $owner_id,
            'owner_name' => $owner_username
        

        );
        // https://libertynft.org/@al_sirang
        // https://libertynft.org/artwork/@sirang/JavaScript--158
        
             array_push($nfts_arr['data'], $nfts_item);
        
        // push to data
       
    }

    //turn to JSON
    echo json_encode($nfts_arr);
}else{
    //No Post

    echo json_encode(
        array('message' => 'No data Found')
    );

}
?>