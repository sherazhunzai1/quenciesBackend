<?php

header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Headers
    
if(isset($_GET['txn_id'])) {
      $txn_id=$_GET['txn_id'];
      
   include_once '../../config/Database.php';
    include_once '../../models/transactions.php';

 
$database = new Database();
$db = $database->connect();

//class name 
$Transactions = new Transactions($db); 

$results=$Transactions->confirmation_info($txn_id);

 $num = $results->rowCount();
 
 if ($num > 0) {
     // Transaction details 
    
        $row = $results->fetch(PDO::FETCH_ASSOC); 
        
        $data=array('txn_id'=>$row['txn_id'],
                    'paid_amount'=>$row['paid_amount'],
                    'Paid_amount_currency'=>$row['paid_amount_currency'],
        
            );
            
            echo json_encode(
            array('Transactions' => true,
                  'Customer_Name'=>$row['customer_name'],
                  'Customer_Email'=>$row['customer_email'],
                  'txn_id'=>$_GET['txn_id'],
                  'Paid_amount'=>$row['paid_amount'],
                  'Paid_amount_currency'=>$row['paid_amount_currency'],
                  'Payment_status'=>$row['payment_status'],
                  
                    ));
                    
    }else{ 
        echo json_encode ( "Transaction has been failed!"); 
    } 
}
?>


<!--//html for page-->
<?php if($_GET['txn_id']){ ?>
<h4>Payment Information</h4>
<p><b>Reference Number:</b> <?php echo $row->id; ?></p>
<p><b>Transaction ID:</b> <?php echo $row->txn_id; ?></p>
<p><b>Paid Amount:</b> <?php echo $row->paidAmount.' '.$row->paidCurrency; ?></p>
<p><b>Payment Status:</b> <?php echo $row->payment_status; ?></p>

<h4>Customer Information</h4>
<p><b>Name:</b> <?php echo $row->customerName; ?></p>
<p><b>Email:</b> <?php echo $row->customerEmail; ?></p>

<h4>Product Information</h4>
<p><b>Name:</b> <?php echo $row->itemName; ?></p>
<p><b>Price:</b> <?php echo $row->itemPrice.' '.$row->currency; ?></p>
<?php }else{ ?>
<h1>Your Payment been failed!</h1>

<?php } 
