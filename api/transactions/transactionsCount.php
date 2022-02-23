<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

 include_once '../../config/Database.php';
 include_once '../../models/transactions.php';

  
$database = new Database();
$db = $database->connect();

  
//$nfts = new Nfts($db);
 $Transactions = new Transactions($db);

$result = $Transactions-> count_info();


//row count
$num = $result->rowCount();
header("Status: 200 OK");
            
echo json_encode(array(
                    "total"=>$num
                    ));
exit();

?>