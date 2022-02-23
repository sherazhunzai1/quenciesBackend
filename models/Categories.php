<?php
class Categories
{
    // DB stuff
    private $conn;
    private $table = 'categories';
    
    // Post Properties
    public $nft_category_id;
    public $category_name;
    public $description;
    public $icon;
    public $created_at;
    
    
      // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    public function insert_category($category_name,$description,$icon)
    {
        
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET category_name = :category_name, description = :description,icon = :icon,	created_at = :created_at,status =:status';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $category_name= htmlspecialchars(strip_tags($category_name));
         $description= htmlspecialchars(strip_tags($description));
         $icon= htmlspecialchars(strip_tags($icon));
        //  $uri= htmlspecialchars(strip_tags($uri));
        // ? $creatorWalletId= htmlspecialchars(strip_tags($creatorWalletId));
        // $tockenId= htmlspecialchars(strip_tags($tockenId));
        //     $url= htmlspecialchars(strip_tags($url));


        // Bind data
        $stmt->bindParam(':category_name', $category_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':nft_price', $price);
        $stmt->bindParam(':icon', $icon);
        // $stmt->bindParam(':tocken', $tockenId);
        // $stmt->bindParam(':walletAddress', $creatorWalletId);
        // $stmt->bindParam(':url', $url);


        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    
    public function getCategories($id,$start,$end)
    {   
       
        //Read the records and fill the categories
        $query = 'SELECT a.id as nftId,a.nft_name, a.nft_catagory,a.creatorName,a.countViews, a.nft_catagory_id,a.description,
        c.nft_category_id,c.category_name ,a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,
      a.description,u.userName,u.firstName,u.lastName,u.wallet_address,
      a.nft_price,u.id,max(b.price)
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                                
                              LEFT JOIN
                              bidding b
                              ON
                               (a.id=b.bidding_id)
                               JOIN 
                               categories c
                               ON
                               (a.nft_catagory_id= c.nft_category_id)
                               
                               where
                               (a.nft_catagory_id="'.$id.'" )
                             
                              group by a.id
                             order 
                             by
                            a.id
                             ASC
                             LIMIT '.$start.', '.$end.'
                             
                             ';
                              
                       
         // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
                    
        return $stmt;
         
    }
        
    public function getCategoriesCount($id)
    {   
       
        //Read the records and fill the categories
        $query = 'SELECT a.id as nftId,a.nft_name, a.nft_catagory,a.creatorName,a.countViews, a.nft_catagory_id,a.description,
        c.nft_category_id,c.category_name ,a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,
      a.description,u.userName,u.firstName,u.lastName,u.wallet_address,
      a.nft_price,u.id,max(b.price)
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                                
                              LEFT JOIN
                              bidding b
                              ON
                               (a.id=b.bidding_id)
                               JOIN 
                               categories c
                               ON
                               (a.nft_catagory_id= c.nft_category_id)
                               
                               where
                               (a.nft_catagory_id="'.$id.'" )
                             
                              group by a.id
                             order 
                             by
                            a.id
                             ASC
                             
                             
                             ';
                              
                       
         // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
                    
        return $stmt;
         
    }
     public function getcategoriesName()
    {   
        //Read the records and fill the categories
        $query = 'SELECT  nft_category_id,category_name, icon
                                FROM categories 
                              group by  nft_category_id
                             order 
                             by
                            nft_category_id
                            DESC
                             
                             ';
                              
                       
         // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
                    
        return $stmt;
         
    }
    public function getAllCategories($start,$end)
    {  
        //Read the records and fill the categories
        $query = 'SELECT a.id as nftId ,a.nft_name, a.nft_catagory,a.creatorName,a.countViews,a.nft_catagory_id,a.description,
        c.nft_category_id,c.category_name ,a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,
      a.description,u.userName,u.firstName,u.lastName,u.wallet_address,
      a.nft_price,u.id,max(b.price)
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                                
                              JOIN
                              categories c 
                              ON
                              (a.nft_catagory_id=c.nft_category_id)
                              LEFT JOIN
                              bidding b
                              ON
                               (a.id=b.bidding_id)
                               where 
                              ( a.nft_catagory_id= c.nft_category_id )
                              group by a.id
                             order 
                             by
                            a.id
                            ASC
                             LIMIT ' . $start . ' , ' . $end . '
                              ';
                              
                             
                              
         // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
    }
    public function getAllCategoriesCount()
    {  
        //Read the records and fill the categories
        $query = 'SELECT a.id as nftId ,a.nft_name, a.nft_catagory,a.creatorName,a.countViews,a.nft_catagory_id,a.description,
        c.nft_category_id,c.category_name ,a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,
      a.description,u.userName,u.firstName,u.lastName,u.wallet_address,
      a.nft_price,u.id,max(b.price)
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                                
                              JOIN
                              categories c 
                              ON
                              (a.nft_catagory_id=c.nft_category_id)
                              LEFT JOIN
                              bidding b
                              ON
                               (a.id=b.bidding_id)
                               where 
                              ( a.nft_catagory_id= c.nft_category_id )
                              group by a.id
                             order 
                             by
                            a.id
                            ASC
                        
                              ';
                              
                             
                              
         // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
    }
}
