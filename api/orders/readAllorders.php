<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers

       
   include_once '../../config/Database.php';
   include_once '../../models/order.php';

  
$database = new Database();
$db = $database->connect();

 
//$nfts = new Nfts($db);
 $Orders = new Orders($db);
   
    // Category read query
    
    if(isset($_GET['pageno'])){
           if($_GET['pageno']==1){
               $start=0;
           $end=12;
           }
           else{
                $end=((($_GET['pageno'])*12));
            $start=($end-12);
           }
           }
           else{
         $start=0;
           $end=12;
           }
//   exit();
      $result = $Orders->getAllOrder($start,12);
       $total = $Orders->total_getAllOrder();
       
        $totalcount = $total->rowCount();
        $totalpage=$totalcount/12;
       $totalpage=ceil( $totalpage);
     $currentpage=$end/12;
     $currentpage=ceil($currentpage);
 
$cat_arr=array();
$cat_arr['totalPages'] = $totalpage;
$cat_arr['currentPage'] = $currentpage;

            
 $cat_arr['getallOrders'] = array();
          
  
   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
         
        
       $cat_item=array(
           "order_id"=>$row['order_id'],
          "customer_name"=>$row['customer_name'],
          "order_total_amount"=>$row['order_total_amount'],
          "phoneNo"=>$row['phoneNo'],
           "customer_city"=>$row['customer_city'],
          "customer_state"=>$row['customer_state'],
          "customer_address"=>$row['customer_address'],
          "zip"=>$row['zip'],
          "rca_id"=>$row['rca_id'],
          "rcaName"=>$row['title'],
          "rcaPrice"=>$row['price'],
          "description"=>$row['description'],
         "created_at"=>$row['created_at'],
          
            
           );

      // Push to "data"
    array_push($cat_arr['getallOrders'], $cat_item);
  } 
   echo json_encode($cat_arr);
    

   