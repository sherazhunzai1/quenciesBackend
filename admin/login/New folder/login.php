<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>Liberty Admin</title>
    <!-- plugins:css -->
    <link
      rel="stylesheet"
      href="/vendors/ti-icons/css/themify-icons.css"
    />
    <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css" />
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                  <h3>Liberty Admin</h3>
                </div>
                <h4>Hello! let's get started</h4>
                <?php
                if(isset($_SESSION['error'])){
                
                 ?>
                
                <h6 class="font-weight-light text-danger"><?php echo $_SESSION['error']; ?></h6>
                <?php
                }
                unset($_SESSION['error']);
                ?>
                <form class="pt-3" action = "../admin/api/login/login.php"  method="post">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control form-control-lg"
                      id="exampleInputEmail1"
                      placeholder="Username"
                      name="username"
                    />
                  </div>
                  <div class="form-group">
                    <input
                    name="password"
                      type="password"
                      class="form-control form-control-lg"
                      id="exampleInputPassword1"
                      placeholder="Password"
                    />
                  </div>
                  <div class="mt-3">
                    <input type="submit"
                      class="
                        btn btn-block btn-primary btn-lg
                        font-weight-medium
                        auth-form-btn
                      "
                     value="SIGN IN"
                      >
                  </div>
                  <div
                    class="
                      my-2
                      d-flex
                      justify-content-between
                      align-items-center
                    "
                  >
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input" />
                        Keep me signed in
                      </label>
                   
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
  </body>
</html>
