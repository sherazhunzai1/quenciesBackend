<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

   
    include_once '../../../config/database.php';
     include_once '../../../config/constants.php';
    include_once '../../model/hot_collections.php';
    include_once '../../../../models/likes.php';
 
 
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Hot_collections = new Hot_collections($db);
     
    $likes = new likes($db);

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
       $live = $Hot_collections->readAll_hotColl_Arts($start,12);

      $total = $Hot_collections->read_total_hotColl_Arts();

       $totalcount = $total->rowCount();
        $totalpage=$totalcount/12;
       $totalpage=ceil( $totalpage);
     $currentpage=$end/12;
     $currentpage=ceil($currentpage);
     
     $cat_arr = array();
     
    
   $cat_arr['hotCollection'] = array();
    $cat_arr['totalPages'] = $totalpage;
     $cat_arr['currentPage'] = $currentpage;
      
        while ($row = $live->fetch(PDO::FETCH_ASSOC)) {
   
       $result = $likes->getTotalLikes($row['hot_coll_id']);
        $num = $result->rowCount();
        $endTime=(int) $row['endTimeInSeconds'];
       $cat_item=array(
           "hot_coll_id"=>$row['hot_coll_id'],
             "id"=>$row['nft_id'],
           "art_name"=>$row['nft_name'],
            "art_price"=>$row['nft_price'],
            "description"=>$row['description'],
           "creator_walletAddress"=>$row['creator_id'],
           "creator_name"=>$row['creatorName'],
            "category_name"=>$row['nft_catagory'],
           "art_img"=>$row['image'],
                "sequence"=>$row['sequence'],
                 "like"=>$num,
             "views"=>$row['countViews'],
               "listingType"=>$row['listingType'],
             "highestBid"=>$row['highestBid'],
             "endTime"=>$endTime,
           );

    // Push to "data"
    array_push($cat_arr['hotCollection'], $cat_item);
  }

    
 echo json_encode($cat_arr);
  
 
         
 
   