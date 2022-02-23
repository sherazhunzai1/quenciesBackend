<?php
class Art
{
    // DB stuff
    private $conn;
    private $table = 'featureartworks';

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

    public function read()
    {
        // Create query
        $query = 'SELECT a.product_id,a.product_name,a.sequence,a.description,a.art_price,a.type,a.image,a.creator_id,a.owner_id,
        u.username as username,
        c.username as owner_username
                                    FROM ' . $this->table . ' a,
                                creators u, creators c
                                WHERE a.creator_id=u.wallet_address
                                AND 
                                a.owner_id=c.wallet_address ORDER BY sequence';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

  

        // Execute query
        $stmt->execute();
        return $stmt;
        

}
public function total()
    {
        // Create query
        
        $query = 'SELECT *
                                    FROM ' . $this->table . ' ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

  

        // Execute query
        $stmt->execute();
        return $stmt;
        

}
public function delete($id){
    $this->id=$id;
    //create query
 
    $query ='DELETE FROM ' . $this->table . ' WHERE product_id = :id';

    // prepare
$stmt = $this->conn->prepare($query);
//clean
$this->id = htmlspecialchars(strip_tags($this->id));
//bind
$stmt->bindParam(':id', $this->id);

 //execute query
 if ($stmt->execute()) {
    return true;
}
//error if S/T goes wrong
printf("Error: %s. \n", $stmt->error);


return false;
}

function get_sequence($sequence) {
    
    $query = 'SELECT *
                                      FROM ' . $this->table . ' 
                                      WHERE sequence >=' . $sequence . '';
  
          // Prepare statement
          $stmt = $this->conn->prepare($query);
  
    
  
          // Execute query
          $stmt->execute();
          return $stmt;
  }
  
   public function update_sequence($productid,$sequence)
      {
         
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                  SET sequence =:sequence
                                  WHERE product_id = :id';
  
          // Prepare statement
          $stmt = $this->conn->prepare($query);
  
          // Clean data
          $nftId = htmlspecialchars(strip_tags($productid));
          $sequence = htmlspecialchars(strip_tags($sequence));
     
  
          // Bind data
          $stmt->bindParam(':sequence', $sequence);
           $stmt->bindParam(':id', $productid);
          
  
          // Execute query
          if ($stmt->execute()) {
              return true;
          }
  
          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);
  
          return false;
      }
}