<?php 
        if(!isset($_SESSION['user'])){

            $_SESSION['no-login-meassage']= "<div class='error'>Please login to access Admin Panel.</div>";

            header('location:'.SITEURL.'admin/login.php');


        }
        
        
        
?>