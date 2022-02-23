<?php
    // Headers  ////
   header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    header('Access-Control-Allow-Methods:GET,PUT,POST,DELETE,PATCH,OPTIONS');
    
     include_once '../../config/Database.php';
     include_once '../../models/RCAs.php';
     include_once '../../models/contants.php';
 
 if(isset($_POST['title']) && isset($_POST['description']) && 
   isset($_POST['price']) && isset($_FILES["image"]["name"]))
   // && isset($_POST['image1']) && isset($_POST['image2'])&& isset($_POST['image3']) && isset($_POST['image4'])&& isset($_POST['image5'])
   
   {
 
$title=$_POST['title'];
$description=$_POST['description'];
$price=$_POST['price'];
$image=$_FILES["image"]["name"];
// $img2=$_POST['image1'];
// $img3=$_POST['image2'];
// $img4=$_POST['image3'];
// $img5=$_POST['image4'];
// $img6=$_POST['image5'];


 $target_dir = "../../assets/RCAs/images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

   
// Check if file already exists
if (file_exists($target_file)) {
    
   $temp = explode(".", $_FILES["image"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
}
   
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo json_encode("Image type is invalid");
  //use header for invalid image direction
  header('Location:'.BASE_URL.'admin/view/RCAs.php'); 
  exit();
}

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $RCAs = new RCA($db);
   
    // check the start and end variables are recieved or not ////
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
   
   $image=BASE_URL."assets/RCAs/images/".$_FILES["image"]["name"];
    

   
    /////// getting required data from models ////////
       $live =  $RCAs->insert_rca($title,$description,$price,$image);
    


    //   echo $live;
        // $message = 'success';
     if($live){
          echo json_encode("Item created successfully......");
          //redirect to the next page
          header('Location:' .BASE_URL.'admin/view/dashboard.php'); exit();
     }
     else{
          echo json_encode("Item not created");
     }
   
   
   
   
}
else{
    echo json_encode(http_response_code(415));
    // echo "sherazi";
    exit();
}
 
   
   }
         
  else{
        
         echo json_encode(http_response_code(401));
}

   