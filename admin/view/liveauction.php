<?php
 include_once '../config/constants.php';
 include("header.php");
 include("sidebar.php");

?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">LIVE AUCTION </h4>
                    <div class="table-responsive pt-3">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Sequence</th>
                            <th>Action</th>
                            
                         
                        </thead>
                        <tbody>
                        <?php
                        
                        if(isset($_GET['pageno'])){
         $page=$_GET['pageno'];
    }
    else{
        $page=1;
    }
                        
                        $url = base_url."api/homepage/live_auction.php?pageno=".$page;
                         
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
                           foreach($data->liveAuction as $row ){                
                                    $num++;  
                          ?>

                          <form action="../admin/api/hotCollections/sequence.php" method="post">  
                         

                          <tr>
                             <td><?php echo $row->id;?></td>
                             <td><?php echo $row->art_name;?></td>
                             <td><?php echo $row->art_description;?></td>
                             <td> <img src="<?php echo $row->art_img;?>"  alt="" width="100" height="100"></td>
                             <td><?php echo $row->art_price;?></td>
                              
                                  
                                 <td>
                                     <input style = "border: none; color: white; background:#343A40;" type="number" name="sequence" value="<?php echo $row->sequence; ?>">
                             <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                                 </td>                
                            <td>
                            <input type="submit" value="Change Sequence"  class="btn btn-success btn-sm m-1">
                            </td>

                            </td>
                          </tr>
                          </form>
                          <?php
                         
                           }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  
                  <!--pagination-->
                  <nav aria-label="Page navigation example mt-5">
    <ul class="pagination justify-content-center">
        <li class="page-item ">
            <a class="page-link"
                href="<?php
                if($data->currentPage==1){echo "#";}
                else{
                     $prev=$data->currentPage;
                     --$prev;
                    echo  base_url."admin/view/liveauction.php?pageno=".$prev;
                }
                ?>">Previous</a>
        </li>
       <?php
       for($i=1;$i<=$data->totalPages;$i++){
       ?>
        <li class="page-item <?php if($i==$page){echo "active";} ?>">
            <a class="page-link " href="<?php echo  base_url."admin/view/liveauction.php?pageno=".$i; ?>"> <?php echo $i;?> </a>
        </li>
<?php
}
?>
        <li class="page-item">
            <a class="page-link"
                href="<?php
                if($data->currentPage==$data->totalPages){echo "#";}
                else{
                     $next=$data->currentPage+1;
                    echo  base_url."admin/view/liveauction.php?pageno=".$next;
                }
                ?>">Next</a>
        </li>
    </ul>
</nav>
                  </div>
                  </div>
                        </tbody>
                      </table>
                    </div>
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
