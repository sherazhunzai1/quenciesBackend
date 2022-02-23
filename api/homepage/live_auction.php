<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    

    include_once '../../config/Database.php';
    include_once '../../models/Auction.php';
    include_once '../../models/likes.php';
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auction = new Auction($db);
      $likes = new likes($db);
    // Category read query
    
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
 
       $live = $Auction->live_auction_arts($start,12);
       $total = $Auction->total_live_auction_arts();
       
        $totalcount = $total->rowCount();
        $totalpage=$totalcount/12;
       $totalpage=ceil( $totalpage);
     $currentpage=$end/12;
     $currentpage=ceil($currentpage);
      
       $cat_arr = array();
   $cat_arr['liveAuction'] = array();
$cat_arr['totalPages'] = $totalpage;
     $cat_arr['currentPage'] = $currentpage;

 

    while ($row = $live->fetch(PDO::FETCH_ASSOC)) {
     
//$difference_in_seconds = (strtotime($row['end_time'])*1000) - (strtotime($row['CURRENT_TIMESTAMP()'])*900);
        
       $result = $likes->getTotalLikes($row['id']);
        $num = $result->rowCount();
       $cat_item=array(
          "id"=>$row['id'],
          "art_name"=>$row['nft_name'],
           "art_description"=>$row['description'],
          "creator_name"=>$row['creatorName'],
             "creator_img"=>$row['img'],
            "creator_walletAddress"=>$row['wallet_address'],
          "art_img"=>$row['image'],
          "art_gif"=>$row['gif'],
          "start_time"=>$row['start_time'],
          "end_time"=>$row['end_time'],
            "art_price"=>$row['nft_price'],
            "like"=>$num,
             "views"=>$row['countViews'],
               "auction"=>$row['auction'],
               "sequence"=>$row['sequence'],
                 "sell"=>$row['sell']);

    // Push to "data"
    array_push($cat_arr['liveAuction'], $cat_item);
  }
  
    
 echo json_encode($cat_arr);
  
  

   