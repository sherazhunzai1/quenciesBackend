<?php
class Orders
{

// DB stuff
    private $conn;
    private $table = 'order';
    
    // Post Properties
    public $order_id;
    public $order_number;
    public $order_total_amount;
    public $transaction_id;
    public $card_cvc;
    public $card_expiry_month;
    public $card_expiry_year;
    public $order_status;
    public $card_holder_number;
    public $email_address;
    public $customer_name;
    public $customer_address;
    public $customer_city;
    public $customer_pin;
    public $customer_state;
    public $customer_country;
    public $order_itemId;
    public $order_item_rca_id;
    public $order_itemQuantity;
    public $order_price;
    public $total_amount;
     
    
    
      // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    

  public function placeOrder($customer_name,$phoneNo,$customer_city,$customer_state,$customer_address, $zip,$rca_id)
    {
        
        
        // Create query
        $query = 'INSERT INTO `order`  SET  customer_name = :customer_name, phoneNo = :phoneNo,customer_city = :customer_city,customer_state =:customer_state ,customer_address =:customer_address ,zip=:zip,rca_id=:rca_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $customer_name= htmlspecialchars(strip_tags($customer_name));
        $phoneNo= htmlspecialchars(strip_tags($phoneNo));
        $customer_city= htmlspecialchars(strip_tags($customer_city));
        $customer_state= htmlspecialchars(strip_tags($customer_state));
        $customer_address= htmlspecialchars(strip_tags($customer_address));
        $zip= htmlspecialchars(strip_tags($zip));
        $rca_id= htmlspecialchars(strip_tags($rca_id));
      
      
       
      


        // Bind data
        $stmt->bindParam(':customer_name', $customer_name);
        $stmt->bindParam(':phoneNo', $phoneNo);
        $stmt->bindParam(':customer_city', $customer_city);
        $stmt->bindParam(':customer_state', $customer_state);
        $stmt->bindParam(':customer_address', $customer_address);
        $stmt->bindParam(':zip', $zip);
        $stmt->bindParam(':rca_id', $rca_id);
        
  

        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
       public function getsingleDetail($order_id)
    {   
       
       
        $query = 'SELECT * FROM `order` o , `rcas` r 
                     WHERE
                     rca_id = rcaId
                     AND
                     order_id=:order_id
                        
                             ';
                              
              
         // Prepare statement
        $stmt = $this->conn->prepare($query);
        
            $order_id= htmlspecialchars(strip_tags($order_id));
      
        // Bind data
        $stmt->bindParam(':order_id', $order_id);
        // Execute query
        $stmt->execute();
                  
        return $stmt;
         
    }  
    //get all orders
     public function getAllOrder($start,$end)
    {   
       
        //single RCA's 
        $query = 'SELECT * FROM `order` o , `rcas` r 
                     WHERE
                     rca_id = rcaId
                     AND
                     order_id=order_id
                             
                              group by order_id
                                  order 
                                  by
                                order_id
                             ASC 
                             LIMIT ' . $start . ' , ' . $end . '
                             ';
                              
              
         // Prepare statement
        $stmt = $this->conn->prepare($query);
         
        // Execute query
        $stmt->execute();
                  
        return $stmt;
         
    }
    
    //get all orders
     public function total_getAllOrder()
    {   
       
        //single RCA's 
        $query = 'SELECT * FROM `order` o , `rcas` r 
                     WHERE
                     rca_id = rcaId
                     AND
                     order_id=order_id
                             
                              group by order_id
                                  order 
                                  by
                                order_id
                             ASC 
                             
                             ';
                              
              
         // Prepare statement
        $stmt = $this->conn->prepare($query);
         
        // Execute query
        $stmt->execute();
                  
        return $stmt;
         
    }
     public function updateOrderDeatils($customer_name,$phoneNo,$customer_city,$customer_state,$customer_address, $order_id)
    {
        
        
        // Create query
        $query = 'UPDATE `order`  SET  customer_name = :customer_name, phoneNo = :phoneNo,customer_city = :customer_city,customer_state =:customer_state ,customer_address =:customer_address
                        WHERE
                        order_id=:order_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $customer_name= htmlspecialchars(strip_tags($customer_name));
        $phoneNo= htmlspecialchars(strip_tags($phoneNo));
        $customer_city= htmlspecialchars(strip_tags($customer_city));
        $customer_state= htmlspecialchars(strip_tags($customer_state));
        $customer_address= htmlspecialchars(strip_tags($customer_address));
        $order_id= htmlspecialchars(strip_tags($order_id));
        // $rca_id= htmlspecialchars(strip_tags($rca_id));
      
      
       
      


        // Bind data
        $stmt->bindParam(':customer_name', $customer_name);
        $stmt->bindParam(':phoneNo', $phoneNo);
        $stmt->bindParam(':customer_city', $customer_city);
        $stmt->bindParam(':customer_state', $customer_state);
        $stmt->bindParam(':customer_address', $customer_address);
        $stmt->bindParam(':order_id', $order_id);
        // $stmt->bindParam(':rca_id', $rca_id);
        
  

        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    // Delete Post
    public function delete($order_id)
    {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE order_id = '.$order_id.'   ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->order_id = htmlspecialchars(strip_tags($this->order_id));

        // Bind data
        $stmt->bindParam(':order_id', $this->order_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
