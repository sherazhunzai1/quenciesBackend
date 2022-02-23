<?php
 include_once '../config/constants.php';
 include("header.php");
 include("sidebar.php");
?>

         <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h4 class="font-weight-bold mb-0">Quencies Admin Dashboard</h4>
                  </div>
                  <div>
                    <button
                      type="button"
                      class="btn btn-primary btn-icon-text btn-rounded"
                    >
                      <i class="ti-clipboard btn-icon-prepend"></i>Report
                    </button>
                  </div>
                </div>
              </div>
            </div>

              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Orders Details</h4>


                    <div class="table-responsive pt-3">
                      <table class="table table-dark">
                        <link href="css/invoice.css" rel="stylesheet" />

<div class="row page-content container">
    <div class="col page-header text-blue-d2">
        <!--<h1 class="page-title text-secondary-d1">-->
        <!--    Order-->
        <!--    <small class="page-info">-->
        <!--        <i class=""></i>-->
        <!--        ID: #111-222-->
        <!--    </small>-->
            
            
        <!--</h1>-->
        <div class= "row">
            <div class= "col text-secondary-d1 text-150">
                Order Details and Reciept 
            </div>
        </div>

        <div class="row page-tools">
            <div class="col action-buttons">
                <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print" onClick="window.print()">
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2" ></i>
                   <input type="button" value="Print" onClick="window.print()"> 
                </a>
                <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="PDF">
                    <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                    Export
                </a>
            </div>
        </div>
    </div>
     
     <!--order Invoice-->
     
      <div class="container px-0">
                         
        <div class="row mt-4">
            <div class="col-12 col-lg-10 offset-lg-1">
                
                <!-- .row -->
                <div class="text-center">
                    <span >Congratulations you place you're Order </span>
                </div>

                <hr class="row brc-default-l1 mx-n1 mb-4" />

                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <span class=" text-sm text-grey-m2 align-middle"><h3>Customer Data</h3></span>
                        </div>
                        <br>
                        <div>
                           <?php
                         $url = base_url."api/orders/readSingleOrder.php?order_id=".$_GET['order_id'];
                        
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
$json = curl_exec($ch);

if(!$json) {
    echo curl_error($ch);
}
curl_close($ch);
$data=json_decode($json);   
$num=0;
$i = 0;
                          foreach($data as $row ){                
                                    $num++;  
                          ?>
                         
                    <span class="text-600 text-110 text-blue align-middle">Customer_Name:<?php echo $row->customer_name;?></span>
                        </div>
                        <div class="text-600 text-110 text-blue align-middle">
                            <div class="my-1">
                            Customer_address: <?php echo $row->customer_address;?>
                            </div>
                            <div class="my-1">
                               phoneNo: <?php echo $row->phoneNo;?>
                            </div>
                            <div class="my-1">
                                customer_city: <?php echo $row->customer_city;?>
                            </div>
                            <div class="my-1">
                              customer_pin : <?php echo $row->customer_pin;?>
                            </div>
                            <div class="my-1">
                            customer_state: <?php echo $row->customer_state;?>
                            </div>
                        <div class="my-1">
                             zip: <?php echo $row->zip;?>
                            </div>
                        <div class="my-1">
                                customer_country	: <?php echo $row->customer_country;?>
                            </div>
                            <div class="my-1">
                                created_at: <?php echo $row->created_at;?>
                            </div>
                            
                        <br><br>
                    </div>

     <?php
                         
                           }
                          ?>
<br><br>
<br><br>


                    <!-- or use a table instead -->
            <div class="table-responsive">
                <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                    <thead class="text-light bg-dark bg-none">
                        <tr class="text-white">
                            <th>No.</th>
                             <th>Transaction_ID</th>
                             <th>Product_Name</th>
                             <th>Product_Quantity</th>
                             <th>Product_price</th>
                           
                            
                            
                         
                        </thead>
                        </tr>
                    </thead>

                    <tbody class="text-95 text-secondary-d3">
                       <?php
                       $id=$_GET['id'];
                         $url = base_url."api/transactions/transactions_info.php?id=$id";
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
$json = curl_exec($ch);

if(!$json) {
    echo curl_error($ch);
}
curl_close($ch);
$data=json_decode($json);   
$num=0;
$i = 0;
                           foreach($data->getOrderDetails as $row ){                
                                    $num++;  
                          ?>
                         
                          <tr>
                             <td><?php echo $num;?></td>
                             <td><?php echo $row->txn_id;?></td>
                             <td><?php echo $row->item_name;?></td>
                             <td><?php echo $row->item_number;?></td>
                             <td><?php echo $row->item_price;?></td>
                          </tr>
                          <?php
                       
                           }
                          ?> 
                    </tbody>
                </table>
            </div>
            


                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    Total Amount $: 
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3 opacity-2"> <?php echo $row->item_number*$row->item_price  ?> </span>
                                </div>
                                   <span class="text-secondary-d1 text-105">Thank you for your business</span>
                            </div>
                            <div class="d-flex justify-content-end "><h3 style="text-align:right" class="text-secondary-d1 text-105  float:right">Quencies Admin</h3></div>
                             
                        </div>
                    </div>

                    <hr />

                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                        
                      </table>
                    </div>
                  </div>
                </div>
              </div>

          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <!-- <footer class="footer"></footer> -->
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    
    <?php include("footer.php");?>
  </body>
</html>
