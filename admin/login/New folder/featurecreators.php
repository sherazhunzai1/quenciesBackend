<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Featured Creators</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css" />
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
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div
          class="
            text-center
            navbar-brand-wrapper
            d-flex
            align-items-center
            justify-content-center
          "
        >
        <h3 class="admin_heading"style="margin: 0">
          <a class="nav-link" href="dashboard.php">
              <span class="admin_heading" style= "color: black">Liberty Admin</span>
            </a>
            </h3>
        </div>
        <div
          class="
            navbar-left-padding navbar-menu-wrapper
            d-flex
            align-items-center
            justify-content-end
          "
        >
          <button
            class="navbar-toggler navbar-toggler align-self-center"
            type="button"
            data-toggle="minimize"
          >
            <span class="ti-view-list"></span>
          </button>
          <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
              <div class="input-group">
                <div
                  class="input-group-prepend hover-cursor"
                  id="navbar-search-icon"
                >
                  <span class="input-group-text" id="search">
                    <i class="ti-search"></i>
                  </span>
                </div>
                <input
                  type="text"
                  class="form-control"
                  id="navbar-search-input"
                  placeholder="Search now"
                  aria-label="search"
                  aria-describedby="search"
                />
              </div>
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                data-toggle="dropdown"
                id="profileDropdown"
              >
                <img src="images/faces/face28.jpg" alt="profile" />
              </a>
              <div
                class="dropdown-menu dropdown-menu-right navbar-dropdown"
                aria-labelledby="profileDropdown"
              >
                <a class="dropdown-item">
                  <i class="ti-settings text-primary"></i>
                  Settings
                </a>
                <a class="dropdown-item" href = "logout.php">
                  <i class="ti-power-off text-primary"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
          <button
            class="
              navbar-toggler navbar-toggler-right
              d-lg-none
              align-self-center
            "
            type="button"
            data-toggle="offcanvas"
          >
            <span class="ti-view-list"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
                <i class="ti-shield menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
              <a class="nav-link" href="./nftimages.php">
                <i class="ti-layers menu-icon"></i>
                <span class="menu-title">NFT Images</span>
              </a>
                            <a class="nav-link" href="./nftaudios.php">
                <i class="ti-calendar menu-icon"></i>
                <span class="menu-title">NFT Audios</span>
              </a>
              <a class="nav-link" href="./featureart.php">
                <i class="ti-layers menu-icon"></i>
                <span class="menu-title">Feature Artworks</span>
              </a>
              
              <a class="nav-link" href="./featurecreators.php">
                <i class="ti-layers menu-icon"></i>
                <span class="menu-title">Featured Creators</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Featured Creators</h4>

                    <div class="table-responsive pt-3">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Emai</th>
                            <th>Wallet Address</th>
                            <th>Social Site</th>
                            <th>Gallery Site</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Herman Beck</td>
                            <td>$ 77.99</td>
                            <td>May 15, 2015</td>
                            <td>Herman Beck</td>
                            <td>$ 77.99</td>
                            <td>
                              <button class="btn btn-success btn-sm m-1">
                                Approve</button
                              ><button class="btn btn-danger btn-sm m-1">
                                Disapprove
                              </button>
                            </td>
                          </tr>
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

    <!-- plugins:js -->
    <script src="vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page-->
  </body>
</html>
