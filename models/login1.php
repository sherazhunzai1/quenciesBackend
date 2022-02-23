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

  


    
}
