<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
   
    include_once '../../../config/database.php';
   include_once '../../model/hot_collections.php';
   include_once '../../../config/constants.php';
     
     if(isset($_POST['id']) ){
         
         $id=$_POST['id'];
    
$database = new Database();
$db = $database->connect();


//$nfts = new Nfts($db);
 $Hot_collections = new Hot_collections($db);

 $seq=$Hot_collections-> getSeq();

 $row = $seq->fetch(PDO::FETCH_ASSOC);
 extract($row);

 $seq++;





      $live = $Hot_collections->add_Hot_coll_Art($id,$seq);
    
      if($live){
          
        //  echo ("item added");
        //   http_response_code(201);
          header("Location:". base_url ."admin/view/addHotColls.php");
          exit();
      }

  }
  else{  
//       echo ("error");
//   http_response_code(401);
      header("Location:". base_url ."admin/view/addHotColls.php");
      exit();
  }