<?php
class RCA
{
    // DB stuff
    private $conn;
    private $table = 'rcas';
    
    // Post Properties
    public $rcaId;
    public $title;
    public $description;
    public $image1;
    public $image2;
    public $image3;
    public $image4;
    public $image5;
    public $image;
    public $created_at;
    public $price;
    public $creatorId;
    
    
      // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
     
     // create a RCA's
     
    public function insert_rca($title,$description,$price,$image,$creatorId)
    {
        
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET  title = :title, description = :description,price = :price,created_at = :created_at,image =:image ,image1 =:image1,image2 =:image2,image3 =:image3,image4 =:image4,image5 =:image5 ,creatorId =:creatorId';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $title= htmlspecialchars(strip_tags($title));
        $description= htmlspecialchars(strip_tags($description));
        $price= htmlspecialchars(strip_tags($price));
        $image= htmlspecialchars(strip_tags($image));
        // $image1= htmlspecialchars(strip_tags($image1));
        // $image2= htmlspecialchars(strip_tags($image2));
        // $image3= htmlspecialchars(strip_tags($image3));
        // $image4= htmlspecialchars(strip_tags($image4));
        // $image5= htmlspecialchars(strip_tags($image5));
        $creatorId= htmlspecialchars(strip_tags($creatorId));
      


        // Bind data
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':nft_price', $price);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        // $stmt->bindParam(':image1', $image1);
        // $stmt->bindParam(':image2', $image2);
        // $stmt->bindParam(':image3', $image3);
        // $stmt->bindParam(':image4', $image4);
        // $stmt->bindParam(':image5', $image5);
        $stmt->bindParam(':creatorId', $creatorId);
     

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    
    public function getRCA($id)
    {   
       
        //single RCA's 
        $query = 'SELECT r.rcaId,r.title,r.description,r.image1,r.image2,r.image3,r.image4,r.image5,r.image,r.price, r.creatorId , a.id
                             from rcas r 
                             JOIN
                                admin a
                                ON
                                (r.creatorId=a.id)
                               
                               where
                               (rcaId="'.$id.'" )
                             
                              group by rcaId
                                  order 
                                  by
                                 rcaId
                             ASC
                             
                             ';
                              
              
         // Prepare statement
        $stmt = $this->conn->prepare($query);
         
        // Execute query
        $stmt->execute();
                  
        return $stmt;
         
    }
     public function getAllrcas()
    {   
        
        //single RCA's 
        $query = 'SELECT r.rcaId,r.title,r.description,r.image1,r.image2,r.image3,r.image4,r.image5,r.image,r.price, r.creatorId , a.id
                             from rcas r 
                             JOIN
                                admin a
                                ON
                                (r.creatorId=a.id)
                              
                              group by rcaId
                                  order 
                                  by
                                 rcaId
                             ASC
                             
                             ';
                              
              
         // Prepare statement
        $stmt = $this->conn->prepare($query);
         
        // Execute query
        $stmt->execute();
                  
        return $stmt;
         
    }
  
}
