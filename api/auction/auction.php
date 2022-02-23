<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    include_once '../../config/Database.php';
    include_once '../../models/Auction.php';
    include_once '../../models/Creators.php';
    include_once '../../models/Bidding.php';
    include_once '../../models/Auctions.php';

 if(isset($_GET['product_id'])){
               
         
    $product_id=$_GET['product_id'];


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
  
    $Auctions = new Auctions($db);
    $Bidding= new Bidding($db);
   
    // Category read query
   

      $creators = $Bidding->get_bidding($product_id);
     $row = $creators->fetch(PDO::FETCH_ASSOC);
     
     extract($row);
    $insert=$Auctions->insert($product_id,$creator_id,$price);
    if($insert)
    {
        
        echo json_encode("Data is already inserted");
    }
    else
    {
        echo json_encode("Not Inserted");
    }
   exit();
    $Totalcreators = $creator->total_creators();
    $totalcreators = $Totalcreators->rowCount();
    $totalpage=$totalcreators/4;
    $totalpage=ceil( $totalpage);
     $currentpage=$end/4;
     $currentpage=ceil($currentpage);
      
       $cat_arr = array();
   $cat_arr['creators'] = array();
  
   $cat_arr['totalCreators'] = $totalcreators;
     $cat_arr['totalPages'] = $totalpage;
    $cat_arr['currentPage'] = $currentpage;
   

  while ($row =$creators->fetch(PDO::FETCH_ASSOC))
  {
     

        
      $cat_item=array(
          "id"=>$row['id'],
          "userName"=>$row['userName'],
          
            "creator_img"=>$row['img'],
          
          "creator_cover"=>$row['creator_gif'],
          "description"=>$row['description']
          );
         
         

    // Push to "data"
    array_push($cat_arr['creators'], $cat_item);
  }



 echo json_encode($cat_arr);
 }
 else{
      echo json_encode("no parameters found");
 }
  

   