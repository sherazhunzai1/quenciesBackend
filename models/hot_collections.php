<?php
class Hot_collections
{
    // DB stuff
    private $conn;
    private $table = 'Hot_collections';
 
    // Post Properties
    public $hot_coll_id;
    public $nft_id;
    public $sequence;
    public $created_at;
    
    
    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    //create nft
     public function add_Hot_coll_Art($nft_id)
    { 
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET nft_id = :nft_id';
    
        $stmt = $this->conn->prepare($query);

        // Clean data
        $nft_id= htmlspecialchars(strip_tags($nft_id));
         
 
 
        // Bind data
        $stmt->bindParam(':nft_id', $nft_id);
      


        // Execute query
        if ($stmt->execute()) {
            return true;
        }
    
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    
    public function readSingleArt($hot_coll_id){
         // Create query
        $query = 'SELECT a.hot_coll_id, a.nft_id, a.sequence,a.created_at,u.id, u.nft_name,u.nft_catagory,u.image,u.creator_id,u.nft_price, u.description,u.countViews ,u.creatorName,li.action as listingType,li.nft_id as nftid, li.highestBid
                                FROM Hot_collections a
                                JOIN
                               nfts u
                                ON
                                (a.nft_id=u.id)
                                LEFT JOIN
                                listing li
                                ON
                                (
                                a.nft_id=li.nft_id)
                             where 
                             a.hot_coll_id= '.$hot_coll_id.'
                              GROUP BY a.hot_coll_id
                               ORDER BY
                               a.hot_coll_id
                               DESC
                              ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
    }
    
    public function readAll_hotColl_Arts($start,$end){
         // Create query
        $query = 'SELECT a.hot_coll_id, a.nft_id, a.sequence,a.created_at,u.id, u.nft_name,u.nft_catagory,u.image,u.creator_id,u.nft_price, u.description,u.countViews ,u.creatorName,li.action as listingType,li.nft_id as nftid, li.highestBid
                                FROM Hot_collections a
                                JOIN
                               nfts u
                                ON
                                (a.nft_id=u.id)
                                LEFT JOIN
                                listing li
                                ON
                                (
                                a.nft_id=li.nft_id)
                              GROUP BY a.hot_coll_id
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
    
     public function read_total_hotColl_Arts(){
         // Create query
        $query = 'SELECT a.hot_coll_id, a.nft_id, a.sequence,a.created_at,u.id, u.nft_name,u.nft_catagory,u.image,u.creator_id,u.nft_price, u.description,u.countViews ,u.creatorName,li.action as listingType,li.nft_id as nftid, li.highestBid
                                FROM Hot_collections a
                                JOIN
                               nfts u
                                ON
                                (a.nft_id=u.id)
                                LEFT JOIN
                                listing li
                                ON
                                (
                                a.nft_id=li.nft_id)
                             
                              GROUP BY a.hot_coll_id
                               ORDER BY
                               a.hot_coll_id
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

 public function update_sequence($hot_coll_id,$sequence)
    {
       
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET sequence =:sequence
                                WHERE hot_coll_id = :hot_coll_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $hot_coll_id = htmlspecialchars(strip_tags($hot_coll_id));
        $sequence = htmlspecialchars(strip_tags($sequence));
   

        // Bind data
        $stmt->bindParam(':hot_coll_id', $hot_coll_id);
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
        $query = 'DELETE FROM ' . $this->table . ' WHERE hot_coll_id = :hot_coll_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->hot_coll_id = htmlspecialchars(strip_tags($this->hot_coll_id));

        // Bind data
        $stmt->bindParam(':hot_coll_id', $this->hot_coll_id);

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