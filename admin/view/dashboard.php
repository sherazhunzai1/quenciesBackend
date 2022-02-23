<?php include("header.php");?>
<?php include("sidebar.php");?>
      
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
            <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <p class="card-title text-md-center text-xl-left">Orders</p>
                    <div
                      class="
                        d-flex
                        flex-wrap
                        justify-content-between
                        justify-content-md-center
                        justify-content-xl-between
                        align-items-center
                      "
                    >
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">
                         <?php
                          //here
        $url = base_url."api/orders/ordersCount.php";
        
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
                         
                         echo $data->total;
                          
                          ?> 
                      </h3>
                      <i class="ti-agenda
                          icon-md
                          text-muted
                          mb-0 mb-md-3 mb-xl-0"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <p class="card-title text-md-center text-xl-left">RCAs</p>
                    <div
                      class="
                        d-flex
                        flex-wrap
                        justify-content-between
                        justify-content-md-center
                        justify-content-xl-between
                        align-items-center
                      "
                    >
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">
                          <?php
                          //here  
        $url = base_url."api/RCAs/totalrcas.php";
        
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
                         
                         echo $data->total;
                          
                          ?>
                      </h3>
                     <i class="ti-layers-alt
                          icon-md
                          text-muted
                          mb-0 mb-md-3 mb-xl-0"></i>
                    </div>
                  </div>
                </div>
              </div>
              <!--nft images card-->
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <p class="card-title text-md-center text-xl-left">NFT Images</p>
                    <div
                      class="
                        d-flex
                        flex-wrap
                        justify-content-between
                        justify-content-md-center
                        justify-content-xl-between
                        align-items-center
                      "
                    >
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">
                          <?php
                          //here  
        $url = base_url."api/homepage/totalnfts.php";
        
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
                         
                         echo $data->total;
                          
                          ?>
                      </h3>
                     <i class="ti-layers-alt
                          icon-md
                          text-muted
                          mb-0 mb-md-3 mb-xl-0"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <p class="card-title text-md-center text-xl-left">Feature Artworks</p>
                    <div
                      class="
                        d-flex
                        flex-wrap
                        justify-content-between
                        justify-content-md-center
                        justify-content-xl-between
                        align-items-center
                      "
                    >
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">
                          <?php
                          //here
        $url = base_url . "api/homepage/totalfeatureArts.php";

        
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
                         
                         echo $data->total;
                          
                          ?>
                      </h3>
                        <i class="ti-layers-alt
                          icon-md
                          text-muted
                          mb-0 mb-md-3 mb-xl-0"></i>
                    </div>
                  </div>
                </div>
              </div>
              
              <!--trending collection card-->
              
              
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <p class="card-title text-md-center text-xl-left">Trending Collections</p>
                    <div
                      class="
                        d-flex
                        flex-wrap
                        justify-content-between
                        justify-content-md-center
                        justify-content-xl-between
                        align-items-center
                      "
                    >
                      <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">
                          <?php
                          //here
        $url = base_url . "api/homepage/totaltrending.php";

        
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
                         
                         echo $data->total;
                          
                          ?>
                      </h3>
                       <i class="ti-layers-alt
                          icon-md
                          text-muted
                          mb-0 mb-md-3 mb-xl-0"></i>
                    </div>
                  </div>
                </div>
              </div>

<!--hotcollection card-->
              
              
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <p class="card-title text-md-center text-xl-left">HOT COLLECTIONS</p>
                    <div
                      class="
                        d-flex
                        flex-wrap
                        justify-content-between
                        justify-content-md-center
                        justify-content-xl-between
                        align-items-center
                      "
                    >
                      <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">
                          <?php
                          //here
        $url = base_url . "api/homepage/totalhotcollections.php";

        
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
                         
                         echo $data->total;
                          
                          ?>
                      </h3>
                        <i class="ti-layers-alt
                          icon-md
                          text-muted
                          mb-0 mb-md-3 mb-xl-0"></i>
                    </div>
                  </div>
                </div>
              </div>

