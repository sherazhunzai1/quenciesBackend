<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/database.php';
include_once '../../model/featureart.php';

$database = new Database();
$db = $database->connect();

$featureartworks = new Art($db);
$result = $featureartworks->total();


//row count
$num = $result->rowCount();
header("Status: 200 OK");
            
echo json_encode(array(
                    "total"=>$num
                    ));
exit();

?>