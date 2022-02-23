<?php
class PlaceOrder
{

// DB stuff
    private $conn;
    private $table = 'orders_items';
    
    // Post Properties
    public $order_itemId;
    public $order_id;
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
     
    public function place_order($order_id,$order_item_rca_id,$order_itemQuantity,$order_price)  {
         
       
        
        
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET  order_id = '.$order_id.', order_item_rca_id = '.$order_item_rca_id.',order_itemQuantity = '.$order_itemQuantity.',order_price ='.$order_price.' ';

        // Prepare statement
        
        $stmt = $this->conn->prepare($query);
      
       

       
        $order_id= htmlspecialchars(strip_tags($order_id));
        $order_item_rca_id= htmlspecialchars(strip_tags($order_item_rca_id));
        $order_itemQuantity= htmlspecialchars(strip_tags($order_itemQuantity));
        $order_price= htmlspecialchars(strip_tags($order_price));

        // Bind data
        $stmt->bindParam(':order_id', $order_id);
        $stmt->bindParam(':order_item_rca_id', $order_item_rca_id);
        $stmt->bindParam(':order_itemQuantity', $order_itemQuantity);
        $stmt->bindParam(':order_price', $order_price);
 
    //execute stmt
        if ($stmt->execute()) {
            return true ;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
        
    }
    
    //total amount
      public function totalAmount($order_itemId)
    {  
      
        // Create query
     $query = 'UPDATE orders_items SET total_amount = order_itemQuantity * order_price WHERE order_itemId = '.$order_itemId. ' ';
     
        
     // Prepare statement
        $stmt = $this->conn->prepare($query);
  
  $order_itemId= htmlspecialchars(strip_tags($order_itemId));
  
   // Bind data
        $stmt->bindParam(':order_itemId', $order_itemId);
        
    //execute stmt
        if ($stmt->execute()) {
            return true ;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    
    //nftsVIews Counts
    public function total($order_itemId)
    {  
    
      $query = 'SELECT order_itemId, total_amount  FROM orders_items where order_itemId='.$order_itemId.'  ';

               $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
     
        return  $stmt;

     
    }
    
    //get a single order
     public function numofOrders($id)
    {   
       
        //single RCA's 
        $query = 'SELECT  order_itemId,order_id, order_item_rca_id,	order_itemQuantity,order_price , order_itemQuantity*order_price  AS total_amount
                             from orders_items
                                where
                               ( order_itemId="'.$id.'" )
                              group by order_itemId
                                  order 
                                  by
                                order_itemId
                             ASC 
                             
                             ';
                              
              
         // Prepare statement
        $stmt = $this->conn->prepare($query);
         
        // Execute query
        $stmt->execute();
                  
        return $stmt;
         
    }
public function orderDetails($order_id)
    {
    
        // Create query
        $query = 'SELECT r.order_itemId, r.order_item_rca_id,	r.order_itemQuantity,r.order_price , r.order_itemQuantity*order_price  AS total_amount ,a.rcaId, a.title
                                FROM 
                                orders_items r
                                JOIN
                                rcas a
                                ON
                                (r.order_item_rca_id=a.rcaId)
                             WHERE
                             (r.order_itemId="'.$order_id.'")
                              GROUP BY r.order_itemId
                              ORDER BY
                              r.order_itemId
                              ASC'
                              ;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
        
    }
    
}