<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
   
    
if (isset($_GET['search'])) 
{
    // Headers
    

    include_once '../../config/Database.php';
    include_once '../../models/Creators.php';
     

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $creators = new Creators($db);
   
    $search = $_GET['search'];
 
    // Category read query
    $result = $creators->search($search);
  
    // Get row count
    $num = $result->rowCount();

    // Check if any categories
    if ($num > 0) {
     
        $cat_arr=array();
        $cat_item=array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
     

          
      $cat_item=array(
          "id"=>$row['id'],
          "userName"=>$row['userName'],
          
            "creator_img"=>$row['img'],
             "firstName"=>$row['firstName'],
              "lastName"=>$row['lastName'],
              
          
        //   "creator_cover"=>$row['cover'],
        //   "description"=>$row['bio']
          );
    // Push to "data"
    array_push($cat_arr, $cat_item);
  }
        
        echo json_encode(
            array('search' => true,
                  'data'=>$cat_arr)
        );
        
        
        
    } else {
        // No Categories
        echo json_encode(
            array(
                "search"=>false,
            "message"=>"No data Found")
        );
    }
} else {
    echo json_encode(
        array('message' => "bes k atoxa")
    );
}