<!--live auction table-->
              
              
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <p class="card-title text-md-center text-xl-left">LIVE AUCTION</p>
                    <div
                      class="
                        d-flex
                        flex-wrap
                        justify-content-between
                        justify-content-md-center
                        justify-content-xl-between
                        align-items-center
                      "
                    >
                      <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">
                          <?php
                          //here
        $url = base_url . "admin/admin/api/liveauction/totalAuctions.php";

        
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
                         
                         echo $data->total;
                          
                          ?>
                      </h3>
                        <i class="ti-layers-alt
                          icon-md
                          text-muted
                          mb-0 mb-md-3 mb-xl-0"></i>
                    </div>
                  </div>
                </div>
              </div>

 <!--RCA's table -->
           
           <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">RCA's </h4>
            <a href ="./RCAs.php"  type="button" class="btn btn-primary mt-2 float-right"
                          >ADD</a>
                    <div class="table-responsive pt-3">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th class="w-25">Description</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Action</th>
                            
                         
                        </thead>
                        <tbody>
                        <?php
                         $url = base_url."api/RCAs/getallRcas.php";
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

                           foreach($data->getallRCAs as $row ){                
                                    $num++;  
                          ?>
                         
                         


                          <tr>
                          <tr>
                             <td><?php echo $row->id;?></td>
                             <td><?php echo $row->art_name;?></td>
                             <td class="w-25"><?php echo $row->art_description;?></td>
                             <td> <img src="<?php echo $row->art_img;?>"  alt="" width="100" height="100"></td>
                             <td><?php echo $row->art_price;?></td>
                              <td>
                                  
                                  <a href="<?php echo base_url; ?>buyrca/<?php echo $row->id; ?>"  type="button" class="btn btn-success"> View</a>
                         
                        
                                   <a href="<?php echo base_url; ?>api/RCAs/deleterca.php?rcaId=<?php echo $row->id;  ?>"  type="button" class="btn btn-danger";>Delete</a>
                              
                            </td>
                             
                            

                            </td>
                          </tr>
                          <?php
                          if (++$i == 5) break; 
                           }
                          ?>
                        </tbody>
                      </table>
                      
                       <div class="text-center">
                      <a href ="./listRca.php"  type="button" class="btn btn-secondary mt-2
                          ">View All</a>
                                </div>
                    </div>
                  </div>
                  </div>
                  </div>
    
    <!--orders details-->
    
     <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">ORDER'S </h4>
         
                    <div class="table-responsive pt-3">
                      <table class="table table-dark">
                        <thead>
                         
                            <th>No.</th>
                            <th>Customer_name</th>
                            <th>Total_items</th>
                            <th>Created_at</th>
                            <th>Actions</th>
                            
                         
                        </thead>
                        <tbody>
                        <?php
                         $url = base_url."api/orders/readAllorders.php";
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
                           foreach($data->getallOrders as $row ){                
                                    $num++;  
                          ?>
                         
                         


                        
                          <tr>
                             <td><?php echo $row->order_id;?></td>
                             <td><?php echo $row->customer_name;?></td>
                             <td><?php echo $row->order_total_amount;?></td>
                              <td><?php echo $row->created_at;?></td>
                              <td>
        
                                  <a href ="./orderInfo.php?order_id=<?php echo $row->order_id; ?>"  type="button" class="btn btn-success">View</a>
                                 <a href="<?php echo base_url; ?>api/orders/deleteOrder.php?order_id=<?php echo $row->order_id;?>"  type="button" class="btn btn-danger";>Delete</a>
                              
                            </td>
                  
                          </tr>
                          <?php
                          if (++$i ==5) break; 
                           }
                          ?>
                        </tbody>
                      </table>
                      
                       <div class="text-center">
                      <a href ="./orders.php"  type="button" class="btn btn-secondary mt-2
                          ">View All</a>
                                </div>
                    </div>
                  </div>
                  </div>
                  </div>
    
    
