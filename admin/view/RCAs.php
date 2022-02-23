<?php
include_once '../config/constants.php';
 include("header.php");
 include("sidebar.php");

?>
<head>
     <link href="css/styles.css" rel="stylesheet" />
</head>
<body  >
        <!-- partial -->
        <div class="main-panel" >
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body" style="background-color: #002d42">
                    <h4 class="card-title" style="color: white; font-weight: bold; text-transform: uppercase; font-size: 20px; ">RCA's </h4>
                 
                    <form action="../api/RCAs/createRca.php" method="post" enctype="multipart/form-data">
                        <center>
                            <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4" style="color: white; font-weight: bold; text-transform: uppercase; font-size: 20px; display: flex; flex-direction: column; align-items: flex-start;">Title</label>
      <input type="text" class="form-control" name="title" placeholder="RCA's Title" style="padding: 2px;">
    </div><br><br>
    <div class="form-group col-md-6">
      <label for="inputdescriptoin" style="color: white; font-weight: bold; text-transform: uppercase; font-size: 20px;display: flex; flex-direction: column; align-items: flex-start;">Description</label>
      <input type="text" class="form-control" name="description" placeholder="Description" style="padding: 2px;">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress" style="color: white; font-weight: bold; text-transform: uppercase; font-size: 20px;display: flex; flex-direction: column; align-items: flex-start;">Price</label>
    <input type="text" class="form-control" name="price" placeholder="Price" style="padding: 2px;">
  </div>
  <div class="form-group">
    <label for="inputAddress2" style="color: white; font-weight: bold; text-transform: uppercase; font-size: 20px; display: flex; flex-direction: column; align-items: flex-start;">Image</label>
    <input type="file" class="form-control" name="image" style="padding-left: 2px;" >
    <br><br>
    <button type="submit" class="btn btn-primary" style="background-color: rgb(102, 5 , 184); border: 1px solid rgb(102, 5 , 184);">Upload</button>
    
  </div>

    </div>
                        </center>
                    </form>
                    
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
  </body>
</html>
