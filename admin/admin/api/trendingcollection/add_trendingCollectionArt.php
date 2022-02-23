<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
   
    include_once '../../../config/database.php';
   include_once '../../model/trendingcollections.php';
   include_once '../../../config/constants.php';
     
     if(isset($_POST['id']) ){
         
         $id=$_POST['id'];
    
$database = new Database();
$db = $database->connect();


//$nfts = new Nfts($db);
 $Trending_collections = new Trending_collections($db);

 $seq=$Trending_collections-> getSeq();

 $row = $seq->fetch(PDO::FETCH_ASSOC);
 extract($row);

 $seq++;





      $live = $Trending_collections->add_trending_coll_Art($id,$seq);
    
      if($live){
          
        //  echo ("item added");
        //   http_response_code(201);
          header("Location:". base_url ."admin/view/addTrendingCollection.php");
          exit();
      }

  }
  else{  
//       echo ("error");
//   http_response_code(401);
      header("Location:". base_url ."admin/view/addTrendingCollection.php");
      exit();
  }