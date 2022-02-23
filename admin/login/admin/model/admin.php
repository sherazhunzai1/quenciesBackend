<?php
class Admin
{
    // DB stuff
    private $conn;
    private $table = 'admin';

    // Post Properties
    public $id;
    public $username;
    public $password;
  


    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Posts
    public function login($username,$password)
    {
        
       
        // Create query
        $query = 'SELECT *
                                FROM ' . $this->table . '
                                WHERE
                                username="' . $username . '"
                                AND
                                 password="' . $password . '"
                                
                                ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

      return $stmt;
     
    }
}