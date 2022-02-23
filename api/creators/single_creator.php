<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
   
    
if (isset($_GET['userName'])) 
{
    // Headers
    

    include_once '../../config/Database.php';
    include_once '../../models/Creators.php';
    include_once '../../models/Auction.php';
        include_once '../../models/Auctions.php';
     
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
    
    // Instantiate category object
    $creators = new Creators($db);
    $createdArts  = new Auction($db);
    $collect_auction = new Auctions($db);   
    
    
   
    $username = $_GET['userName'];
 
    // Category read query
//   $id=$creators->get_userid($username);
 $id=$creators->get_useraddress($userName);
    $result = $creators->single_creator($id);

    // Get row count
    $num = $result->rowCount();

    // Check if any categories
    if ($num > 0) {
     
        $cat_arr=array();
        $cat_arr['creatorDetails']=array();
        $cat_arr['createdArts']=array();
        $cat_arr['collectedArts']=array();
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
     

        
      

    // Push to "data"
    array_push($cat_arr['creatorDetails'], $row);
  }
  

     $arts=$createdArts->arts_by_creators($id);
    
    while ($row = $arts->fetch(PDO::FETCH_ASSOC)) {
          
$difference_in_seconds = (strtotime($row['end_time'])*1000) - (strtotime($row['CURRENT_TIMESTAMP()'])*1000);

       $cat_item=array(
          "id"=>$row['id'],
          "art_name"=>$row['nft_name'],
          "creator_name"=>$row['userName'],
            "creator_img"=>$row['img'],
            "creator_walletAddress"=>$row['wallet_address'],
            "owner_name"=>$row['owner_userName'],
            "owner_img"=>$row['owner_img'],
            "owner_walletAddress"=>$row['owner_walletAddress'],
          "art_img"=>$row['image'],
          "art_gif"=>$row['gif'],
          "start_time"=>$row['start_time'],
            "nft_price"=>$row['nft_price'],
          "end_time"=>$difference_in_seconds,
           "higgestBid" => $row['max(b.price)']);
    // Push to "data"
    array_push($cat_arr['createdArts'], $cat_item);
  }
       
        $collection=$createdArts->collections($id);
          
       while ($row = $collection->fetch(PDO::FETCH_ASSOC))
       {
               
$difference_in_seconds = (strtotime($row['end_time'])*1000) - (strtotime($row['CURRENT_TIMESTAMP()'])*1000);

       $cat_item=array(
          "id"=>$row['id'],
          "art_name"=>$row['nft_name'],
          "creator_name"=>$row['userName'],
            "creator_img"=>$row['img'],
            "creator_walletAddress"=>$row['wallet_address'],
            "owner_name"=>$row['owner_userName'],
            "owner_img"=>$row['owner_img'],
            "owner_walletAddress"=>$row['owner_walletAddress'],
          "art_img"=>$row['image'],
          "art_gif"=>$row['gif'],
          "start_time"=>$row['start_time'],
            "nft_price"=>$row['nft_price'],
          "end_time"=>$difference_in_seconds,
           "higgestBid" => $row['max(b.price)']);
    // Push to "data"
    array_push($cat_arr['collectedArts'], $cat_item);
        
       }
       
        
        echo json_encode(
            array('creator' => true,
                  'data'=>$cat_arr)
        );
        
        
        
    } else {
        // No Categories
        echo json_encode(
            array(
                "creator"=>false,
            "message"=>"No data Found")
        );
    }
} else {
    echo json_encode(
        array('message' => "bes k atoxa")
    );
}
