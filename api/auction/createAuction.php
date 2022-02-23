<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    include_once '../../config/Database.php';
    include_once '../../models/Auctions.php';
 
 if(isset($_POST['auctionId']) && isset($_POST['tokenId']) && isset($_POST['from']) && isset($_POST['txHash']) && isset($_POST['reservePrice']) && isset($_POST['endTimeInSeconds'])){
               
               
    $auctionId=$_POST['auctionId'];     
    $tokenId=$_POST['tokenId'];
    $owner_address=$_POST['from'];
    $transactionHash=$_POST['txHash'];
    $reservePrice=$_POST['reservePrice'];
    $endTimeInSeconds=$_POST['endTimeInSeconds'];


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
  
    $Auctions = new Auctions($db);
   
      
      $result = $Auctions->setAuction($auctionId,$tokenId,$owner_address,$transactionHash,$reservePrice,$endTimeInSeconds);
    //   exit();
      if($result){
                   
 http_response_code(201);
        // header("Status: 201 CREATED");
        echo json_encode(
            array('auction' => true,
               'auctionId' => $auctionId,
               'tokenId' => $tokenId,
               'owner_address' => $owner_address,
               'transactionHash' => $transactionHash,
               'reservePrice' => $reservePrice,
               'endTimeInSeconds' => $endTimeInSeconds)
        );
      }
      
      else{
          http_response_code(401);
    //  header("Status: 401 UNAUTHORIZED");
      echo json_encode(
          
            array('message' => "No request found")
        );
      }
 
 }
 else{
     http_response_code(401);
    //  header("Status: 401 UNAUTHORIZED");
      echo json_encode(
          
            array('message' => "No request found")
        );
 }