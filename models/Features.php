<?php
class Features
{
    // DB stuff
    private $conn;
    private $table = 'features';
 
    // Post Properties
    public $feature_id;
    public $nft_id;
    public $sequence;
    public $created_at;
    
    
    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    //create nft
     public function add_featureArt($nft_id)
    {  
         // Create query
        $query = 'INSERT INTO features SET  nft_id =:nft_id';

        // Prepare statement
        $stmt1 = $this->conn->prepare($query);

        // Clean data
        $nft_id= htmlspecialchars(strip_tags($nft_id));

        // Bind data
        $stmt1->bindParam(':nft_id', $nft_id);


        // Execute query
        if ($stmt1->execute()) {
            return true;
        
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt1->error);

        return false;
    }
    
    
    public function readSingleArt($feature_id){
      
         // Create query
        $query = 'SELECT a.feature_id, a.nft_id, a.sequence,a.created_at,u.id, u.nft_name,u.nft_catagory,u.image,u.creator_id,u.nft_price, u.description,u.creator_id,u.creatorName,u.countViews,u.creatorName, li.action as listingType, li.highestBid, li.endTimeInSeconds,li.nft_id as nftid
                                FROM features a
                                JOIN
                               nfts u
                                ON
                                (a.nft_id=u.id)
                                LEFT JOIN
                                listing li
                                ON
                                (a.nft_id=li.nft_id)
                             WHERE 
                             a.feature_id= '.$feature_id.'
                              GROUP BY a.feature_id
                               ORDER BY
                               a.feature_id
                               DESC
                              ';
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
  
        return $stmt;
    }
    
    public function readAllfeatureArts($start,$end){
         // Create query
        $query = 'SELECT a.feature_id, a.nft_id, a.sequence,a.created_at,u.id, u.nft_name,u.nft_catagory,u.image,u.creator_id,u.nft_price, u.description,u.creator_id,u.creatorName,u.countViews,u.creatorName, li.action as listingType, li.highestBid, li.endTimeInSeconds,li.nft_id as nftid
                                FROM features a
                                JOIN
                               nfts u
                                ON
                                (a.nft_id=u.id)
                                LEFT JOIN
                                listing li
                                ON
                                (a.nft_id=li.nft_id)
                             
                              GROUP BY a.feature_id
                               ORDER BY
                               a.sequence
                               
                                LIMIT ' . $start . ' , ' . $end . '
                              ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
    }
    
    public function read_Total_featureArts(){
         // Create query
        $query = 'SELECT a.feature_id, a.nft_id, a.sequence,a.created_at,u.id, u.nft_name,u.nft_catagory,u.image,u.creator_id,u.nft_price, u.description,u.creator_id,u.creatorName,u.countViews,u.creatorName, li.action as listingType, li.highestBid,li.endTimeInSeconds,li.nft_id as nftid
                                FROM features a
                                JOIN
                               nfts u
                                ON
                                (a.nft_id=u.id)
                                LEFT JOIN
                                listing li
                                ON
                                (a.nft_id=li.nft_id)
                             
                              GROUP BY a.feature_id
                               ORDER BY
                               a.feature_id
                               DESC
                                
                              ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
    }
    function get_sequence_nfts($sequence) {
    
  $query = 'SELECT *
                                    FROM ' . $this->table . ' 
                                    WHERE sequence >=' . $sequence . '';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

  

        // Execute query
        $stmt->execute();
        return $stmt;
}

 public function update_sequence($feature_id,$sequence)
    {
       
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET sequence =:sequence
                                WHERE feature_id = :feature_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $feature_id = htmlspecialchars(strip_tags($feature_id));
        $sequence = htmlspecialchars(strip_tags($sequence));
   

        // Bind data
        $stmt->bindParam(':feature_id', $feature_id);
        $stmt->bindParam(':sequence', $sequence);
       
        

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    // Delete Post
    public function delete()
    {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE feature_id = :feature_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->feature_id = htmlspecialchars(strip_tags($this->feature_id));

        // Bind data
        $stmt->bindParam(':feature_id', $this->feature_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
?>