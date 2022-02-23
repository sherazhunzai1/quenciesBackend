<?php
class Auctions
{
    // DB stuff
    private $conn;
    private $table = 'auctions';

    // Post Properties
    public $auction_id;
    public $product_id;
    public $creator_id;
    public $created_at;
    
  
    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }


     // collect Auction
     public function collect_auction($creator_id)
     {
         //create query
         $query= 'SELECT * 
         FROM ' . $this->table . ' 
         WHERE creator_id='.$creator_id.' ';
         
         // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
        return $stmt;
     }
     
    
     
    // Get Posts
    public function auction($creator_id,$product_id)
    {
       
        // Create query
        $query = 'SELECT CURRENT_TIMESTAMP(),auction_id,product_id,creator_id,created_at
                                FROM ' . $this->table . ' a,
                                creators u
                                WHERE a.creator_id=u.id
                               ORDER BY
                               product_id
                               DESC
                               LIMIT 1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
              $difference_in_seconds = (strtotime($row['end_time'])*1000) - (strtotime($row['CURRENT_TIMESTAMP()'])*1000);  
              
// $difference_in_seconds = (strtotime()*1000) - (strtotime($row['CURRENT_TIMESTAMP()'])*900);
        // Set properties
        $this->id = $row['id'];
        $this->productname = $row['nft_name'];
          $this->creatorname = $row['userName'];
       
         $this->creator_img = $row['img'];
        $this->art_img = $row['image'];
         $this->art_gif = $row['gif'];
        $this->start_time = $row['start_time'];
        $this->end_date = $difference_in_seconds;
         $this->nft_price =$row['nft_price'];
       $data=array(
           "id"=>$this->id,
           "nft_name"=>$this->productname,
           "art_gif"=>$this->art_gif,
           "creator_name"=>$this->creatorname,
            "creator_img"=>$this->creator_img,
           "art_img"=>$this->art_img,
           "start_time"=>$this->start_time,
           "end_time"=>$this->end_time,
           "nft_price"=>$this->nft_price
           );
        return $data;
        
    }
    
    
    
      public function nft_arts()
    {
       
        // Create query
        $query = 'SELECT CURRENT_TIMESTAMP(),id,product_name,product_id,start_date,end_date,image,img,gif,creator_id,name,gif,art_price
                                FROM ' . $this->table . ' a,
                                creators u
                                WHERE a.creator_id=u.id
                               ORDER BY
                               product_id
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
        $query = 'SELECT CURRENT_TIMESTAMP(),id,nft_name,product_id,start_time,end_time,image,gif,creator_id,userName,nft_price
                                FROM ' . $this->table . ' a,
                                creators u
                                WHERE a.creator_id=u.id
                                AND 
                                creator_id=' . $creator_id . '
                               ORDER BY
                               product_id
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
        $query = 'SELECT CURRENT_TIMESTAMP(),product_id,id,nft_name,start_time,
        end_time,image,gif,creator_id,userName,category_name,nft_category_id,nft_price
                                FROM ' . $this->table . ' a,
                                creators u,categories c
                                WHERE a.creator_id=u.id
                                AND
                                a.tocken_id=c.nft_category_id
                                AND
                                c.category_name="feature"
                               ORDER BY
                               product_id
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
        $query = 'SELECT CURRENT_TIMESTAMP(),product_id,id,nft_name,start_time,
        end_time,image,gif,creator_id,userName,category_name,nft_category_id
                                FROM ' . $this->table . ' a,
                                creators u,categories c
                                WHERE a.creator_id=u.id
                                AND
                                a.tocken_id=c.nft_category_id
                                AND
                                c.category_name="feature"
                               ORDER BY
                               product_id
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
        $query = 'SELECT CURRENT_TIMESTAMP(),product_id,id,nft_name,start_time,
        end_time,image,gif,creator_id,userName,category_name,nft_category_id
                                FROM ' . $this->table . ' a,
                                creators u,categories c
                                WHERE a.creator_id=u.id
                                AND
                                a.tocken_id=c.nft_category_id
                                AND
                                c.category_name="live auction"
                               ORDER BY
                               product_id
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
        $query = 'SELECT CURRENT_TIMESTAMP(),product_id,id,nft_name,start_time,
        end_time,image,gif,creator_id,userName,category_name,nft_category_id
                                FROM ' . $this->table . ' a,
                                creators u,categories c
                                WHERE a.creator_id=u.id
                                AND
                                a.tocken_id=c.nft_category_id
                                AND
                                c.category_name="live auction"
                               ORDER BY
                               product_id
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
        $query = 'SELECT CURRENT_TIMESTAMP(),product_id,id,nft_name,start_time,
        end_time,image,gif,creator_id,userName,category_name,nft_category_id
                                FROM ' . $this->table . ' a,
                                creators u,categories c
                                WHERE a.creator_id=u.id
                                AND
                                a.tocken_id=c.nft_category_id
                                AND
                                c.category_name="sold"
                               ORDER BY
                               product_id
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
        $query = 'SELECT CURRENT_TIMESTAMP(),product_id,id,nft_name,start_time,
        end_time,image,gif,creator_id,userName,category_name,nft_category_id
                                FROM ' . $this->table . ' a,
                                creators u,categories c
                                WHERE a.creator_id=u.id
                                AND
                                a.tocken_id=c.nft_category_id
                                AND
                                c.category_name="sold"
                               ORDER BY
                               product_id
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
        $query = 'SELECT CURRENT_TIMESTAMP(),product_id,id,nft_name,start_time,
        end_time,image,gif,creator_id,userName,category_name,nft_category_id
                                FROM ' . $this->table . ' a,
                                creators u,categories c
                                WHERE a.creator_id=u.id
                                AND
                                a.tocken_id=c.nft_category_id
                                AND
                                c.category_name="reserve not met"
                               ORDER BY
                               product_id
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
        $query = 'SELECT CURRENT_TIMESTAMP(),product_id,id,nft_name,start_time,
        end_time,image,gif,creator_id,userName,category_name,nft_category_id
                                FROM ' . $this->table . ' a,
                                creators u,categories c
                                WHERE a.creator_id=u.id
                                AND
                                a.tocken_id=c.nft_category_id
                                AND
                                c.category_name="reserve not met"
                               ORDER BY
                               product_id
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
      $query = 'SELECT CURRENT_TIMESTAMP(),product_id,id,nft_name,start_time,
      end_time,image,gif,creator_id,userName,category_name,nft_category_id
                                FROM ' . $this->table . ' a,
                                creators u,categories c
                                WHERE a.creator_id=u.id
                                AND
                                a.tocken_id=c.nft_category_id
                                AND
                               product_id=' . $id . ' ';
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
        $this->end_date =$difference_in_seconds;
       $data=array(
           "id"=>$this->id,
           "nft_name"=>$this->name,
           "art_gif"=>$this->art_gif,
           "creator_name"=>$this->name,
            "creator_img"=>$this->creator_img,
           "art_img"=>$this->art_img,
           "start_time"=>$this->start_time,
           "end_date_in_milliseconds"=>$this->end_time);
        return $data;
    }

    // Create Post
    public function insert($creator_id, $product_id,$price)
    {
        $this->creator_id = $creator_id;
        $this->product_id = $product_id;
        $this->price = $price;
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET creator_id = :creator_id, product_id = :product_id, price =:price';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->creator_id = htmlspecialchars(strip_tags($this->creator_id));
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->price = htmlspecialchars(strip_tags($this->price));

        // Bind data
        $stmt->bindParam(':creator_id', $this->creator_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':price', $this->price);

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
    public function setAuction($auctionId,$tokenId,$owner_address,$transactionHash,$reservePrice,$endTimeInSeconds)
    {
   
        
        $query = 'INSERT INTO ' . $this->table . ' SET auctionId=:auctionId,owner_address=:owner_address,transactionHash=:transactionHash,reservePrice=:reservePrice,endTimeInSeconds=:endTimeInSeconds,tokenId=:tokenId
                            ';
        // Prepare statement
        $stmt = $this->conn->prepare($query);

    // Clean data
        $auctionId = htmlspecialchars(strip_tags($auctionId));
        $tokenId = htmlspecialchars(strip_tags($tokenId));
        $owner_address = htmlspecialchars(strip_tags($owner_address));
        $transactionHash = htmlspecialchars(strip_tags($transactionHash));
        $reservePrice = htmlspecialchars(strip_tags($reservePrice));
        $endTimeInSeconds = htmlspecialchars(strip_tags($endTimeInSeconds));
        // Bind data
        $stmt->bindParam(':auctionId', $auctionId);
        $stmt->bindParam(':tokenId', $tokenId);
        $stmt->bindParam(':owner_address', $owner_address);
        $stmt->bindParam(':transactionHash', $transactionHash);
        $stmt->bindParam(':reservePrice', $reservePrice);
        $stmt->bindParam(':endTimeInSeconds', $endTimeInSeconds);
    
    
       
        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
        

}
    
}
