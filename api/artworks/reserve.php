<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    

    include_once '../../config/Database.php';
      
    include_once '../../models/Auction.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auction = new Auction($db);
   
     if(isset($_GET['pageno'])){
               
           $end=((($_GET['pageno'])*4)-1);
            $start=($end-3);
               
           }
           else{
         $start=0;
           $end=3;
           }
    // Category read query
    
    
     
    //   $sold = $Auction->sold_arts();
        $reserved = $Auction->reserved_arts($start,4);
        $total = $Auction->total_reserved_arts();
    //   $live = $Auction->live_auction_arts();
       $totals = $total->rowCount();
        $totalpage=$totals/4;
       $totalpage=ceil($totalpage);
     $currentpage=$end/4;
     $currentpage=ceil($currentpage);
       
       
       
       
       
       $cat_arr = array();
  
//   $cat_arr['liveAuction'] = array();
//   $cat_arr['soldArt'] = array();
   $cat_arr['reservedArt'] = array();
 $cat_arr['totalReservedArt'] = $totals;
  $cat_arr['totalPages'] = $totalpage;
    $cat_arr['currentPage'] = $currentpage;

  
   while ($row = $reserved->fetch(PDO::FETCH_ASSOC)) {
     
$difference_in_seconds = (strtotime($row['end_date'])*1000) - (strtotime($row['CURRENT_TIMESTAMP()'])*900);
        
       $cat_item=array(
           "id"=>$row['product_id'],
           "art_name"=>$row['product_name'],
           "creator_name"=>$row['name'],
            "category_name"=>$row['category_title'],
            "creator_img"=>$row['img'],
           "art_img"=>$row['image'],
           "art_gif"=>$row['gif'],
           "start_date"=>$row['start_date'],
           "end_date_in_milliseconds"=>$difference_in_seconds);

    // Push to "data"
    array_push($cat_arr['reservedArt'], $cat_item);
  }
    
 echo json_encode($cat_arr);
  
  

   