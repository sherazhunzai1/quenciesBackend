<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

   
   include_once '../../../config/database.php';
   include_once '../../../config/constants.php';
   include_once '../../model/liveAuctions.php';
   include_once '../../../../models/likes.php';
   
   

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Features = new Live_Auction($db);
    $likes = new likes($db);
 
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
    /////// getting required data from models ////////
       $live = $Features-> readAllLiveAuction_Arts($start,12);
       $total = $Features->read_Total_LiveAuction_Arts();
      
     
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
   
   
    $result = $likes->getTotalLikes($row['feature_id']);
        $num = $result->rowCount();
        
         $endTime=(int) $row['endTimeInSeconds'];
        
       $cat_item=array(
           "listing_id" => $row['listing_id'],
           "id"=>$row['nft_id'],
           "art_name"=>$row['nft_name'],
            "art_price"=>$row['nft_price'],
            "description"=>$row['description'],
           "creator_walletAddress"=>$row['creator_id'],
           "creator_name"=>$row['creatorName'],
            "category_name"=>$row['nft_catagory'],
           "art_img"=>$row['image'],
                "action"=>$row['action'],
                 "like"=>$num,
             "views"=>$row['countViews'],
                "type"=>$row['type'],
             "highestBid"=>$row['highestBid'],
             "endTime"=>$endTime,
           );

    // Push to "data"
    array_push($cat_arr['liveAuction'], $cat_item);
  }

    
 echo json_encode($cat_arr);
  
   
         
 
   