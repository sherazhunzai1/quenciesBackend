<?php
class Likes
{
    // DB stuff
    private $conn;
    private $table = 'likes';

    // Post Properties
    public $likesId;
    public $nftId;
    public $creatorId;
    public $status;
    
    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //checkUserliked or not
    public function isUserAlreadyLiked($creatorId,$nftId)
    
{ 
    
     $query = 'SELECT likesId,nftId,creatorId from ' . $this->table . ' WHERE nftId='.$nftId.'  AND creatorId='.$creatorId.' ';
     
      // Prepare statement
        $stmt = $this->conn->prepare($query);

$stmt->execute();
$num=$stmt->rowCount();



//  $stmt->execute();
               
//         return $stmt;
             // Execute query
        if ($num > 0) {
            return true;
        }
    else{
         return false; 
    }
       

}

      // ifalready liked then delete the liked nft 
  public function deleteLikes($nftId,$creatorId)
{ 
 // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE nftId = '.$nftId.' AND creatorId ='.$creatorId.' ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->nftId = htmlspecialchars(strip_tags($this->nftId));
        $this->creatorId = htmlspecialchars(strip_tags($this->creatorId));

        // Bind data
        $stmt->bindParam(':nftId', $this->nftId);
        $stmt->bindParam(':creatorId', $this->creatorId);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
  
  //countUser liked nfts
   public function getUserLikes($nftId,$creatorId)
{  
     $query = 'SELECT likesId, nftId,creatorId from likes WHERE nftId='.$nftId. ' AND creatorId='.$creatorId.' ';
   

         // Prepare statement
        $stmt = $this->conn->prepare($query);
 
        // Execute query
        $stmt->execute();
          
        return $stmt;

     

}
   //count likes on nft
    public function getTotalLikes($nftId)
{   
    
     $query = 'SELECT * FROM ' . $this->table . ' where nftId= '. $nftId. ' ';
 
 // Prepare statement
        $stmt = $this->conn->prepare($query);


        // Execute query
        $stmt->execute();

      return $stmt;

}

   //update likes data
   public function createLikes($nftId,$creatorId)
{   // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET nftId = :nftId,
       creatorId = :creatorId ';
    
        $stmt = $this->conn->prepare($query);

        // Clean data
        $nftId= htmlspecialchars(strip_tags($nftId));
         $creatorId= htmlspecialchars(strip_tags($creatorId));
 
        // Bind data
        $stmt->bindParam(':nftId', $nftId);
        $stmt->bindParam(':creatorId', $creatorId);


        // Execute query
        if ($stmt->execute()) {
            return true;
            
        }
    
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
       public function Likednfts($creator_id)
    {
        
        // Create query
        $query = 'SELECT a.id,a.nft_name, a.nft_catagory,a.countViews,a.description,a.owner_id, a.start_time,a.end_time,a.image as artImg,u.img as ownerImg,a.gif,a.auction,a.sell,u.userName as ownerName,u.wallet_address,a.nft_price, l.nftId, l.creatorId
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.owner_id=u.wallet_address)
                                JOIN
                               likes l
                                ON
                                (l.nftId = a.id)
                                WHERE
                                l.creatorId= ' . $creator_id . '
                            
                             ';


       
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
 
            return $stmt;

  
    } 
 
    
}