<!--nft image card-->

              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">NFT Images</h4>

                    <div class="table-responsive pt-3">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Art Price</th>
                            <th>Image</th>
                            <th>Creator Name</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                         $url = base_url . "api/artworks/itemscollection.php";
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
$i = 0;
$num=0;
                           foreach($data->itemsCollection as $row ){                
                                    $num++;  
                          ?>
                         
                         
                         <tr>
                             <td><?php echo $row->id;?></td>
                             <td><?php echo $row->nft_name;?></td>
                             <td class="w-25"><?php echo $row->nft_description;?></td>
                              <td><?php echo $row->art_price;?></td>
                             <td> <img src="<?php echo $row->art_img;?>"  alt="" width="100" height="100"></td>
                            <td><?php echo $row->creator_name;?></td>
                              <td>
                                  
                                  <a href="<?php echo base_url; ?>nft/@<?php echo $row->creator_name?>/<?php echo $row->nft_name;?>-<?php echo $row->id;?>"  type="button" class="btn btn-success"> View</a>
                         
                            </td>
                             
                            

                            </td>
                          </tr>
                          <?php
                          if (++$i == 5) break;
                           }
                          ?>
                        </tbody>
                      </table>
                      <div class="text-center">
                      <a href ="./nftimages.php"  type="button" class="btn btn-secondary mt-2
                          ">View All</a>
                                </div>
                    </div>
                  </div>
                </div>
              </div>
           
          
           
           <!--featured artwork card-->
              
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Featured Art</h4>
                    
                    <a href ="./addFeatureArt.php"  type="button" class="btn btn-primary mt-2 float-right"
                          >ADD</a>
                          
                    <div class="table-responsive pt-3">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                              <th>No.</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Art Price</th>
                            <th>Image</th>
                            <th>Creator Name</th>
                            <th>Sequence</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                         $url = base_url."admin/admin/api/featureart/readAllfeatureArts.php";
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
$i = 0;
$num=0;
                           foreach($data->feature as $row ){                
                                    $num++;  
                          ?>
                         
                <form action="../admin/api/featureart/sequence.php" method="post">  
                                
                          <tr>
                          <!--quencies.alshumaal.com/admin/view/dashboard.php-->
                           <td><?php echo $num;?></td>
                             <td><?php echo $row->art_name;?></td>
                             <td><?php echo $row->description;?></td>
                             <td><?php echo $row->art_price;?></td>
                             <td> <img src="<?php echo $row->art_img;?>" alt="" width="100" height="100"> </td>
                             <td><?php echo $row->creator_name; ?></td>
                                
                                 
                                 <td>
                                     <input style = "border: none; color: white; background:#343A40;" type="number" name="sequence" value="<?php echo $row->sequence; ?>">
                             <input type="hidden" name="feature_id" value="<?php echo $row->feature_id; ?>">
                                 </td>               
                            <td>
                            <input type="submit" value="Change Sequence"  class="btn btn-success btn-sm m-1">
                            </td>
                          </tr>
                          </form>
                          <?php
                          if (++$i == 5) break;
                           }
                          ?>
                        </tbody>
                      </table>
                      <div class="text-center">
                      <a href ="./featuresArtwork.php"  type="button" class="btn btn-secondary mt-2
                          ">View All</a>
                                </div>
                    </div>
                  </div>
                </div>
              </div>
                            

