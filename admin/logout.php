<?php 

    include('../config/constants.php');
    //Destroy the session then redirect to login page
    session_destroy();

    header('location:'.SITEURL.'admin/login.php');

?>