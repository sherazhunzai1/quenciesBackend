<?php
class Followers
{
    // DB stuff
    private $conn;
    private $table = 'followers';

    // Post Properties
    public $followingId;
    public $followerId;
    public $followedUserid;
    public $status;
    
    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    //check user already follow or not
      //checkUserliked or not
    public function isUserAlreadyFollowing($followedUserid)
    
{ 
    
     $query = 'SELECT followingId,followedUserid from ' . $this->table . ' WHERE  followedUserid='.$followedUserid.' ';
     
      // Prepare statement
        $stmt = $this->conn->prepare($query);
         
         //excute the stmt
            $stmt->execute();
            
            //row count of followers
           $num=$stmt->rowCount();

             // Execute query
        if ($num > 0) {
            return true;
        }
    else{
         return false; 
    }
       

}
 // follow the user
public function follow($followedUserid)
{   // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET 
       followedUserid = :followedUserid ';
    
        $stmt = $this->conn->prepare($query);

        // Clean data
       // $followerId= htmlspecialchars(strip_tags($followerId));
         $followedUserid= htmlspecialchars(strip_tags($followedUserid));
 
        // Bind data
       // $stmt->bindParam(':followerId', $followerId);
        $stmt->bindParam(':followedUserid', $followedUserid);


        // Execute query
        if ($stmt->execute()) {
            return true;
            
        }
    
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    
    //unfollow the user
     public function unfollow($followedUserid)
{ 
 // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE  followedUserid ='.$followedUserid.' ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
      //  $this->followerId = htmlspecialchars(strip_tags($this->followerId));
        $this->followedUserid = htmlspecialchars(strip_tags($this->followedUserid));

        // Bind data
    //    $stmt->bindParam(':followerId', $this->followerId);
        $stmt->bindParam(':followedUserid', $this->followedUserid);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    
    //count totalfollowers
    //count likes on nft
    public function getTotalfollowers()
{   
    
     $query = 'SELECT followingId,followedUserid
                               FROM  followers 
                                GROUP BY followingId
                               ORDER BY
                              followingId
                               DESC ';
 
 // Prepare statement
        $stmt = $this->conn->prepare($query);


        // Execute query
        $stmt->execute();

      return $stmt;

}

    
}