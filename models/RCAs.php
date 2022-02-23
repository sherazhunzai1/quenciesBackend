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
    public $countViews;
    
    
      // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
     
     // create a RCA's
     
    public function insert_rca($title,$description,$price,$image)
    {
      
        
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET  title = :title, description = :description,price = :price,image =:image ';

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
       
      


        // Bind data
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        // $stmt->bindParam(':image1', $image1);
        // $stmt->bindParam(':image2', $image2);
        // $stmt->bindParam(':image3', $image3);
        // $stmt->bindParam(':image4', $image4);
        // $stmt->bindParam(':image5', $image5);
       
     

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
        $query = 'SELECT r.rcaId,r.title,r.description,r.image1,r.image2,r.image3,r.image4,r.image5,r.image,r.price, r.creatorId, r.countViews
                             from rcas r 
                             
                               
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
     public function getAllrcas($start=0,$end=20)
    {   
        
        //single RCA's 
        $query = 'SELECT *
                             from rcas  
                              
                             
                                  order 
                                  by
                                 rcaId
                             DESC
                             
                             LIMIT '.$start.', '.$end.'
                             
                             ';
                              
              
         // Prepare statement
        $stmt = $this->conn->prepare($query);
         
        // Execute query
        $stmt->execute();
                  
        return $stmt;
         
    }
     public function getAllrcastotal()
    {   
        
        //single RCA's 
        $query = 'SELECT * FROM rcas 
                              
                             
                                  order 
                                  by
                                 rcaId
                             DESC
                             
                            
                             
                             ';
                              
              
         // Prepare statement
        $stmt = $this->conn->prepare($query);
         
        // Execute query
        $stmt->execute();
                  
        return $stmt;
         
    }
     // Delete Post
    public function delete( $rcaId)
    {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE rcaId = '. $rcaId.'   ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->rcaId = htmlspecialchars(strip_tags($this->rcaId));

        // Bind data
        $stmt->bindParam(':rcaId', $this->rcaId);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
  
  //create countViews NFT
 public function getNFTViews($id)
    {
      
        // Create query
     $query = 'UPDATE rcas SET countViews = countViews + 1 WHERE rcaId = '.$id. ' ';
      
        
     // Prepare statement
        $stmt = $this->conn->prepare($query);
  
  $id= htmlspecialchars(strip_tags($id));
  
   // Bind data
        $stmt->bindParam(':rcaId', $id);
        
    //execute stmt
        if ($stmt->execute()) {
            return true ;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
   //nftsVIews Counts
    public function countViews($id)
    {  
    
      $query = 'SELECT rcaId, countViews  FROM rcas where rcaId='.$id.'  ';

               $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
     
        return  $stmt;

     
    }
    
//     //delete image plus rca from folder and database
//     // Delete Post
//     public function delete( $rcaId)
//     {
//         // Create query
//         // $query = 'DELETE FROM ' . $this->table . ' WHERE rcaId = '. $rcaId.'   ';

//         // Prepare statement
//         $stmt = $this->conn->prepare('SELECT * FROM rcas where rcaId='.$rcaId.';' );

//         // Clean data
//         $this->rcaId = htmlspecialchars(strip_tags($this->rcaId));

//         // Bind data
//         $stmt->bindParam(':rcaId', $this->rcaId);

//         // Execute query
//         if ($stmt->execute()) {
            
//              $record = $stmt->fetch();

//   //get image path
//   $image=BASE_URL."assets/RCAs/images/".$record["image"]["name"];
//   //$imageUrl = $_DIR_.'/images/uploads/profile/'.$record['Image_name'];

//   //check if image exists
//   if(file_exists($image)){

//     //delete the image
//     unlink($image);
    
//     //after deleting image you can delete the record
//     $result = $this->conn->prepare("DELETE FROM ' . $this->table . ' WHERE rcaId = '. $rcaId.'");
//     $result->bindParam(':rcaId', $rcaId);
//     $result->execute();
//     }
//             return true;
//         }

//         // Print error if something goes wrong
//         printf("Error: %s.\n", $stmt->error);

//         return false;
//     }
    
}
