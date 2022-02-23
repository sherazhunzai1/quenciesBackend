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
      public function add($id)
      {
          $this->id=$id;
        // Create query
        $total_nfts = $this->countRows();
         $total_nfts++;

$query1='SELECT product_id, tocken_id, product_name, description, art_price,gif, image,type,start_date, end_date,creator_id, owner_id, uri, txHash, auction FROM nfts WHERE product_id = :id';
  $stmt = $this->conn->prepare($query1);
 $id = htmlspecialchars(strip_tags($id));
    //bind
    $stmt->bindParam(':id', $id);
 
        // Execute query
        $stmt->execute();
          $row=$stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
        
        $query = 'INSERT INTO featureartworks (product_id, tocken_id, product_name, description, art_price,gif, image,type,start_date, end_date,creator_id, owner_id, uri, txHash, auction,sequence) values(:product_id,:tocken_id, :product_name, :description, :art_price, :gif, :image, :type, :start_date, :end_date, :creator_id, :owner_id, :uri, :txHash, :auction, :sequence)
        
';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
 $id = htmlspecialchars(strip_tags($id));
    //bind
    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':tocken_id', $tocken_id);
    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':art_price', $art_price);
    $stmt->bindParam(':gif', $gif);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->bindParam(':creator_id', $creator_id);
    $stmt->bindParam(':owner_id', $owner_id);
    $stmt->bindParam(':uri', $uri);
    $stmt->bindParam(':txHash', $txHash);
    $stmt->bindParam(':auction', $auction);
    $stmt->bindParam(':sequence', $total_nfts);
    
    
        // Execute query
        $stmt->execute();
        // exit();
        return $stmt;
        

}


private function countRows(){
            
        $query = 'SELECT MAX(sequence) as sequence FROM featureartworks';
        $stmt = $this->conn->prepare($query);
         $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        return $row['sequence'];
}

public function check($id){
    $query = "SELECT product_id
FROM featureartworks
WHERE  product_id =:id";
    
    // Prepare statement
        $stmt = $this->conn->prepare($query);
        $id = htmlspecialchars(strip_tags($id));
    //bind
    $stmt->bindParam(':id', $id);
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
}