<!--Hot Collections card-->

               <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Hot Collections</h4>
                          
                          <a href ="./addHotColls.php"  type="button" class="btn btn-primary mt-2 float-right"
                          >ADD</a>
                          
                    <div class="table-responsive pt-3">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                              <th>No.</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Art Price</th>
                            <th>Image</th>
                            <th>Creator Name</th>
                            <th>Sequence</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                         $url = base_url."admin/admin/api/hotCollections/readAllHotcollectionArts.php";
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
$i = 0;
$num=0;
                           foreach($data->hotCollection as $row ){                
                                    $num++;  
                          ?>
                         
               <form action="../admin/api/hotCollections/sequence.php" method="post">  
                                
                          <tr>
                              <td><?php echo $num;?></td>
                             <td><?php echo $row->art_name;?></td>
                             <td><?php echo $row->description;?></td>
                             <td><?php echo $row->art_price;?></td>
                             <td> <img src="<?php echo $row->art_img;?>" alt="" width="100" height="100"> </td>
                             <td><?php echo $row->creator_name; ?></td>
                                
                                 
                                 <td>
                                     <input style = "border: none; color: white; background:#343A40;" type="number" name="sequence" value="<?php echo $row->sequence; ?>">
                             <input type="hidden" name="hot_coll_id" value="<?php echo $row->hot_coll_id; ?>">
                                 </td>               
                            <td>
                            <input type="submit" value="Change Sequence"  class="btn btn-success btn-sm m-1">
                            </td>
                          </tr>
                          </form>
                          <?php
                          if (++$i == 5) break;
                           }
                          ?>
                        </tbody>
                      </table>
                      <div class="text-center">
                      <a href ="./hotcollections.php"  type="button" class="btn btn-secondary mt-2
                          ">View All</a>
                                </div>
                    </div>
                  </div>
                </div>
              </div>
           
           <!--trending collections card-->

               <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Trending Collections</h4>
                          
                          <a href ="./addTrendingCollection.php"  type="button" class="btn btn-primary mt-2 float-right"
                          >ADD</a>
                          
                    <div class="table-responsive pt-3">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                               <th>No</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Art Price</th>
                            <th>Image</th>
                            <th>Creator Name</th>
                            <th>Sequence</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                         $url = base_url."admin/admin/api/trendingcollection/readAlltrendingArts.php";
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
$i = 0;
$num=0;
                           foreach($data->trendingcollections as $row ){                
                                    $num++;  
                          ?>
                         
                <form action="../api/trendingcollections/sequence.php" method="post">  
                                
                          <tr>
                          <tr>
                         <td><?php echo $num;?></td>
                             <td><?php echo $row->art_name;?></td>
                             <td><?php echo $row->description;?></td>
                             <td><?php echo $row->art_price;?></td>
                             <td> <img src="<?php echo $row->art_img;?>" alt="" width="100" height="100"> </td>
                             <td><?php echo $row->creator_name; ?></td>
                                
                                 
                                 <td>
                                     <input style = "border: none; color: white; background:#343A40;" type="number" name="sequence" value="<?php echo $row->sequence; ?>">
                             <input type="hidden" name="trending_coll_id" value="<?php echo $row->trending_coll_id; ?>">
                                 </td>               
                            <td>
                            <input type="submit" value="Change Sequence"  class="btn btn-success btn-sm m-1">
                            </td>
                          </tr>
                          </form>
                          <?php
                          if (++$i == 5) break;
                           }
                          ?>
                        </tbody>
                      </table>
                      <div class="text-center">
                      <a href ="./trendingcollections.php"  type="button" class="btn btn-secondary mt-2
                          ">View All</a>
                                </div>
                    </div>
                  </div>
                </div>
              </div>
            <!--live auction collections card-->

               <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">LIVE AUCTION</h4>
                    
                    <!--<a href ="./RCAs.php"  type="button" class="btn btn-primary mt-2 float-right"-->
                    <!--      >ADD</a>-->
                          
                    <div class="table-responsive pt-3">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Art Price</th>
                            <th>Image</th>
                            <th>Creator Name</th>
                            <!--<th>Sequence</th>-->
                            <!--<th>Actions</th>-->
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                         $url = base_url."admin/admin/api/liveauction/readAll_liveArts.php";
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
$i = 0;
$num=0;
                           foreach($data->liveAuction as $row ){                
                                    $num++;  
                          ?>
                         
                                
                          <tr>
                          <tr>
                          <!--quencies.alshumaal.com/admin/view/dashboard.php-->
                             <td><?php echo $row->listing_id;?></td>
                             <td><?php echo $row->art_name;?></td>
                             <td><?php echo $row->description;?></td>
                             <td><?php echo $row->art_price;?></td>
                             <td> <img src="<?php echo $row->art_img;?>" alt="" width="100" height="100"> </td>
                             <td><?php echo $row->creator_name; ?></td>
                                
                                 
                            <!--     <td>-->
                            <!--         <input style = "border: none; color: white; background:#343A40;" type="number" name="sequence" value="< ?php echo $row->sequence; ?>">-->
                            <!-- <input type="hidden" name="id" value="< ?php echo $row->id; ?>">-->
                            <!--     </td>               -->
                            <!--<td>-->
                            <!--<input type="submit" value="Change Sequence"  class="btn btn-success btn-sm m-1">-->
                            <!--</td>-->
                          </tr>
                         
                          <?php
                          if (++$i == 5) break;
                           }
                          ?>
                        </tbody>
                      </table>
                      <div class="text-center">
                      <a href ="./liveauction.php"  type="button" class="btn btn-secondary mt-2
                          ">View All</a>
                                </div>
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
    
 
