<?php
session_start();
unset($_SESSION['user']);
 header("Location:http://quencies.alshumaal.com/admin/view/login.php");
?>