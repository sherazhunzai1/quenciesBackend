<?php
class Auction
{
    // DB stuff
    private $conn;
    private $table = 'nfts';
 
    // Post Properties
    public $id;
    public $nft_name;
    public $creatorname;
    public $creator_name;
    public $creator_img;
    public $art_img;
    public $art_gif;
    public $nft_price;
    public $countViews;
    public $start_time;
    public $end_time;
    public $owner_walletAddres;
    public $owner_img;
    public $owner_name;
    public $creator_walletAddress;
    public $nft_catagory;
  //  public $imageUrl;
  
    


    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Posts
    public function auction_timer()
    {
       
        // Create query
        $query ='SELECT a.id,a.nft_name, a.nft_catagory,a.creatorName,a.countViews,a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.auction,a.sell,u.wallet_address,a.nft_price,max(b.price)
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                              LEFT JOIN
                              bidding b
                              ON
                                (a.id=b.bidding_id)
                              GROUP BY a.id
                               ORDER BY
                               a.id
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
          $this->creatorname = $row['creatorName'];
       
         $this->creator_img = $row['img'];
        $this->art_img = $row['image'];
         $this->art_gif = $row['gif'];
        $this->start_time = $row['start_time'];
        $this->end_time = $difference_in_seconds;
         $this->art_price =$row['nft_price'];
        //  $this->token_id =$row['tocken_id'];
         $this->creator_walletAddress =$row['creator_id'];
        

       $data=array(
           "id"=>$this->id,
           "nft_name"=>$this->productname,
           "art_gif"=>$this->art_gif,
           "creator_name"=>$this->creatorname,
            "creator_img"=>$this->creator_img,
            "creator_walletAddress"=>$this->creator_walletAddress,
           "art_img"=>$this->art_img,
           "start_time"=>$this->start_time,
           "end_time"=>$this->end_time,
           "nft_price"=>$this->nft_price,
        //   "tokenId" => $this->token_id,
           "higgestBid" => $row['max(b.price)']
        
           );
        return $data;
        
    }
    
    
    
