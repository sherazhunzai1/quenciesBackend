<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/Auction.php';
 
   if(isset($_POST['id'])  && isset($_POST['nft_price']) && isset($_POST['nft_catagory_id']) && isset($_POST['start_time']) && isset($_POST['end_time']) ) {
  
$id=$_POST['id'];
$nft_price=$_POST['nft_price'];
$nft_catagory_id=$_POST['nft_catagory_id'];
$start_time=$_POST['start_time'];
$end_time=$_POST['end_time'];

 


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
  
    // Instantiate category object
    $Auction = new Auction($db);
    
  
              /////// getting required data from models ////////
       $live = $Auction->setOffer($id,$nft_price,$nft_catagory_id,$start_time,$end_time);
      
//       $cat_arr = array();
//   $cat_arr['Auction'] = array();
//     while ($row = $live->fetch(PDO::FETCH_ASSOC)) {
      
// $difference_in_seconds = (strtotime($row['end_time'])*1000) - (strtotime($row['CURRENT_TIMESTAMP()'])*1000);

//       $cat_item=array(
//             "id"=>$this->id,
//           "nft_catagory_id"=>$this->nft_catagory_id,
//             "nft_price"=>$this->nft_price,
//           "start_time"=>$this->start_time,
//           "end_time"=>$difference_in_seconds );
        
//     // Push to "data"
//     array_push($cat_arr['Auction'], $cat_item);
//   }
     if($live){
        // header
         echo json_encode("Price set successfully");
     }
     else{
          echo json_encode("price not set yet");
     }
  
  
   }
         
  else{
        
         echo json_encode(http_response_code(401));
}

   