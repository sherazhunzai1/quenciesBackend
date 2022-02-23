<?php
class Nfts
{
    // DB stuff
    private $conn;
    private $table = 'nfts';

    // Post Properties
    public $id;
    public $title;
    public $product_name;
    public $description;
    public $image;
    public $art_price;
    public $type;
    public $owner_id;
    public $creator_id;
    public $creator_name;
    public $owner_name;
  


    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Posts

    public function readimg()
    {
        // Create query
        $query = 'SELECT a.product_id,a.product_name,a.description,a.art_price,a.image,a.creator_id,a.owner_id,
        u.username as username ,
        c.username as owner_username
                                    FROM ' . $this->table . ' a,
                                creators u, creators c
                                WHERE a.creator_id=u.wallet_address
                                AND 
                                a.owner_id=c.wallet_address
                                AND a.type = "image" ';

                                // AND a.owner_id=u.wallet_address

        // Prepare statement
        $stmt = $this->conn->prepare($query);

  

        // Execute query
        $stmt->execute();
        return $stmt;
        

}

public function totalimg()
    {
        // Create query
        
        $query = 'SELECT *
                                    FROM ' . $this->table . ' WHERE type = "image" ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

  

        // Execute query
        $stmt->execute();
        return $stmt;
        

}
public function readaudio()
{
    // Create query
    $query = 'SELECT a.product_id,a.product_name,a.description,a.art_price,a.image,a.creator_id,a.owner_id,
        u.username as username ,
        c.username as owner_username
                                    FROM ' . $this->table . ' a,
                                creators u, creators c
                                WHERE a.creator_id=u.wallet_address
                                AND 
                                a.owner_id=c.wallet_address
                                AND a.type = "audio" ';

    // Prepare statement
    $stmt = $this->conn->prepare($query);



    // Execute query
    $stmt->execute();
    return $stmt;
    

}
public function totalaudio()
    {
        // Create query
        
        $query = 'SELECT *
                                    FROM ' . $this->table . ' WHERE type = "audio" ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

  

        // Execute query
        $stmt->execute();
        return $stmt;
        

}
}