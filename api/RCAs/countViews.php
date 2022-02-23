<?php
    // Headers  ////
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/RCAs.php';
 
   
   if(isset($_POST['rcaId'])) {
       $id=$_POST['rcaId'];

 


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
  
    // Instantiate category object
     $RCAs = new RCA($db);
    
  
              /////// getting required data from models ////////
       $live =  $RCAs->getNFTViews($id);
    //   exit();
     if($live){
        
         $view=  $RCAs->countViews($id);
         
           $cat_arr = array();
   $cat_arr['artDetails'] = array();

  while ($row = $view->fetch(PDO::FETCH_ASSOC)) { 
     
      $cat_item=array(
           "rcaId"=>$row['rcaId'],
          "ViewsOnRCA"=>$row['countViews']
          );

    // Push to "data"
    array_push($cat_arr['artDetails'], $cat_item);
  }
    echo json_encode($cat_arr);
     }
     else{
          echo json_encode("No views on RCA");
     }
  
  
   }
         
  else{
        
         echo json_encode(http_response_code(401));
}

   