<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
       
    include_once '../../config/Database.php';
    include_once '../../models/RCAs.php';
  
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
 
    // Instantiate category object
    $RCAs = new RCA($db);
 
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
      $feature = $RCAs->getAllrcas($start,12);
      
      $total = $RCAs->getAllrcastotal();


     $totalcount = $total->rowCount();
        $totalpage=$totalcount/12;
       $totalpage=ceil( $totalpage);
     $currentpage=$end/12;
     $currentpage=ceil($currentpage);

            $cat_arr=array();
            
          $cat_arr['getallRCAs'] = array();
         $cat_arr['totalPages'] = $totalpage;
     $cat_arr['currentPage'] = $currentpage;

   while ($row = $feature->fetch(PDO::FETCH_ASSOC)) {
    
  $cat_item=array(
          "id"=>utf8_encode($row['rcaId']),
          "art_name"=>utf8_encode($row['title']),
            "art_description"=>utf8_encode($row['description']),
        //   "image1"=>$row['image1'],
        //   "image2"=>$row['image2'],
        //   "image3"=>$row['image3'],
        //   "image4"=>$row['image4'],
        //   "image5"=>$row['image5'],
          "art_img"=>utf8_encode($row['image']),
          "art_price"=>utf8_encode($row['price']),
          "views"=>utf8_encode($row['countViews'])
           
         );
    // Push to "data"
    array_push($cat_arr['getallRCAs'], $cat_item);
  } 
    
   echo json_encode($cat_arr);
    
  

   