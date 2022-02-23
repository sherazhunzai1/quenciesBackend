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
           
      $feature = $Auction->feature_arts($start,12);
     $total = $Auction->read_Total_featureArts();
     
     $totalcount = $total->rowCount();
        $totalpage=$totalcount/12;
       $totalpage=ceil( $totalpage);
     $currentpage=$end/12;
     $currentpage=ceil($currentpage);
     
       $cat_arr = array();

   $cat_arr['feature'] = array();
   $cat_arr['totalPages'] = $totalpage;
     $cat_arr['currentPage'] = $currentpage;

           
  
   while ($row = $feature->fetch(PDO::FETCH_ASSOC)) {
     
//$difference_in_seconds = (strtotime($row['end_time'])*1000) - (strtotime($row['CURRENT_TIMESTAMP()'])*900);
        
        $result = $likes->getTotalLikes($row['id']);
        $num = $result->rowCount();
       $cat_item=array(
           "id"=>$row['id'],
           "art_name"=>$row['nft_name'],
            "art_price"=>$row['nft_price'],
            "art_description"=>$row['description'],
           "creator_name"=>$row['userName'],
            "category_name"=>$row['nft_catagory'],
             "creator_img"=>$row['img'],
           "art_img"=>$row['image'],
           "art_gif"=>$row['gif'],
           "start_time"=>$row['start_time'],
           "end_time"=>$row['end_time'],
            "like"=>$num,
             "views"=>$row['countViews'],
              
                "sequence"=>$row['sequence'],
                 
           );

    // Push to "data"
    array_push($cat_arr['feature'], $cat_item);
  }

    
 echo json_encode($cat_arr);
  
  

   