      public function nft_arts()
    {
       
        // Create query
        $query = 'SELECT a.id as nftId,a.nft_name, a.nft_catagory,a.creatorName,a.countViews,
        a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.auction,a.sell,
        u.wallet_address,a.nft_price,max(b.price)
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                              LEFT JOIN
                              bidding b
                              ON
                               (a.id=b.bidding_id)
                            
                              GROUP BY a.id
                              
                                ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
       public function created_arts($address)
    {
       
        // Create query
        $query = 'SELECT a.id as nftId ,a.nft_name, a.nft_catagory,a.creatorName,a.countViews,a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.auction,a.sell,u.wallet_address,a.nft_price,max(b.price)
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                               
                              LEFT JOIN
                              bidding b
                              ON
                               (a.id=b.bidding_id)
                              WHERE 
                              a.creator_id='.$address.'
                              GROUP BY a.id   ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
    
    
    
    
    public function feature_arts($start,$end)
    {
    
        // Create query
        $query = 'SELECT a.id,a.nft_name, a.nft_catagory,a.creatorName,a.countViews,a.description, a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,u.wallet_address,a.nft_price,max(b.price),a.sequence
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                              LEFT JOIN
                              bidding b
                              ON
                                (a.id=b.bidding_id)
                                
                                WHERE
                                (a.feature =1)
                              GROUP BY a.id
                               ORDER BY
                               a.id
                               ASC
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
        $query = 'SELECT a.id,a.nft_name, a.nft_catagory,a.creatorName,a.countViews,a.description, a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,u.wallet_address,a.nft_price,max(b.price),a.sequence
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                              LEFT JOIN
                              bidding b
                              ON
                                (a.id=b.bidding_id)
                                WHERE
                                (a.feature =1)
                              GROUP BY a.id
                               ORDER BY
                               a.id
                               ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
     public function live_auction_arts($start,$end)
    {  
        // Create query
        $query = 'SELECT a.id,a.nft_name,a.nft_catagory,a.creatorName,a.countViews, a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,u.wallet_address,a.nft_price,max(b.price),a.description,a.sequence
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                                
                              LEFT JOIN
                              bidding b
                              ON
                               (a.id=b.bidding_id)
                                    WHERE
                               (a.auction = 1)
                              GROUP BY a.id
                               ORDER BY
                               a.id
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
        $query = 'SELECT a.id,a.nft_name, a.nft_catagory,a.creatorName,a.countViews,a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,a.auction,a.sell,a.description,
        u.userName,u.wallet_address,a.nft_price,max(b.price),a.sequence
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                              LEFT JOIN
                              bidding b
                              ON
                              (a.id=b.bidding_id)
                              where 
                              (a.auction = 1)
                              GROUP BY a.id
                               ORDER BY
                               a.id
                               DESC
                              ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
      public function hot_collections($start,$end)
    {
        // Create query
        $query = 'SELECT a.id,a.nft_name, a.nft_catagory,a.creatorName,a.countViews, a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.auction,a.sell,
        u.wallet_address,a.nft_price,a.description,a.sequence
        ,max(b.price)
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                              LEFT JOIN
                              bidding b
                              ON
                              (a.id=b.bidding_id)
                              WHERE
                              (a.hotCollections= 1)
                              GROUP BY a.id
                               ORDER BY
                               a.sequence
                               
                               LIMIT ' . $start . ' , ' . $end . '';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
        
    }
    public function total_hotcollections_arts()
    {
      
        // Create query
        $query = 'SELECT a.id,a.nft_name, a.nft_catagory,a.creatorName,a.countViews,a.description, a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.auction,a.sell,u.wallet_address,a.nft_price,max(b.price),a.sequence
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                              LEFT JOIN
                              bidding b
                              ON
                                (a.id=b.bidding_id)
                                WHERE
                                (a.hotCollections= 1)
                              GROUP BY a.id
                               ORDER BY
                               a.id
                               ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
    
    public function trendingcollections($start,$end)
    {
    
        // Create query
        $query = 'SELECT a.id,a.nft_name, a.nft_catagory,a.creatorName,a.countViews,a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.auction,a.sell,u.wallet_address,a.nft_price,max(b.price),a.description,a.sequence
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                              LEFT JOIN
                              bidding b
                              ON
                              (a.id=b.bidding_id)
                              WHERE
                              (a.trendingCollections= 1)
                              GROUP BY a.id
                               ORDER BY
                               a.id
                               DESC
                               LIMIT ' . $start . ' , ' . $end . '';
                              ;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
        
    }
    
    public function total_trendingcollections()
    {
    
        // Create query
        $query = 'SELECT a.id,a.nft_name, a.nft_catagory,a.creatorName,a.countViews,a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.auction,a.sell,u.wallet_address,a.nft_price,max(b.price),a.description,a.sequence
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                              LEFT JOIN
                              bidding b
                              ON
                              (a.id=b.bidding_id)
                              WHERE
                              (a.trendingCollections= 1)
                              GROUP BY a.id
                               ORDER BY
                               a.id
                               DESC
                               ';
                              ;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
        
    }
     
     public function itemsCollection($start,$end)
    {
    
        // Create query
        $query = 'SELECT a.id as nftId,a.nft_name, a.nft_catagory, 
        c.nft_category_id,c.category_name ,a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,a.countViews,
      a.description,u.userName,u.firstName,u.lastName,u.wallet_address,a.creatorName,a.description,
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
                              group by a.id
                              ORDER BY
                              a.id
                              asc
                               LIMIT ' . $start . ' , ' . $end . ''
                              ;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
        
    }
     // myitems 
     public function total_itemsCollection()
    {
    
        // Create query
        $query = 'SELECT a.id as nftId,a.nft_name, a.nft_catagory, 
        c.nft_category_id,c.category_name ,a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,a.countViews,
      a.description,u.userName,u.firstName,u.lastName,u.wallet_address,a.creatorName,a.description,
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
                              group by a.id
                              ORDER BY
                              a.id
                              asc'
                              ;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
        
    }
    
     public function itemDetails($nftId)
    {
    
        // Create query
        $query = 'SELECT a.id as nftId,a.nft_name,a.metaData, a.nft_catagory, c.nft_category_id,c.category_name ,a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,a.countViews, a.description,a.type,a.tokenId,u.userName,u.firstName,u.lastName,u.wallet_address,a.creatorName,a.sell,a.nft_price,u.id,l.nftId,l.creatorId,l.likesId,a.description,li.status as listingstatus,li.nft_id,li.saleid,li.action as listingType,ow.userName as owner_username,ow.wallet_address as owner_wallet,ow.img as ownerImg,li.price as saleprice, li.highestBid,li.endTimeInSeconds
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                                JOIN
                                creators ow
                                ON
                                (a.owner_id=ow.wallet_address)
                               JOIN
                              categories c 
                              ON
                              (a.nft_catagory_id=c.nft_category_id)
                             LEFT JOIN
                             listing li
                             ON
                             (li.nft_id=a.id  AND li.status=1)
                              LEFT JOIN
                              likes l
                              ON
                               (a.id=l.nftId)
                              WHERE
                             a.id='.$nftId.'
                            
                             
                              GROUP BY a.id
                              ORDER BY
                              li.listing_id
                              DESC'
                              ;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
        
    }
    public function myitems($userName)
    { 
        
        // Create query
        $query = 'SELECT a.id,a.creatorName,a.nft_name, a.nft_catagory,a.image ,a.nft_catagory_id
                                FROM nfts a
                                
                              where
                              (a.creatorName="'.$userName.'")
                              GROUP BY a.id
                              ORDER BY
                              a.id
                              DESC'
                              ;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
      
    }
    
     public function search_nft($search)
    {
        // Create query
        $query = 'SELECT a.id as nftId,a.nft_name, a.nft_catagory,
        a.creatorName,a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,a.countViews,a.nft_catagory_id,u.userName,u.wallet_address,a.nft_price,a.auction,a.sell,a.description,max(b.price)
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                              LEFT JOIN
                              bidding b
                              ON
                               (a.id=b.bidding_id)
                              WHERE
                              a.nft_name LIKE "%'.$search.'%"
                              GROUP BY a.id
                               ORDER BY
                               a.id
                               DESC
                              ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
 
        return $stmt;
        
    }
    
    public function sold_arts($start=0,$end=8)
    {
       
        // Create query
        $query = 'SELECT a.id,a.nft_name, a.nft_catagory,a.creatorName,a.countViews,a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.auction,a.sell,u.wallet_address,a.nft_price,a.description,max(b.price)
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                              LEFT JOIN
                              bidding b
                              ON
                               (a.id=b.bidding_id)
                               WHERE
                              (a.sell = 1)
                               GROUP BY 
                               a.id
                               ORDER BY
                               a.id
                               DESC
                               LIMIT  0,8
                              ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
       public function total_sold_arts()
    {
       
        // Create query
        $query = 'SELECT CURRENT_TIMESTAMP(),a.id,a.nft_name, a.nft_catagory,a.creatorName,a.countViews, a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.auction,a.sell, u.wallet_address,a.nft_price,a.description,max(b.price)
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                              LEFT JOIN
                              bidding b
                              ON
                              (a.id=b.bidding_id)
                              WHERE
                              (a.sell = 1)
                              GROUP BY a.id
                               ORDER BY
                               a.id
                               DESC
                             ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
    
        public function arts_by_creators($address)
    {
       
        // Create query
        $query = 'SELECT CURRENT_TIMESTAMP(),a.id,a.nft_name, a.nft_catagory,a.creatorName,a.countViews,a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.auction,a.sell,
        u.wallet_address,a.nft_price,a.description,max(b.price)
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                                
                              LEFT JOIN
                              bidding b
                              ON
                              (a.id=b.bidding_id)
                              WHERE
                              a.creator_id="'.$address.'"
                              GROUP BY a.id
                               ORDER BY
                               a.id
                               DESC
                              ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
       public function collections($address)
    {
       
        // Create query
        $query = 'SELECT CURRENT_TIMESTAMP(),a.id,a.nft_name, a.nft_catagory,
        a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.auction,a.sell,u.wallet_address,a.nft_price,a.countViews,a.description,max(b.price)
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                              LEFT JOIN
                              bidding b
                              ON
                              (a.id=b.bidding_id)
                              WHERE
                             (a.creator_id="'.$address.'")
                              GROUP BY a.id
                               ORDER BY
                               a.id
                               DESC
                              ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
    public function reserved_arts($start=0,$end=8)
    {
       
        // Create query
        $query = 'SELECT CURRENT_TIMESTAMP(),a.id,a.nft_name, a.nft_catagory,
        a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.auction,a.sell,u.wallet_address,a.nft_price,a.countViews,a.description,max(b.price)
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                              LEFT JOIN
                              bidding b
                              ON
                              (a.id=b.bidding_id)
                              GROUP BY a.id
                               ORDER BY
                               a.id
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
        $query = 'SELECT CURRENT_TIMESTAMP(),a.id,a.nft_name, a.catagory,
        a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,u.userName,a.auction,a.sell,a.description,
        u.wallet_address,a.nft_price,a.countViews,max(b.price)
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                                
                              LEFT JOIN
                              bidding b
                              ON
                              (a.id=b.bidding_id)
                              GROUP BY a.id
                               ORDER BY
                               a.id
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
      $query = 'SELECT a.id,a.nft_name, a.nft_catagory,
      a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,a.countViews,
      a.description,u.userName,u.firstName,u.lastName,u.wallet_address,a.auction,a.sell,a.description,
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
                              WHERE
                               (a.id=' . $id . ')
                               group by
                               a.id
                              
                            
                              ';
$stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        return $row;
    }
     public function sellers()
    {  
    
      $query = 'SELECT id,img,userName,firstName,lastName,wallet_address,cover,bio
      
                            FROM creators
                              
                              ';

$stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
      
    // $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        return  $stmt;

      }
      
      public function images($start=0,$end=3)
      {
          $query = 'SELECT id,img from creators 
                              GROUP BY id
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
      
    public function get_creator_id($creatorWalletId)
    {
        
        
        // Create query
      $query = 'SELECT * FROM creators
                                
                                where
                               wallet_address=' . $creatorWalletId . ' ';
$stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        return $row['id'];
    }
    
    
    //create nft
     public function mint($artworkName,$description,$metaData,$imageUri,$creator_id,$nft_catagory_id,$owner_id)
    { 
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET nft_name = :nft_name,
       description = :description, image = :image, metaData=:metaData, creator_id=:creator_id,nft_catagory_id=:nft_catagory_id,owner_id=:creator_id  ';
    
        $stmt = $this->conn->prepare($query);

        // Clean data
        $artworkName= htmlspecialchars(strip_tags($artworkName));
         $description= htmlspecialchars(strip_tags($description));
          $imageUri= htmlspecialchars(strip_tags($imageUri));
         $metaData= htmlspecialchars(strip_tags($metaData));
         $creator_id= htmlspecialchars(strip_tags($creator_id));
          $nft_catagory_id= htmlspecialchars(strip_tags($nft_catagory_id));
          $owner_id= htmlspecialchars(strip_tags($owner_id));
         
        //     $url= htmlspecialchars(strip_tags($url));
 
 
        // Bind data
        $stmt->bindParam(':nft_name', $artworkName);
        $stmt->bindParam(':description', $description);
        
        $stmt->bindParam(':image', $imageUri);
        $stmt->bindParam(':metaData', $metaData);
        $stmt->bindParam(':creator_id', $creator_id);
        $stmt->bindParam(':nft_catagory_id', $nft_catagory_id);
        $stmt->bindParam(':creator_id', $owner_id);
        // $stmt->bindParam(':url', $url);


        // Execute query
        if ($stmt->execute()) {
            $LAST_ID = $this->conn->lastInsertId();
        
            return $LAST_ID;
        }
    
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    
   
    //set fixed price
  public function setprice($id,$nft_price,$nft_catagory_id)
   {  
       
       // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET sell =1,auction=0, nft_price = :nft_price, nft_catagory_id=:nft_catagory_id
                                  WHERE
                                
                                id=:id
                                ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

       $id= htmlspecialchars(strip_tags($id));
        $nft_price= htmlspecialchars(strip_tags($nft_price));
         $nft_catagory_id= htmlspecialchars(strip_tags($nft_catagory_id));
          
         
        // Bind data
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nft_price', $nft_price);
         $stmt->bindParam(':nft_catagory_id', $nft_catagory_id);
        
       

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
}

 public function setOffer($id,$nft_price,$nft_catagory_id,$start_time,$end_time)
   {    
       
       
       // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET auction= 1,sell= 0,  nft_price = :nft_price, nft_catagory_id=:nft_catagory_id, 
                                start_time =:start_time, end_time= :end_time
                                  WHERE
                                id=:id
                                ';
      
 // Prepare statement
        $stmt = $this->conn->prepare($query);

       $id= htmlspecialchars(strip_tags($id));
        $nft_price= htmlspecialchars(strip_tags($nft_price));
         $nft_catagory_id= htmlspecialchars(strip_tags($nft_catagory_id));
          $start_time= htmlspecialchars(strip_tags($start_time));
              $end_time= htmlspecialchars(strip_tags($end_time));
         
      
        // Bind data
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nft_price', $nft_price);
         $stmt->bindParam(':nft_catagory_id', $nft_catagory_id);
       $stmt->bindParam(':start_time', $start_time);
        $stmt->bindParam(':end_time', $end_time);
       
    
      
        // Execute query
        if ($stmt->execute()) {
            return true ;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
}
     
      //create countViews NFT
 public function getNFTViews($id)
    {
      
        // Create query
     $query = 'UPDATE nfts SET countViews = countViews + 1 WHERE id = '.$id. ' ';
      
        
     // Prepare statement
        $stmt = $this->conn->prepare($query);
  
  $id= htmlspecialchars(strip_tags($id));
  
   // Bind data
        $stmt->bindParam(':id', $id);
        
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
    
      $query = 'SELECT id, countViews  FROM nfts where id='.$id.'  ';

               $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
     
        return  $stmt;

     
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
    
    public function updateSell($id,$nft_price)
    {
        
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET sell =1,nft_price = :nft_price 
                                WHERE
                                id=:id
                  ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        
        // $sell = htmlspecialchars(strip_tags($sell));
        $nft_price = htmlspecialchars(strip_tags($nft_price));
         $id = htmlspecialchars(strip_tags($id));
        
      
       

        // Bind data
        // $stmt->bindParam(':$sell', $sell);
        $stmt->bindParam(':nft_price', $nft_price);

        $stmt->bindParam(':id', $id);
        
       
         // Execute query
      $stmt->execute();
     
        return  $stmt;
    }
    
     public function onListing($tokenid,$price)
    {
        
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET sell = 1,auction = 0,nft_price=:price,type="secondary"
                                WHERE
                                tokenId=:tokenId
                  ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
         $tokenid = htmlspecialchars(strip_tags($tokenid));
        $price = htmlspecialchars(strip_tags($price));

        // Bind data
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':tokenId', $tokenid);
        
        
       
         // Execute query
      $stmt->execute();
     
        return  $stmt;
    }
    
    
    
    
    
     public function secondaryListing($nft_id,$tokenid,$price,$txHash,$saleId)
    {
        
        // Create query
        $query = 'INSERT INTO listing
                                SET nft_id=:nft_id, token_id =:tokenId,saleid = :saleid,price =:price,txHash	 = :txHash	,type = "secondary",action="fixPrice"
                               
                  ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $nft_id = htmlspecialchars(strip_tags($nft_id));
         $tokenid = htmlspecialchars(strip_tags($tokenid));
        $price = htmlspecialchars(strip_tags($price));
        $txHash = htmlspecialchars(strip_tags($txHash));
        $saleId = htmlspecialchars(strip_tags($saleId));
        // Bind data
        $stmt->bindParam(':nft_id', $nft_id);
        $stmt->bindParam(':saleid', $saleId);
        $stmt->bindParam(':tokenId', $tokenid);
        $stmt->bindParam(':price', $price);

        $stmt->bindParam(':txHash', $txHash);
        
       
         // Execute query
      $stmt->execute();
     
        return  $stmt;
    }
     public function auctionListing($nftId,$tokenid,$price,$txHash,$saleId,$endTimeInSeconds)
    {
        
        // Create query
        $query = 'INSERT INTO listing
                                SET nft_id=:nft_id, token_id =:tokenId,saleid = :saleid,price =:price,txHash	 = :txHash, endTimeInSeconds=:endTimeInSeconds,type = "secondary",action="auction"
                               
                  ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $nftId = htmlspecialchars(strip_tags($nftId));
         $tokenid = htmlspecialchars(strip_tags($tokenid));
        $price = htmlspecialchars(strip_tags($price));
        $txHash = htmlspecialchars(strip_tags($txHash));
        $saleId = htmlspecialchars(strip_tags($saleId));
        $endTimeInSeconds = htmlspecialchars(strip_tags($endTimeInSeconds));
        // Bind data
         $stmt->bindParam(':nft_id', $nftId);
        $stmt->bindParam(':saleid', $saleId);
        $stmt->bindParam(':tokenId', $tokenid);
        $stmt->bindParam(':price', $price);

        $stmt->bindParam(':txHash', $txHash);
        $stmt->bindParam(':endTimeInSeconds', $endTimeInSeconds);
        
       
         // Execute query
      $stmt->execute();
     
        return  $stmt;
    }
     public function fillPrimaryListing($id,$tokenId,$ownerWallet,$txHash)
    {
        
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET tokenId =:tokenId,owner_id =:owner_id,txHash =:txHash,sell=0,nft_price=0,type="secondary"
                                WHERE
                                id=:id
                  ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
         $id = htmlspecialchars(strip_tags($id));
        $tokenId = htmlspecialchars(strip_tags($tokenId));
        $ownerWallet = htmlspecialchars(strip_tags($ownerWallet));
        $txHash = htmlspecialchars(strip_tags($txHash));
        
        
      
       

        // Bind data
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':tokenId', $tokenId);
        $stmt->bindParam(':owner_id', $ownerWallet);

        $stmt->bindParam(':txHash', $txHash);
        
       
         // Execute query
      $stmt->execute();
     
        return  $stmt;
    }
    public function fillsecondaryListing($tokenId,$ownerWallet)
    {
        
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET owner_id =:owner_id,nft_price=0
                                WHERE
                                tokenId=:tokenId
                  ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Clean data
         
        $tokenId = htmlspecialchars(strip_tags($tokenId));
        $ownerWallet = htmlspecialchars(strip_tags($ownerWallet));
      

        // Bind data
        
        $stmt->bindParam(':tokenId', $tokenId);
        $stmt->bindParam(':owner_id', $ownerWallet);

      
        
       
         // Execute query
      $stmt->execute();
     
        return  $stmt;
    }
    
    function get_sequence_nfts($sequence) {
    
  $query = 'SELECT *
                                    FROM ' . $this->table . ' 
                                    WHERE sequence >=' . $sequence . '';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

  

        // Execute query
        $stmt->execute();
        return $stmt;
}

 public function update_sequence($id,$sequence)
    {
       
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET sequence =:sequence
                                WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $id = htmlspecialchars(strip_tags($id));
        $sequence = htmlspecialchars(strip_tags($sequence));
   

        // Bind data
        $stmt->bindParam(':sequence', $sequence);
         $stmt->bindParam(':id', $id);
        

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
         public function onList($id,$price)
    {
        
        // Create query
        $query = 'INSERT INTO listing
                                SET nft_id =:nft_id ,price=:price, action= "fixPrice",type = "primary"
                                
                  ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
         $id = htmlspecialchars(strip_tags($id));
        $price = htmlspecialchars(strip_tags($price));

        // Bind data
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':nft_id', $id);
        
        
       
         // Execute query
      $stmt->execute();
     
        return  $stmt;
    }
         public function onSale($tokenid)
    {
        
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET sell = 1
                                WHERE
                                tokenId=:tokenId
                  ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
         $tokenid = htmlspecialchars(strip_tags($tokenid));
        // $price = htmlspecialchars(strip_tags($price));

        // Bind data
        // $stmt->bindParam(':price', $price);
        $stmt->bindParam(':tokenId', $tokenid);
        
        
       
         // Execute query
      $stmt->execute();
     
        return  $stmt;
    }
            
            public function offSale($id)
    {
        
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET sell = 0
                                WHERE
                                id=:id
                  ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
         $id = htmlspecialchars(strip_tags($id));
        // $price = htmlspecialchars(strip_tags($price));

        // Bind data
        // $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id', $id);
        
        
       
         // Execute query
      $stmt->execute();
     
        return  $stmt;
    }
           public function offSecondarySale($tokenId)
    {
        
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET sell = 0
                                WHERE
                                tokenId=:tokenId
                  ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
         $tokenId = htmlspecialchars(strip_tags($tokenId));
        // $price = htmlspecialchars(strip_tags($price));

        // Bind data
        // $stmt->bindParam(':price', $price);
        $stmt->bindParam(':tokenId', $tokenId);
        
        
       
         // Execute query
      $stmt->execute();
     
        return  $stmt;
    }
            public function offListing($nft_id)
    {
        
        // Create query
        $query = 'UPDATE listing
                                SET status = 0
                                WHERE
                                nft_id=:nft_id
                  ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
         $nft_id = htmlspecialchars(strip_tags($nft_id));
        // $price = htmlspecialchars(strip_tags($price));

        // Bind data
        // $stmt->bindParam(':price', $price);
        $stmt->bindParam(':nft_id', $nft_id);
        
        
       
         // Execute query
      $stmt->execute();
     
        return  $stmt;
    }
        public function offSecondaryListing($tokenId)
    {
        
        // Create query
        $query = 'UPDATE listing
                                SET status = 0
                                WHERE
                                token_id=:tokenId
                  ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
         $tokenId = htmlspecialchars(strip_tags($tokenId));
        // $price = htmlspecialchars(strip_tags($price));

        // Bind data
        // $stmt->bindParam(':price', $price);
        $stmt->bindParam(':tokenId', $tokenId);
        
        
       
         // Execute query
      $stmt->execute();
     
        return  $stmt;
    }
        public function getOwner($tokenId)
    {
       
        // Create query
        $query = 'SELECT owner_id FROM ' . $this->table . ' 
        WHERE tokenId=:tokenId
        ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
           // Clean data
         $tokenId = htmlspecialchars(strip_tags($tokenId));
        // $price = htmlspecialchars(strip_tags($price));

        // Bind data
        // $stmt->bindParam(':price', $price);
        $stmt->bindParam(':tokenId', $tokenId);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
       public function auction_arts()
    {  
        // Create query
        $query = 'SELECT a.id as nftid,a.nft_name,a.metaData, a.nft_catagory, c.nft_category_id,c.category_name ,a.start_time,a.end_time,a.image,u.img,a.gif,a.creator_id,a.countViews, a.description,a.type,a.tokenId,u.userName,u.firstName,u.lastName,u.wallet_address,a.creatorName,a.sell,a.nft_price,u.id,l.nftId,l.creatorId,l.likesId,a.description,li.status as listingstatus,li.nft_id,li.saleid,li.action as listingType,ow.userName as owner_username,ow.wallet_address as owner_wallet,ow.img as ownerImg,li.price as saleprice, li.highestBid,li.endTimeInSeconds
                                FROM nfts a
                                JOIN
                                creators u
                                ON
                                (a.creator_id=u.wallet_address)
                                JOIN
                                creators ow
                                ON
                                (a.owner_id=ow.wallet_address)
                               JOIN
                              categories c 
                              ON
                              (a.nft_catagory_id=c.nft_category_id)
                             LEFT JOIN
                             listing li
                             ON
                             (li.nft_id=a.id  AND li.status=1)
                              LEFT JOIN
                              likes l
                              ON
                               (a.id=l.nftId)
                              WHERE
                             li.action="auction"
                            
                             
                              GROUP BY a.id
                              ORDER BY
                              li.listing_id
                              DESC
                             ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
   
        return $stmt;
        
    }
        public function settleStatuslisting($saleid)
    {
        
        // Create query
        $query = 'UPDATE listing
                                SET status = 0
                                WHERE
                                saleid=:saleid
                  ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        
        // $sell = htmlspecialchars(strip_tags($sell));
        $saleid = htmlspecialchars(strip_tags($saleid));
        //  $id = htmlspecialchars(strip_tags($id));
        
      
       

        // Bind data
        // $stmt->bindParam(':$sell', $sell);
        $stmt->bindParam(':saleid', $saleid);

        // $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
      
      public function update_owner($owner_id,$tokenId)
    {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET owner_id = :owner_id
                                WHERE tokenId = :tokenId';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $tokenId = htmlspecialchars(strip_tags($tokenId));
        $owner_id= htmlspecialchars(strip_tags($owner_id));
        

        // Bind data
        $stmt->bindParam(':owner_id', $owner_id);
        $stmt->bindParam(':tokenId', $tokenId);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
       public function nftDetails($tokenId)
    {
        
        // Create query
        $query = 'SELECT *
        FROM ' . $this->table . ' 
                     WHERE tokenId=:tokenId   
                             ';


       
        // Prepare statement
        $stmt = $this->conn->prepare($query);

    // Clean data
        
         $tokenId = htmlspecialchars(strip_tags($tokenId));
        
      
       

        // Bind data

        $stmt->bindParam(':tokenId', $tokenId);

        // Execute query
        $stmt->execute();
 
            return $stmt;

  
    } 
    public function checkA($nft_id){
    $query = "SELECT nft_id
FROM features
WHERE  nft_id =:nft_id";
    
    // Prepare statement
        $stmt = $this->conn->prepare($query);
 $nft_id = htmlspecialchars(strip_tags($nft_id));
    //bind
    $stmt->bindParam(':nft_id', $nft_id);
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
}
