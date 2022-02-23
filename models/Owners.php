<?php
class Owners
{
    // DB stuff
    private $conn;
    private $table = 'owners';

    // Post Properties
    public $id;
    public $firstName;
    public $lastName;
    public $userName;
    public $email;
    public $password;
    public $wallet_address;
    public $img;
    public $cover;
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
                      WHERE userName LIKE '".$username."%'      
                             ";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
 
    
                

        return $stmt;
        
    }

    // Get Posts
    public function creators($start=0,$end=4)
    {
       
        // Create query
        $query = 'SELECT *
        FROM ' . $this->table . ' 
                      LIMIT ' . $start . ' , ' . $end . '      
                             ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
 
    
                

        return $stmt;
        
    }
      public function total_creators()
    {
       
        // Create query
        $query = 'SELECT *
        FROM ' . $this->table . ' 
                           
                             ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
 
    
                

        return $stmt;
        
    }
    
    
       public function get_userid($userName)
    {
        
        // Create query
        $query = 'SELECT *
        FROM ' . $this->table . ' 
                     WHERE userName= "' . $userName . '"     
                             ';


       
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
            return $row['id'];

  
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
     public function username_exist($userName,$wallet)
    {
        
        // Create query
        $query = 'SELECT *
        FROM ' . $this->table . ' 
                     WHERE userName= "' . $userName . '"    
                     AND wallet_address !="' . $wallet . '" 
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
          return true;;
     }
 
           

  
    }
//  public function notifications($id)
//     {
        
//         // Create query
//         $query = 'SELECT *
//         FROM nfts p,notifications n,creators u
//                      WHERE (n.tocken_id=p.tocken_id
//                      AND n.reciever_id="'.$id.'") 
//                      AND (n.owner_address=u.wallet_address)
//                      AND n.status=1
//                      ORDER BY 
//                      n.notifications_id
//                      DESC
//                              ';


       
//         // Prepare statement
//         $stmt = $this->conn->prepare($query);

//         // Execute query
//         $stmt->execute();
 
//             return $stmt;

  
//     }
//   public function insert_notification($bidderAddress,$owneraddress,$tockenId,$price)
//     {
        
//         // Create query
//         $query = 'INSERT INTO notifications SET reciever_id = :WalletId, tocken_id = :tockenId, owner_address = :contractAddress,auction_price=:price';

//         // Prepare statement
//         $stmt = $this->conn->prepare($query);

//         // Clean data
//         $owneraddress = htmlspecialchars(strip_tags($owneraddress));
//         $bidderAddress = htmlspecialchars(strip_tags($bidderAddress));
//         $tockenId = htmlspecialchars(strip_tags($tockenId));
//           $price = htmlspecialchars(strip_tags($price));

//         // Bind data
//         $stmt->bindParam(':WalletId', $bidderAddress);
//         $stmt->bindParam(':tockenId', $tockenId);
//         $stmt->bindParam(':contractAddress', $owneraddress);
//         $stmt->bindParam(':price', $price);
      


//         // Execute query
//         if ($stmt->execute()) {
//             return true;
//         }

//         // Print error if something goes wrong
//         printf("Error: %s.\n", $stmt->error);

//         return false;
//     }
    
  public function place_bid($contractAddress,$price,$nft_catagory_id,$ownerAddress)
    {
        
        // Create query
        $query = 'INSERT INTO biddings SET price = :price, nft_catagory_id = :nft_catagory_id, bidder_address = :bidderAddress, owner_addreess = :owner_addreess';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $contractAddress = htmlspecialchars(strip_tags($contractAddress));
        $price = htmlspecialchars(strip_tags($price));
        $nft_catagory_id = htmlspecialchars(strip_tags($nft_catagory_id));
         $ownerAddress = htmlspecialchars(strip_tags($ownerAddress));

        // Bind data
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':nft_catagory_id', $nft_catagory_id);
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
    public function signup($userName,$password,$firstName,$lastName)
    {
        $this->userName = $userName;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->password = $password;
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET userName = :userName, password = :password, firstName = :firstName, lastName = :lastName';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->userName = htmlspecialchars(strip_tags($this->userName));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->firstName = htmlspecialchars(strip_tags($this->firstName));
        $this->lastname = htmlspecialchars(strip_tags($this->lastName));

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
    
   //owners signup
   
    // Create Post
    public function owners_signup($userName,$password,$email,$firstName,$lastName,$address)
    {  
             
       
        // Create query
        $query = 'INSERT INTO owners SET 	userName = :userName, 	
        password = :password, email = :email, firstName = :firstName,
        lastName = :lastName, wallet_address=:wallet_address' ;

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        $this->userName = $userName;
        $this->password = $password;
        $this->email = $email;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->wallet_address = $address;
        
     
        
        
        // Clean data
        // this username is unique in database so no duplicate entry will be allowed
        $this->userName = htmlspecialchars(strip_tags($this->userName));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->firstName = htmlspecialchars(strip_tags($this->firstName));
        $this->lastName = htmlspecialchars(strip_tags($this->lastName));
        $this->wallet_address = htmlspecialchars(strip_tags($this->wallet_address));
        

        // Bind data
        $stmt->bindParam(':userName', $this->userName);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':firstName', $this->firstName);
        $stmt->bindParam(':lastName', $this->lastName);
        $stmt->bindParam(':wallet_address', $this->wallet_address);
        //   $stmt->bindParam(':dob', $this->dob);



        // Execute query
        if ($stmt->execute()) {
             exit();
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Update Post
    public function update_profile($userName,$firstName,$lastName,$bio,$wallet_address)
    {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET userName = :userName, firstName = :firstName,lastName= :lastName, bio = :bio
                                WHERE wallet_address = :wallet_address';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $userName = htmlspecialchars(strip_tags($userName));
        $firstName = htmlspecialchars(strip_tags($firstName));
        $lastName = htmlspecialchars(strip_tags($lastName));
        $bio = htmlspecialchars(strip_tags($bio));
     //   $instagram = htmlspecialchars(strip_tags($instagram));
     //   $twitter = htmlspecialchars(strip_tags($twitter));
        $wallet_address = htmlspecialchars(strip_tags($wallet_address));
        

        // Bind data
        $stmt->bindParam(':userName', $userName);
        $stmt->bindParam(':firstName', $firstName);
         $stmt->bindParam(':lastName', $lastName);
         $stmt->bindParam(':bio', $bio);
       //  $stmt->bindParam(':instagram', $instagram);
       //  $stmt->bindParam(':twitter', $twitter);
        $stmt->bindParam(':wallet_address', $wallet_address);

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
