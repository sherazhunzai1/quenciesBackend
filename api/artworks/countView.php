<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/Auction.php';
 
   
   if(isset($_POST['id'])) {
       $id=$_POST['id'];

 


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
  
    // Instantiate category object
    $Auction = new Auction($db);
    
  
              /////// getting required data from models ////////
       $live = $Auction->getNFTViews($id);
    //   exit();
     if($live){
        
         $view= $Auction->countViews($id);
         
           $cat_arr = array();
   $cat_arr['artDetails'] = array();

  while ($row = $view->fetch(PDO::FETCH_ASSOC)) { 
     
      $cat_item=array(
           "nftId"=>$row['id'],
          "ViewsOnNft"=>$row['countViews']
          );

    // Push to "data"
    array_push($cat_arr['artDetails'], $cat_item);
  }
    echo json_encode($cat_arr);
     }
     else{
          echo json_encode("No views on NFT");
     }
  
  
   }
         
  else{
        
         echo json_encode(http_response_code(401));
}

   