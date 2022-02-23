<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/database.php';
include_once '../../model/nfts.php';

$database = new Database();
$db = $database->connect();

$nfts = new Nfts($db);

$result = $nfts->totalaudio();


//row count
$num = $result->rowCount();
header("Status: 200 OK");
            
echo json_encode(array(
                    "total"=>$num
                    ));
exit();

?>