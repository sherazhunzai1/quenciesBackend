<?php
class Login
{
    // DB stuff
    private $conn;
    private $table = 'creators';

    // Post Properties
    public $id;
    public $username;
    public $wallet_address;
    public $firstname;
    public $lastname;
    public $password;
    public $email;
    public $dob;
    public $gender;


    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }



//login email
public function login($email,$password)
    {
        // Create query
        $query = 'SELECT *
                                FROM ' . $this->table . '
                                WHERE
                                email="' . $email . '"
                                AND
                                 password="' . $password . '"
                                ';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
      return $stmt;
    }
    
// Get Posts
    public function check_login($address)
    {
       
       
        // Create query
        $query = 'SELECT *
                                FROM ' . $this->table . '
                                WHERE
                                wallet_address="' . $address . '"
                                ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

      return $stmt;
     
    }
       public function checkuserName($userName)
    {
       
       
        // Create query
        $query = 'SELECT *
                                FROM ' . $this->table . '
                                WHERE
                                userName="' . $userName . '"
                                ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

      return $stmt;
     
    }
       public function checkEmail($email)
    {
       
       
        // Create query
        $query = 'SELECT *
                                FROM ' . $this->table . '
                                WHERE
                                email="' . $email . '"
                                ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

      return $stmt;
     
    }
    
   
     public function get_user($id)
    {
        $this->username = $address;
       
        // Create query
        $query = 'SELECT *
                                FROM ' . $this->table . '
                                WHERE
                                id="' . $id . '"
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
        $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                                    FROM ' . $this->table . ' p
                                    LEFT JOIN
                                      categories c ON p.category_id = c.id
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
   public function signup($userName,$password,$email,$firstName,$lastName,$wallet_address)
    {   
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET 	userName = :userName, 	
        password = :password, email = :email, firstName = :firstName,
        lastName = :lastName, wallet_address=:wallet_address' ;

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        $this->userName = $userName;
        $this->password = $password;
        $this->email = $email;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->wallet_address = $wallet_address;
        
     
     
        
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
        $query = 'INSERT INTO ' . $this->table . ' SET 	userName = :userName, 	
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
    public function signupWithWallet($address)
    {
        
       
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET userName =:wallet_address , password ="", email = "", wallet_address = :wallet_address, firstName = "new", lastName = "user"';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Clean data
        
        $address = htmlspecialchars(strip_tags($address));
        // Bind data
      
          $stmt->bindParam(':wallet_address', $address);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
