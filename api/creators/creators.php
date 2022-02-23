<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    

    include_once '../../config/Database.php';
      
    include_once '../../models/Auction.php';
    include_once '../../models/Creators.php';

 if(isset($_GET['pageno'])){
               
           $end=((($_GET['pageno'])*4)-1);
            $start=($end-3);
               
           }
           else{
         $start=0;
           $end=3;
           }



    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
  
    $creator = new Creators($db);
   
    // Category read query
   

     $creators = $creator->total_creators($start,$end);
       
      $totalcreators = $creators->rowCount();
      
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
             "firstName"=>$row['firstName'],
              "lastName"=>$row['lastName'],
              
          
          "creator_cover"=>$row['cover'],
          "description"=>$row['bio']
          );
         
         

    // Push to "data"
    array_push($cat_arr['creators'], $cat_item);
  }



 echo json_encode($cat_arr);
  
  

   