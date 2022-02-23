<?php

session_start();



if($_SESSION['user']){
   header("Location:http://quencies.alshumaal.com/admin/view/dashboard.php"); 
}
else{
    header("Location:http://quencies.alshumaal.com/admin/view/login.php");
}


?>