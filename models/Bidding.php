<?php
class Bidding
{
    // DB stuff
    private $conn;
    private $table = 'bidding';

    // Post Properties
    public $bidding_id;
    public $product_id;
    public $creator_id;
    public $price;
    public $created_at;
    public $id;
   
  


    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Posts
    public function get_bidding($nft_catagory)
    {
        
       
        // Create query
        $query ='SELECT * 
              FROM '.$this->table . ' 
               WHERE price= (select max(price)
               FROM '.$this->table .'
               WHERE nft_catagory='.$nft_catagory.')
               LIMIT 1';

      
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
        
          
           
    return  $stmt;
    
        
    }
    
    
    
      public function nft_arts()
    {
       
        // Create query
        $query = 'SELECT CURRENT_TIMESTAMP(),a.id,a.nft_name,a.nft_catagory,a.start_time,
        a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.gif,a.nft_price
                                FROM  nfts a,
                                creators u
                                WHERE a.creator_id=u.id
                               ORDER BY
                               id
                               DESC    ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
       public function arts_by_creators($creator_id)
    {
       
        // Create query
        $query = 'SELECT CURRENT_TIMESTAMP(),a.id,a.nft_name,a.nft_catagory,a.start_time,
        a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.gif,a.nft_price
                                FROM  nfts a,
                                creators u
                                WHERE a.creator_id=u.id
                                AND 
                                creator_id=' . $creator_id . '
                               ORDER BY
                               id
                               DESC    ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
    
    
    
    
    public function feature_arts($start=1,$end=16)
    {
       
        // Create query
        $query = 'SELECT CURRENT_TIMESTAMP(),a.id,a.nft_name,a.nft_catagory,a.start_time,
        a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.gif,a.nft_price
                                FROM  nfts a,
                                creators u,categories c
                                WHERE a.creator_id=u.id
                                AND
                                a.id=c.nft_category_id
                               ORDER BY
                               id
                               DESC
                               LIMIT ' . $start . ' , ' . $end . '';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
     public function total_feature_arts()
    {
       
        // Create query
        $query = 'SELECT CURRENT_TIMESTAMP(),a.id,a.nft_name,a.nft_catagory,a.start_time,
        a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.gif,a.nft_price
                                FROM  nfts a,
                                creators u,categories c
                                WHERE a.creator_id=u.id
                                AND
                                a.id=c.nft_category_id
                               ORDER BY
                               id
                               DESC
                               ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
     public function live_auction_arts($start=0,$end=3)
    {
      
        // Create query
        $query = 'SELECT CURRENT_TIMESTAMP(),a.id,a.nft_name,a.nft_catagory,a.start_time,
        a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.gif,a.nft_price
                                FROM  nfts a,
                                creators u,categories c
                                WHERE a.creator_id=u.id
                                AND
                                a.id=c.nft_category_id
                               ORDER BY
                               id
                               DESC  
                               LIMIT ' . $start . ' , ' . $end . '';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
    public function  total_live_auction_arts()
    {
      
        // Create query
        $query = 'SELECT CURRENT_TIMESTAMP(),a.id,a.nft_name,a.nft_catagory,a.start_time,
        a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.gif,a.nft_price
                                FROM  nfts a,
                                creators u,categories c
                                WHERE a.creator_id=u.id
                                AND
                                  a.id=c.nft_category_id
                               ORDER BY
                              id
                               DESC  
                              ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
    public function sold_arts($start=0,$end=3)
    {
       
        // Create query
        $query = 'SELECT CURRENT_TIMESTAMP(),a.id,a.nft_name,a.nft_catagory,a.start_time,
        a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.gif,a.nft_price
                                FROM  nfts a,
                                creators u,categories c
                                WHERE 
                                a.creator_id=u.id
                                AND
                                a.id=c.nft_category_id
                               
                               ORDER BY
                              id
                               DESC   
                               LIMIT ' . $start . ' , ' . $end . '';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
       public function total_sold_arts()
    {
       
        // Create query
        $query = 'SELECT CURRENT_TIMESTAMP(),a.id,a.nft_name,a.nft_catagory,a.start_time,
        a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.gif,a.nft_price
                                FROM  nfts a,
                                creators u,categories c
                                WHERE a.creator_id=u.id
                                AND
                               a.id=c.nft_category_id
                               
                               ORDER BY
                               id
                               DESC   
                             ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
    public function reserved_arts($start=0,$end=3)
    {
       
        // Create query
        $query = 'SELECT CURRENT_TIMESTAMP(),a.id,a.nft_name,a.nft_catagory,a.start_time,
        a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.gif,a.nft_price
                                FROM  nfts a,
                                creators u,categories c
                                WHERE a.creator_id=u.id
                                AND
                                a.id=c.nft_category_id
                              
                               ORDER BY
                               id
                               DESC 
                                 LIMIT ' . $start . ' , ' . $end . '';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
 public function total_reserved_arts()
    {
       
        // Create query
        $query = 'SELECT CURRENT_TIMESTAMP(),a.id,a.nft_name,a.nft_catagory,a.start_time,
        a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.gif,a.nft_price
                                FROM  nfts a,
                                creators u,categories c
                                WHERE a.creator_id=u.id
                                AND
                                a.id=c.nft_category_id
                              
                               ORDER BY
                               id
                               DESC 
                               ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }

    // Get Single Post
    public function single_art($id)
    {
        // Create query
      $query = 'SELECT CURRENT_TIMESTAMP(),a.id,a.nft_name,a.start_time,
      a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,c.category_name,c.nft_category_id
                                FROM nfts a,
                                creators u,categories c
                                WHERE a.creator_id=u.id
                                AND
                                a.id=c.nft_category_id
                              
                                AND
                               a.id= '.$id.' ';
                               
$stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
                
$difference_in_seconds = (strtotime($row['end_time'])*1000) - (strtotime($row['CURRENT_TIMESTAMP()'])*900);
        // Set properties
        $this->id = $row['id'];
        $this->name = $row['nft_name'];
        $this->creator_name = $row['userName'];
        $this->creator_img = $row['img'];
        $this->art_img = $row['image'];
         $this->art_gif = $row['gif'];
        $this->start_time = $row['start_time'];
        $this->end_time =$difference_in_seconds;
       $data=array(
           "id"=>$this->id,
           "art_name"=>$this->name,
           "art_gif"=>$this->art_gif,
           "creator_name"=>$this->name,
            "creator_img"=>$this->creator_img,
           "art_img"=>$this->art_img,
           "start_time"=>$this->start_time,
           "end_date_in_milliseconds"=>$this->end_time);
        return $data;
    }

    // Create Post
    public function signup($userName, $password)
    {
        $this->userName = $userName;
        $this->password = $password;
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET name = :userName, password = :password';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->userName = htmlspecialchars(strip_tags($this->userName));
        $this->password = htmlspecialchars(strip_tags($this->password));


        // Bind data
        $stmt->bindParam(':userName', $this->userName);
        $stmt->bindParam(':password', $this->password);


        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Update Post
    public function update()
    {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET title = :title, body = :body, author = :author, category_id = :category_id
                                WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

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
     public function startBidding($listing_id,$token_id,$bidder_address,$owner_addreess,$price,$txHash)
    {
        
        // Create query
        $query = 'INSERT INTO ' . $this->table . '
                                SET listing_id =:listing_id,token_id = :token_id,bidder_address =:bidder_address,owner_addreess	 = :owner_addreess, price=:price,txHash=:txHash
                               
                  ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
         $listing_id = htmlspecialchars(strip_tags($listing_id));
        $token_id = htmlspecialchars(strip_tags($token_id));
        $bidder_address = htmlspecialchars(strip_tags($bidder_address));
        $owner_addreess = htmlspecialchars(strip_tags($owner_addreess));
        $price = htmlspecialchars(strip_tags($price));
        $txHash = htmlspecialchars(strip_tags($txHash));
        // Bind data
        $stmt->bindParam(':listing_id', $listing_id);
        $stmt->bindParam(':token_id', $token_id);
        $stmt->bindParam(':bidder_address', $bidder_address);

        $stmt->bindParam(':owner_addreess', $owner_addreess);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':txHash', $txHash);
        
       
         // Execute query
      $stmt->execute();
     
        return  $stmt;
    }
           public function updateHighestBid($token_id,$highestBid)
    {
        
        // Create query
        $query = 'UPDATE listing
                                SET highestBid =:highestBid
                                WHERE
                                token_id=:token_id
                                AND
                                status = 1
                  ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
         $token_id = htmlspecialchars(strip_tags($token_id));
        $highestBid = htmlspecialchars(strip_tags($highestBid));

        // Bind data
        $stmt->bindParam(':highestBid', $highestBid);
        $stmt->bindParam(':token_id', $token_id);
        
        
       
         // Execute query
      $stmt->execute();
     
        return  $stmt;
    }
            public function settleStatus($listing_id,$owner_id)
    {
        
        // Create query
        $query = 'UPDATE bidding
                                SET status =0
                                WHERE
                                listing_id=:listing_id
                                AND
                                bidder_address=:bidder_address
                  ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        
        // $sell = htmlspecialchars(strip_tags($sell));
        $listing_id = htmlspecialchars(strip_tags($listing_id));
         $owner_id = htmlspecialchars(strip_tags($owner_id));
        
      
       

        // Bind data
        // $stmt->bindParam(':$sell', $sell);
        $stmt->bindParam(':listing_id', $listing_id);

        $stmt->bindParam(':bidder_address', $owner_id);
        
             if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
     public function BiddingHistory($bidder_address)
    {
        
        // Create query
        $query = 'SELECT *
        FROM ' . $this->table . ' 
                     WHERE bidder_address=:bidder_address  
                     AND
                     status=1
                             ';


       
        // Prepare statement
        $stmt = $this->conn->prepare($query);

    // Clean data
        
         $bidder_address = htmlspecialchars(strip_tags($bidder_address));
        
      
       

        // Bind data

        $stmt->bindParam(':bidder_address', $bidder_address);

        // Execute query
        $stmt->execute();
 
            return $stmt;

  
    } 
     public function bidStatusOff($bidding_id)
    {
        
        // Create query
        $query = 'UPDATE bidding
                                SET status =0
                                WHERE
                                bidding_id=:bidding_id
                               
                  ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
 
        $bidding_id = htmlspecialchars(strip_tags($bidding_id));
         
        
      
       

        // Bind data
    
        $stmt->bindParam(':bidding_id', $bidding_id);

     
        
             if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
