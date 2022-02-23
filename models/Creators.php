<?php
class Creators
{
    // DB stuff
    private $conn;
    private $table = 'creators';

    // Post Properties
    public $id;
    public $firstName;
    public $lastName;
    public $userName;
    public $email;
    public $password;
    public $wallet_address;
    public $bio;

    
  


    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function search($name)
    {
       
        // Create query
        $query = "SELECT *
        FROM " . $this->table . " 
                      WHERE userName LIKE '%".$name."%'      
                             ";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
 
    
                

        return $stmt;
        
    }

      public function total_creators($start=0,$end=8)
    {
       
        // Create query
        $query = 'SELECT *
        FROM ' . $this->table . ' 
                     order by
                     id
                     ASC
                     limit '.$start.', '.$end.'
                             ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
 
    
                

        return $stmt;
        
    }
    
    
       public function get_userid($username)
    {
        
        // Create query
        $query = 'SELECT *
        FROM ' . $this->table . ' 
                     WHERE userName= "' . $username . '"     
                             ';


       
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
            return $row['id'];

  
    }

    public function get_useraddress($username)
    {
        
        // Create query
        $query = 'SELECT *
        FROM ' . $this->table . ' 
                     WHERE userName= "' . $username . '"     
                             ';


       
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
            return $row['wallet_address'];

  
    }

   public function profile($username)
    {
        
        // Create query
        $query = 'SELECT *
        FROM ' . $this->table . ' 
                     WHERE userName= "' . $username . '"     
                             ';


       
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
 
            return $stmt;

  
    } 
 
      public function inwallet($wallet_address)
    {
        
        // Create query
        $query = 'SELECT a.id,a.nft_name, a.nft_catagory,a.countViews,a.description,a.owner_id,a.creator_id, a.start_time,a.end_time,a.image as artImg,a.gif,a.nft_price,u.wallet_address as ownerWallet,u.img as ownerImg,u.userName as ownerName,c.wallet_address as creatorWallet,c.img as creatorImg,c.userName as creatorName
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.owner_id=u.wallet_address)
                                JOIN
                                creators c
                                ON
                                (a.creator_id=c.wallet_address)
                                
                              
                                WHERE
                                a.owner_id= "' . $wallet_address . '"
                              ';


       
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
 
            return $stmt;

  
    } 
 
  
  


    // Get Single Post
    public function single_creator($id)
    {
        
        // Create query
        $query = 'SELECT *
        FROM ' . $this->table . ' 
                     WHERE id= "' . $id . '"     
                             ';


       
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
 
            return $stmt;

  
    }
    
     public function username_exist($username)
    {
        
        // Create query
        $query = 'SELECT *
        FROM ' . $this->table . ' 
                     WHERE userName= "' . $username . '"    
                      
                             ';


       
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
     $num=   $stmt->rowCount();
     if($num >0){
         return false;
     }
     else{
          return true;
     }
 
           

  
    }
    
  public function place_bid($contractAddress,$price,$nft_id,$ownerAddress)
    {
        
        // Create query
        $query = 'INSERT INTO bidding SET price = :price, nft_id = :nft_id, bidder_address = :bidderAddress, owner_addreess = :owner_addreess';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $contractAddress = htmlspecialchars(strip_tags($contractAddress));
        $price = htmlspecialchars(strip_tags($price));
        $nft_id = htmlspecialchars(strip_tags($nft_id));
         $ownerAddress = htmlspecialchars(strip_tags($ownerAddress));

        // Bind data
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':nft_id', $nft_id);
        $stmt->bindParam(':bidderAddress', $contractAddress);
         $stmt->bindParam(':owner_addreess', $ownerAddress);
      


        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    // Create Post
    public function signup($userName,$password,$firstName,$lastName,$email)
    {
        $this->username = $userName;
        $this->firstname = $firstName;
        $this->lastname = $lastName;
        $this->password = $password;
        $this->email = $email;
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET userName = :userName, password = :password, firstName = :firstName, lastName = :lastName, email =:email';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->userName = htmlspecialchars(strip_tags($this->userName));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->firstName = htmlspecialchars(strip_tags($this->firstName));
        $this->lastName = htmlspecialchars(strip_tags($this->lastName));

        // Bind data
        $stmt->bindParam(':userName', $this->userName);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':firstName', $this->firstName);
        $stmt->bindParam(':lastName', $this->lastName);


        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Update Post
    public function update_profile($firstName,$lastName,$bio,$id)
    {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET firstName = :firstName,lastName= :lastName, bio = :bio
                                WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
      
        $firstName = htmlspecialchars(strip_tags($firstName));
        $lastName = htmlspecialchars(strip_tags($lastName));
        $bio = htmlspecialchars(strip_tags($bio));
     //   $instagram = htmlspecialchars(strip_tags($instagram));
     //   $twitter = htmlspecialchars(strip_tags($twitter));
        $id = htmlspecialchars(strip_tags($id));
        

        // Bind data
        $stmt->bindParam(':firstName', $firstName);
         $stmt->bindParam(':lastName', $lastName);
         $stmt->bindParam(':bio', $bio);
      //   $stmt->bindParam(':instagram', $instagram);
      //   $stmt->bindParam(':twitter', $twitter);
        $stmt->bindParam(':id', $id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    
      public function update_profile_pic($userName,$pic)
    {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET img=:img
                                WHERE userName = :userName';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $userName = htmlspecialchars(strip_tags($userName));
        $pic = htmlspecialchars(strip_tags($pic));
       
        

        // Bind data
        $stmt->bindParam(':img', $pic);
     
        $stmt->bindParam(':userName', $userName);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    
    
      public function update_cover_pic($userName,$pic)
    {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET cover=:cover
                                WHERE userName = :userName';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $userName = htmlspecialchars(strip_tags($userName));
        $pic = htmlspecialchars(strip_tags($pic));
       
        

        // Bind data
        $stmt->bindParam(':cover', $pic);
     
        $stmt->bindParam(':userName', $userName);

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
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
