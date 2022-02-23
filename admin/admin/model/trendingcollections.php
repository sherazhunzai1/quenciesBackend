<?php
class Trending_collections
{
    // DB stuff
    private $conn;
    private $table = 'trending_collections';
 
    // Post Properties
    public $trending_coll_id;
    public $nft_id;
    public $sequence;
    public $created_at;
    
    
    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    //create nft
     public function add_trending_coll_Art($nft_id, $sequence)
    { 
        
         // Create query
  
        $query = 'INSERT INTO trending_collections SET  nft_id =:nft_id
        , sequence =:sequence
        ';

        // Prepare statement
        $stmt1 = $this->conn->prepare($query);

        // Clean data
        $nft_id= htmlspecialchars(strip_tags($nft_id));
         $sequence= htmlspecialchars(strip_tags($sequence));

        // Bind data
        $stmt1->bindParam(':nft_id', $nft_id);
         $stmt1->bindParam(':sequence', $sequence);


        // Execute query
        if ($stmt1->execute()) {
            return true;
        
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt1->error);

        return false;
    }
    
     public function checkA($nft_id){
    $query = "SELECT nft_id
FROM ' . $this->table . '
WHERE  nft_id =:nft_id";
    
    // Prepare statement
        $stmt = $this->conn->prepare($query);
 $nft_id = htmlspecialchars(strip_tags($nft_id));
    //bind
    $stmt->bindParam(':nft_id', $nft_id);
        // Execute query
        $stmt->execute();
     $num=$stmt->rowCount();
     
     
    
     if($num>0){
       return  true;
     }
     else{
        return false;
     }
}

 public function getSeq()
    {   
        
        //single RCA's 
        $query = 'SELECT MAX(sequence) as seq FROM trending_collections
                             
                             ';
                              
              
         // Prepare statement
        $stmt = $this->conn->prepare($query);
         
         
        // Execute query
        $stmt->execute();
                  
        return $stmt;
         
    }
    public function readSingleArt($trending_coll_id){
         // Create query
        $query = 'SELECT a.trending_coll_id, a.nft_id, a.sequence,a.created_at,u.id, u.nft_name,u.nft_catagory,u.image,u.creator_id,u.nft_price, u.description,u.countViews,u.creatorName, li.nft_id as nftid, li.action as listingType, li.highestBid, li.endTimeInSeconds
                                FROM trending_collections a
                                JOIN
                               nfts u
                                ON
                                (a.nft_id=u.id)
                                LEFT JOIN
                                listing li 
                                ON
                                (a.nft_id = li.nft_id)
                             where 
                             a.trending_coll_id= '.$trending_coll_id.'
                              GROUP BY a.trending_coll_id
                               ORDER BY
                               a.trending_coll_id
                               DESC
                              ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
    }
    
    public function readAlltrendingCollArts($start,$end){
         // Create query
        $query = 'SELECT a.trending_coll_id, a.nft_id, a.sequence,a.created_at,u.id, u.nft_name,u.nft_catagory,u.image,u.creator_id,u.nft_price, u.description,u.countViews,u.creatorName, li.nft_id as nftid, li.action as listingType, li.highestBid, li.endTimeInSeconds
                                FROM trending_collections a
                                JOIN
                               nfts u
                                ON
                                (a.nft_id=u.id)
                                LEFT JOIN
                                listing li 
                                ON
                                (a.nft_id = li.nft_id)
                             
                              GROUP BY a.trending_coll_id
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
    
    public function read_total_trendingCollArts(){
         // Create query
        $query = 'SELECT a.trending_coll_id, a.nft_id, a.sequence,a.created_at,u.id, u.nft_name,u.nft_catagory,u.image,u.creator_id,u.nft_price, u.description,u.countViews,u.creatorName, li.nft_id as nftid, li.action as listingType, li.highestBid, li.endTimeInSeconds
                                FROM trending_collections a
                                JOIN
                               nfts u
                                ON
                                (a.nft_id=u.id)
                                LEFT JOIN
                                listing li 
                                ON
                                (a.nft_id = li.nft_id)
                             
                              GROUP BY a.trending_coll_id
                               ORDER BY
                               a.trending_coll_id
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

 public function update_sequence($trending_coll_id,$sequence)
    {
       
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET sequence =:sequence
                                WHERE trending_coll_id = :trending_coll_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $trending_coll_id = htmlspecialchars(strip_tags($trending_coll_id));
        $sequence = htmlspecialchars(strip_tags($sequence));
   

        // Bind data
        $stmt->bindParam(':trending_coll_id', $trending_coll_id);
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
        $query = 'DELETE FROM ' . $this->table . ' WHERE trending_coll_id = :trending_coll_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->trending_coll_id = htmlspecialchars(strip_tags($this->trending_coll_id));

        // Bind data
        $stmt->bindParam(':trending_coll_id', $this->trending_coll_id);

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