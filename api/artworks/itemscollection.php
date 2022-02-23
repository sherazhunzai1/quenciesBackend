<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

   
    include_once '../../config/Database.php';
    include_once '../../models/Auction.php';
    include_once '../../models/likes.php';
    
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auction = new Auction($db);
    $likes = new likes($db);
    // check the start and end variables are recieved or not ////
     
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
       $totalArts = $Auction-> itemsCollection($start,12);
       $total = $Auction-> total_itemsCollection();
      
       $totalcount = $total->rowCount();
        $totalpage=$totalcount/12;
       $totalpage=ceil( $totalpage);
     $currentpage=$end/12;
     $currentpage=ceil($currentpage);
     
         $cat_arr=array();
          $cat_arr['itemsCollection'] = array();
          $cat_arr['totalPages'] = $totalpage;
     $cat_arr['currentPage'] = $currentpage;

  
   while ($row = $totalArts->fetch(PDO::FETCH_ASSOC)) {
      
       // $result = $likes->getTotalLikes($nftId);
       //passing 'id'as a variable
       
        $result = $likes->getTotalLikes($row['id']);
        $num = $result->rowCount();
       $cat_item=array(
           "id"=>$row['nftId'],
           "nft_name"=>$row['nft_name'],
           "nft_description"=>$row['description'],
            "art_price"=>$row['nft_price'],
           "creator_name"=>$row['userName'],
          "creator_walletAddress"=>$row['wallet_address'],

            "category_name"=>$row['nft_catagory'],
             "creator_img"=>$row['img'],
           "art_img"=>$row['image'],
           "art_gif"=>$row['gif'],
           "start_time"=>$row['start_time'],
           "end_time"=>$row['end_time'],
            "like"=>$num,
             "views"=>$row['countViews'],
               "auction"=>$row['auction'],
                 "sell"=>$row['sell']);
    // Push to "data"
    
//   $checkA = $Auction->checkA($row['nftId']);
//         if($checkA){
            
//         }
        // else{
             array_push($cat_arr['itemsCollection'], $cat_item);
        }
//   }
   echo json_encode($cat_arr);
    
   
    



  
  
   