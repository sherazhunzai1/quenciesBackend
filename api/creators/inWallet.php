<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
 
   
    include_once '../../config/Database.php';
     include_once '../../models/Creators.php';
     include_once '../../models/likes.php';
     
 if(isset($_GET['username']))
    { 
        
        $username=$_GET['username'];
        
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $Auction = new Creators($db);
    $likes = new likes($db);
   
   //create new function to get walletAddres by username \\ creators
   $userid = $Auction->get_useraddress($username);
   
  
    // check the start and end variables are recieved or not ////
    
 //get owner from nfts
    /////// getting required data from models ////////
       $inwallet = $Auction->inwallet($userid);
          $cat_arr=array();
          $cat_arr['collected'] = array();
          
while($row = $inwallet->fetch(PDO::FETCH_ASSOC))
{
    
  
$result = $likes->getTotalLikes($row['id']);
        $num = $result->rowCount();
       $cat_item=array(
           "id"=>$row['id'],
           "art_name"=>$row['nft_name'],
            "art_price"=>$row['nft_price'],
            "art_description"=>$row['description'],
           "owner_name"=>$row['ownerName'],
           "owner_wallet"=>$row['ownerWallet'],
           "owner_img"=>$row['ownerImg'],
           "creator_name"=>$row['creatorName'],
           "creator_wallet"=>$row['creatorWallet'],
            "category_name"=>$row['nft_catagory'],
             "creator_img"=>$row['creatorImg'],
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
   array_push($cat_arr['collected'],$cat_item);
}
 
   echo json_encode($cat_arr);
    
    }
    else
    {
         http_response_code(401);
    
    }
    