<?php
session_start();
if($_SESSION['user']){
   header("Location:http://localhost/login/New%20folder/dashboard.php"); 
}
else{
    header("Location:http://localhost/login/New%20folder/login.php");
}


?>