<?php
class Live_Auction
{
    // DB stuff
    private $conn;
    private $table = 'listing';
 
    // Post Properties
    public $listing_id;
    public $nft_id;
    public $token_id;
    public $saleid;
    public $type;
    public $action;
    public $price;
    public $highestBid;
    public $txHash;
    public $status;
    public $endTimeInSeconds;
    public $createdAt;
    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    
    
    public function readSingleArt($listing_id){
      
         // Create query
        $query = 'SELECT l.listing_id, l.nft_id, l.token_id,l.type,l.action, l.price,l.highestBid,l.txHash,l.status,l.endTimeInSeconds,u.id, u.nft_name,u.nft_catagory,u.image,u.creator_id,u.nft_price, u.description,u.nft_price,u.countViews,u.creatorName 
                                FROM listing l
                                JOIN
                               nfts u
                                ON
                                (l.nft_id=l.nft_id)
                             where 
                             l.listing_id= '.$listing_id.'
                              GROUP BY l.listing_id
                               ORDER BY
                               l.listing_id
                               DESC
                              ';
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
  
        return $stmt;
    }
    
    public function readAllLiveAuction_Arts($start,$end){
         // Create query
        $query = 'SELECT l.listing_id, l.nft_id, l.token_id,l.type,l.action, l.price,l.highestBid,l.txHash,l.status,l.endTimeInSeconds,u.id, u.nft_name,u.nft_catagory,u.image,u.creator_id,u.nft_price, u.description,u.nft_price,u.countViews,u.creatorName 
                                FROM listing l
                                JOIN
                               nfts u
                                ON
                                (l.nft_id=l.nft_id)
                             where 
                             (l.action ="auction"
                             
                             AND
                             l.status =1
                             )
                              GROUP BY l.listing_id
                               ORDER BY
                              l.listing_id
                               DESC
                                LIMIT ' . $start . ' , ' . $end . '
                              ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
    }
    
     public function read_Total_LiveAuction_Arts(){
         // Create query
        $query = 'SELECT l.listing_id, l.nft_id, l.token_id,l.type,l.action, l.price,l.highestBid,l.txHash,l.status,l.endTimeInSeconds,u.id, u.nft_name,u.nft_catagory,u.image,u.creator_id,u.nft_price, u.description,u.nft_price,u.countViews,u.creatorName 
                                FROM listing l
                                JOIN
                               nfts u
                                ON
                                (l.nft_id=l.nft_id)
                             where 
                             (l.action ="auction"
                             
                             AND
                             l.status =1
                             )
                              GROUP BY l.listing_id
                               ORDER BY
                              l.listing_id
                               DESC
                              
                              ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
    }
    
}

?>