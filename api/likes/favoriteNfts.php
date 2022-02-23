<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
 
   
    include_once '../../config/Database.php';
     include_once '../../models/Creators.php';
     include_once '../../models/likes.php';
     
 if(isset($_GET['creator_id']))
    { 
        
        $creator_id=$_GET['creator_id'];
        
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auction = new Creators($db);
    $likes = new likes($db);
         
         $liked=$likes->Likednfts($creator_id);
         
          $cat_arr=array();
          $cat_arr['favorite'] = array();
          
while($row = $liked->fetch(PDO::FETCH_ASSOC))
{
    
  
$result = $likes->getTotalLikes($row['id']);
        $num = $result->rowCount();
        
       $cat_item=array(
           "id"=>$row['id'],
           "nft_name"=>$row['nft_name'],
            "art_price"=>$row['nft_price'],
            "art_description"=>$row['description'],
           "owner_name"=>$row['ownerName'],
            "category_name"=>$row['nft_catagory'],
             "owner_img"=>$row['ownerImg'],
           "art_img"=>$row['artImg'],
           "art_gif"=>$row['gif'],
           "start_time"=>$row['start_time'],
           "end_time"=>$row['end_time'],
            "like"=>$num,
             "views"=>$row['countViews'],
               "auction"=>$row['auction'],
                 "sell"=>$row['sell']
        );
    // Push to "data"
   array_push($cat_arr['favorite'],$cat_item);
}
 
   echo json_encode($cat_arr);
    
    }
    else
    {
         http_response_code(401);
    
    }
    