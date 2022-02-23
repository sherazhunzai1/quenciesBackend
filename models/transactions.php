<?php
 class Transactions 
 {
     // DB stuff
    private $conn;
    private $table = 'transactions';
    
    // Post Properties
    public $id;
    public $customer_name;
    public $customer_email;
    public $item_name;
    public $item_number;
    public $item_price;
    public $item_price_currency;
    public $paid_amount;
    public $paid_amount_currency;
    public $txn_id;
    public $payment_status;
    public $created;
    public $modified;
    public $rcaId;
    public $title;
      // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
     public function insert_transction_info($customer_name,$customer_email,$item_name,$item_number,$item_price,$item_price_currency,$paid_amount,$paid_amount_currency,$txn_id,$payment_status,$created,$modified)
    {
        
        
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET  customer_name = :customer_name, customer_email = :customer_email,item_name = :item_name,item_number =:item_number ,item_price =:item_price ,item_price_currency=:item_price_currency,paid_amount=:paid_amount, paid_amount_currency=:paid_amount_currency,txn_id=:txn_id, payment_status=:payment_status,created=:created,modified=:modified';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $customer_name= htmlspecialchars(strip_tags($customer_name));
        $customer_email= htmlspecialchars(strip_tags($customer_email));
        $item_name= htmlspecialchars(strip_tags($item_name));
        $item_number= htmlspecialchars(strip_tags($item_number));
        $item_price= htmlspecialchars(strip_tags($item_price));
        $item_price_currency= htmlspecialchars(strip_tags($item_price_currency));
        $paid_amount= htmlspecialchars(strip_tags($paid_amount));
        $paid_amount_currency= htmlspecialchars(strip_tags($paid_amount_currency));
        $txn_id= htmlspecialchars(strip_tags($txn_id));
        $payment_status= htmlspecialchars(strip_tags($payment_status));
        $created= htmlspecialchars(strip_tags($created));
        $modified= htmlspecialchars(strip_tags($modified));
       // $customer_country= htmlspecialchars(strip_tags($customer_country));
       
      


        // Bind data
        $stmt->bindParam(':customer_name', $customer_name);
        $stmt->bindParam(':customer_email', $customer_email);
        $stmt->bindParam(':item_name', $item_name);
        $stmt->bindParam(':item_number', $item_number);
        $stmt->bindParam(':item_price', $item_price);
        $stmt->bindParam(':item_price_currency', $item_price_currency);
        $stmt->bindParam(':paid_amount', $paid_amount);
        $stmt->bindParam(':paid_amount_currency', $paid_amount_currency);
        $stmt->bindParam(':txn_id', $txn_id);
        $stmt->bindParam(':payment_status', $payment_status);
        $stmt->bindParam(':created', $created);
        $stmt->bindParam(':modified', $modified);
        //$stmt->bindParam(':customer_country', $customer_country);
        
  

        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    
    //transcation details 
    public function transcation_details($id){
        
        $query = 'SELECT  id, customer_name, customer_email,item_name,item_number  ,item_price ,item_price_currency,paid_amount, paid_amount_currency,txn_id, payment_status,created,modified, item_number*item_price  AS total_amount
                           
                           FROM transactions 
        
                          WHERE
                             (id="'.$id.'")
                            GROUP BY id
                              ORDER BY
                              id
                              asc';
        
          // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
    
    public function getall_transctions_info(){
        
        $query = 'SELECT  id, customer_name, customer_email,item_name,item_number  ,item_price ,item_price_currency,paid_amount, paid_amount_currency,txn_id, payment_status,created,modified, item_number*item_price  AS total_amount
                           
                           FROM transactions 
        
                         
                            GROUP BY id
                              ORDER BY
                              id
                              asc';
        
          // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
        
    }
    public function get_payment_info(){
        
        $query = 'SELECT  t.id, t.customer_name, t.customer_email,t.item_name,t.item_number ,t.item_price ,t.item_price_currency,t.paid_amount, t.paid_amount_currency,t.txn_id, t.payment_status,t.created,t.modified, t.item_number*item_price  AS total_amount, r.rcaId,r.title
                           
                           FROM transactions t
                             JOIN
                                rcas r
                                ON
                                (t.id=r.rcaId)
                            GROUP BY id
                              ORDER BY
                              id
                              asc';
        
          // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
        
    }
    
     public function confirmation_info($txn_id){
        
        $query = 'SELECT  id, customer_name, customer_email,item_name,item_number  ,item_price ,item_price_currency,paid_amount, paid_amount_currency,txn_id, payment_status,created,modified, item_number*item_price  AS total_amount
                           
                           FROM transactions 
                           where
                           (txn_id="'.$txn_id.'")
                         
                            GROUP BY id
                              ORDER BY
                              id
                              asc';
        
          // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
        
    }
     public function count_info(){
        
        $query = 'SELECT  id, customer_name, customer_email,item_name,item_number  ,item_price ,item_price_currency,paid_amount, paid_amount_currency,txn_id, payment_status,created,modified, item_number*item_price  AS total_amount
                           
                           FROM transactions 
        
                         
                            GROUP BY id
                              ORDER BY
                              id
                              asc';
        
          // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
        
    }
 }
 
 
 
?>