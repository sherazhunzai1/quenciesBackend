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
    
    //insert into table 
     
    public function insert_order($order_number,$order_total_amount,$transaction_id,$card_cvc,$card_expiry_month,$card_holder_number,$email_address,$customer_name,$customer_address,$customer_city,$customer_pin,$customer_state,$customer_country)
    {
        
        
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET  order_number = :order_number, order_total_amount = :order_total_amount,transaction_id = :transaction_id,card_cvc =:card_cvc ,card_expiry_month =:card_expiry_month ,card_holder_number=:card_holder_number,email_address=:email_address, customer_name=:customer_name, customer_address=:customer_address, customer_city=:customer_city,customer_pin=:customer_pin,customer_state=:customer_state,customer_country=:customer_country';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $order_number= htmlspecialchars(strip_tags($order_number));
        $order_total_amount= htmlspecialchars(strip_tags($order_total_amount));
        $transaction_id= htmlspecialchars(strip_tags($transaction_id));
        $card_cvc= htmlspecialchars(strip_tags($card_cvc));
        $card_expiry_month= htmlspecialchars(strip_tags($card_expiry_month));
        $card_holder_number= htmlspecialchars(strip_tags($card_holder_number));
        $email_address= htmlspecialchars(strip_tags($email_address));
        $customer_name= htmlspecialchars(strip_tags($customer_name));
        $customer_address= htmlspecialchars(strip_tags($customer_address));
        $customer_city= htmlspecialchars(strip_tags($customer_city));
        $customer_pin= htmlspecialchars(strip_tags($customer_pin));
        $customer_state= htmlspecialchars(strip_tags($customer_state));
        $customer_country= htmlspecialchars(strip_tags($customer_country));
       
      


        // Bind data
        $stmt->bindParam(':order_number', $order_number);
        $stmt->bindParam(':order_total_amount', $order_total_amount);
        $stmt->bindParam(':transaction_id', $transaction_id);
        $stmt->bindParam(':card_cvc', $card_cvc);
        $stmt->bindParam(':card_expiry_month', $card_expiry_month);
        $stmt->bindParam(':card_holder_number', $card_holder_number);
        $stmt->bindParam(':email_address', $email_address);
        $stmt->bindParam(':customer_name', $customer_name);
        $stmt->bindParam(':customer_address', $customer_address);
        $stmt->bindParam(':customer_city', $customer_city);
        $stmt->bindParam(':customer_pin', $customer_pin);
        $stmt->bindParam(':customer_state', $customer_state);
        $stmt->bindParam(':customer_country', $customer_country);
        
  

        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    
    //count total number of orders
    public function getordercount()
    {   
        
        //single RCA's 
        $query = 'SELECT  order_id,order_number, order_total_amount,transaction_id,card_cvc ,card_expiry_month ,card_holder_number,email_address, customer_name, customer_address, customer_city,customer_pin,customer_state,customer_country
                             from order
                              
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
    
    //get a single order
     public function getOrder($id)
    {   
       
       
        $query = 'SELECT  order_id,order_number, order_total_amount,transaction_id,card_cvc ,card_expiry_month,card_holder_number,email_address, customer_name, customer_address, customer_city,customer_pin,customer_state,customer_country
                             from order
                                where
                               ( order_id="'.$id.'" )
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
    
     //get all orders
     public function getAllOrder()
    {   
       
        //single RCA's 
        $query = 'SELECT  order_id,order_number, order_total_amount,transaction_id,card_cvc ,card_expiry_month,card_holder_number,email_address, customer_name, customer_address, customer_city,customer_pin,customer_state,customer_country,created_at
                             from order
                             
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
    //order details 
    public function orderDetails($order_id)
    {
    
        // Create query
        $query = 'SELECT  o.order_id,o.order_number, o.order_total_amount,o.transaction_id,o.card_cvc ,o.card_expiry_month,o.card_holder_number,o.email_address, o.customer_name, o.customer_address, o.customer_city,o.customer_pin,o.customer_state,o.customer_country,o.created_at,r.order_itemId,r.order_id AS orderID, r.order_item_rca_id,	r.order_itemQuantity,r.order_price , r.order_itemQuantity*order_price  AS total_amount ,o.created_at,a.rcaId, a.title
                                FROM order o
                                JOIN
                                orders_items r
                                ON
                                (o.order_id=r.order_id)
                                JOIN
                                rcas a
                                ON
                                (r.order_item_rca_id=a.rcaId)
                             WHERE
                             (o.order_id="'.$order_id.'"
                             AND
                             r.order_id="'.$order_id.'")
                              GROUP BY o.order_id
                              ORDER BY
                              o.order_id
                              asc'
                              ;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
        
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
  public function placeOrder($customer_name,$phoneNo,$customer_city,$customer_state,$customer_address, $zip,$rca_id)
    {
        
        
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET  customer_name = :customer_name, phoneNo = :phoneNo,customer_city = :customer_city,customer_state =:customer_state ,customer_address =:customer_address ,zip=:zip,rca_id=:rca_id';

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
       
       
        $query = 'SELECT* FROM  ' . $this->table . '
                        WHERE
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
    
}
