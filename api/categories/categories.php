<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

   
    if(isset($_GET['id'])){
    $id=$_GET['id'];
    
    
    include_once '../../config/Database.php';
     include_once '../../models/Categories.php';
include_once '../../models/likes.php';
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Categories = new Categories($db);
   $likes = new likes($db);
    // check the start and end variables are recieved or not ////
     
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
       $live = $Categories->getCategories($id,$start,12);

   $total = $Categories->getCategoriesCount($id);
    
     $totalcount = $total->rowCount();
   
        $totalpage=$totalcount/12;
     
       $totalpage=ceil( $totalpage);
     $currentpage=$end/12;
     $currentpage=ceil($currentpage);

      
         $cat_arr=array();
         $cat_arr['categoriesByname'] = array();
          $cat_arr['totalPages'] = $totalpage;
     $cat_arr['currentPage'] = $currentpage;
      
 while ($row = $live->fetch(PDO::FETCH_ASSOC)) {
     
    //$difference_in_seconds = (strtotime($row['end_date'])*1000) - (strtotime($row['CURRENT_TIMESTAMP()'])*1000);
       
      $result = $likes->getTotalLikes($row['id']);
        $num = $result->rowCount();
       $cat_item=array(
          "id"=>$row['nftId'],
          "art_name"=>$row['nft_name'],
          "category_name"=>$row['category_name'],
          "category_id"=>$row['nft_catagory_id'],
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
            //   "auction"=>$row['auction'],
            //      "sell"=>$row['sell']
          );
          
 
    // Push to "data"
   
    array_push($cat_arr['categoriesByname'], $cat_item);
    }
  echo json_encode($cat_arr);
    }

else{
     
         echo json_encode(http_response_code(401));
           }

    



  
  
   