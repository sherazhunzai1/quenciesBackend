<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

 include_once '../../config/Database.php';
    include_once '../../models/RCAs.php';
  
$database = new Database();
$db = $database->connect();

//$nfts = new Nfts($db);
 $RCAs = new RCA($db);
 

$result = $RCAs->getAllrcastotal();


//row count
$num = $result->rowCount();
header("Status: 200 OK");
            
echo json_encode(array(
                    "total"=>$num
                    ));
exit();

?>