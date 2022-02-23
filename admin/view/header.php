<?php

include_once '../config/constants.php';
session_start();
if($_SESSION['user']){
    
}
else{
    header("Location: ".base_url."/admin/view/login.php");
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quencies Admin</title>
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
              <span class="admin_heading" style= "color: black">Quencies Admin</span>
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
              <?php
              echo $_SESSION['user'];
              
              ?>
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
      
   