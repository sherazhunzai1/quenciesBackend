<?php

class Notification

{
    // DB stuff
    private $conn;
    private $table = 'notifications';
    
    // Post Properties
    public $notifications_id;
    public $reciever_id;
    public $tocken_id;
    public $owner_address;
    public $auction_price;
    public $status;
    public $created_at;
  

  // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

        public function notifications($id)
    {
        
        // Create query
        $query = 'SELECT p.*,u.*,n.created_at as created,n.notifications_id,n.auction_price,n.owner_address,n.type
        FROM nfts p,notifications n,creators u
                     WHERE (n.tocken_id=p.tocken_id
                     AND n.reciever_id="'.$id.'") 
                     AND (n.owner_address=u.wallet_address)
                     
                     ORDER BY 
                     n.notifications_id
                     DESC
                             ';


       
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
 
            return $stmt;

  
    }
         public function winner_notifications($id)
    {
        
        // Create query
        $query = 'SELECT distinct(n.Auction_winner_notifications),n.type,p.product_id,p.product_name,p.image
        FROM nfts p,Auction_winner_notifications n,creators u
                     WHERE (n.nft_id=p.product_id
                     AND n.reciever_address="'.$id.'") 
                    
                     
                     ORDER BY 
                     n.Auction_winner_notifications
                     DESC
                             ';


       
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
 
            return $stmt;

  
    }
       
     public function check_notification($bidderAddress,$owneraddress,$tockenId,$price)
    {
       
         $query = 'SELECT *
        FROM notifications 
                      WHERE tocken_id='.$tockenId.'
                      AND
                      owner_address="'.$owneraddress.'"
                      AND
                      auction_price="'.$price.'"
                      AND
                      reciever_id="'.$bidderAddress.'"
                      AND 
                      status=1
                             ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
 
    
            

        return $stmt;
        
        
    }
      public function insert_notification($bidderAddress,$owneraddress,$tockenId,$price)
    {
    
        
        // Create query
        $query = 'INSERT INTO notifications SET reciever_id = :WalletId, tocken_id = :tockenId, owner_address = :contractAddress,auction_price=:price';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $owneraddress = htmlspecialchars(strip_tags($owneraddress));
        $bidderAddress = htmlspecialchars(strip_tags($bidderAddress));
        $tockenId = htmlspecialchars(strip_tags($tockenId));
          $price = htmlspecialchars(strip_tags($price));

        // Bind data
        $stmt->bindParam(':WalletId', $owneraddress);
        $stmt->bindParam(':tockenId', $tockenId);
        $stmt->bindParam(':contractAddress', $owneraddress);
        $stmt->bindParam(':price', $price);
      


        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    
 public function settle_notification($id)

    {

       
         $query = 'UPDATE '.$this->table.' 
                    SET
                    status=0 ,
                    created_at=CURRENT_TIMESTAMP()
                     WHERE
                     notifications_id= '.$id.' ';
 

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

    
            if($stmt){
                  return true;
            }
            else{
                  return false;
            }

      
        
        
    }
    
    
     public function insert_winner_notification($ownerAddress,$artId)
    {

        
        // Create query
        $query = 'INSERT INTO Auction_winner_notifications SET reciever_address = :reciever_address, nft_id = :nft_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $ownerAddress = htmlspecialchars(strip_tags($ownerAddress));
        $artId = htmlspecialchars(strip_tags($artId));
   

        // Bind data
        $stmt->bindParam(':reciever_address', $ownerAddress);
        $stmt->bindParam(':nft_id', $artId);
       
      


        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}