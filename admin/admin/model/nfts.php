<?php
class Nfts
{
    // DB stuff
    private $conn;
    private $table = 'nfts';
 
    // Post Properties
    public $id;
    public $nft_name;
    public $creatorname;
    public $creator_name;
    public $creator_img;
    public $art_img;
    public $art_gif;
    public $nft_price;
    public $countViews;
    public $start_time;
    public $end_time;
    public $owner_walletAddres;
    public $owner_img;
    public $owner_name;
    public $creator_walletAddress;
    public $nft_catagory;
  //  public $imageUrl;
  
    


    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

     function get_sequence($sequence) {
    
  $query = 'SELECT *
                                    FROM trending_collections 
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
        $query = 'UPDATE trending_collections
                                SET sequence =:sequence
                                WHERE trending_coll_id = :trending_coll_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $trending_coll_id = htmlspecialchars(strip_tags($trending_coll_id));
        $sequence = htmlspecialchars(strip_tags($sequence));
   

        // Bind data
        $stmt->bindParam(':sequence', $sequence);
         $stmt->bindParam(':trending_coll_id', $trending_coll_id);
        

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}