<?php
class Sessions
{
    // DB stuff
    private $conn;
    private $table = 'sessions';

    // Post Properties
    public $id;
    public $tocken;
    public $user_id;
    public $status;
    public $created_at;
    public $end_at;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Posts
    public function check_session($tocken)
    {
        $this->tocken = $tocken;
       
        // Create query
        $query = 'SELECT *
                                FROM ' . $this->table . '
                                WHERE
                                tocken="' . $this->tocken . '"
                                AND
                                status=1
                                ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

      return $stmt;
     
    }
     

    // Get Single Post
    public function read_single()
    {
        // Create query
        $query = 'SELECT c.name as category_name, p.id, p.nft_category_id, p.title, p.body, p.author, p.created_at
                                    FROM ' . $this->table . ' p
                                    LEFT JOIN
                                      categories c ON p.nft_category_id = c.id
                                    WHERE
                                      p.id = ?
                                    LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
    }

    // Create Post
    public function insert_session($tocken,$email)
    {
        $this->tocken = $tocken;
        $this->email = $email;
       
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET tocken = :tocken, email = :email 
                ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->tocken = htmlspecialchars(strip_tags($this->tocken));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // Bind data
        $stmt->bindParam(':tocken', $this->tocken);
        $stmt->bindParam(':email', $this->email);
     
        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Update Post
    public function logout_session($id=0)
    {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET status =0,end_at=CURRENT_TIMESTAMP()
                                WHERE session_id='.$id.' ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

       

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
