<?php

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    header('Access-Control-Allow-Methods:GET,PUT,POST,DELETE,PATCH,OPTIONS');
  
    // Headers
//   $json = file_get_contents('php://input'); 

    include_once '../../config/Database.php';
      
    include_once '../../models/Auction.php';
    include_once '../../models/Creators.php';
    //  include_once '../../models/owners.php';
    include_once '../../models/contants.php';
// $data = json_decode($json);
//  $pic=$data->profilePic;
//   $wallet_address=$data->wallet_address;
 

 if(isset($_POST['userName'])){
      
$userName=$_POST['userName'];


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
  
    $creator = new Creators($db);
    // $owner = new Owners($db);
   
    // Category read query
   
   
   $target_dir = "../../assets/profile/cover/";
$target_file = $target_dir . basename($_FILES["coverImage"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image

  $check = getimagesize($_FILES["coverImage"]["tmp_name"]);
  if($check == false) {
     echo json_encode("It is not an image");
  } 


// Check if file already exists
if (file_exists($target_file)) {
    
  $temp = explode(".", $_FILES["coverImage"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);


}

// Check file size


// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo json_encode("Image type is invalid");
}

// Check if $uploadOk is set to 0 by an error

  if (move_uploaded_file($_FILES["coverImage"]["tmp_name"], $target_file)) {
   
   $image=BASE_URL."assets/profile/cover/".$_FILES["coverImage"]["name"];
    $creators = $creator->update_cover_pic($userName,$image);
    // $owners = $owner->update_cover_pic($userName,$image);
    
      if($creators){
          $data=array("status"=>true,
                    "userName"=>$userName);
          echo json_encode($data);
      }
      else{
          echo json_encode(false);
      }
   
   
  } else {
    echo json_encode("error while uploading");
  }

  
 }
 else{
     
     echo json_encode("no request found");
 }

   