<?php
include('../config/constants.php');
//echo "delete-food";
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        //process delete
       $id= $_GET['id'];
       $image_name= $_GET['image_name'];

       if($image_name!=""){
           $path = "../images/food/".$image_name;

           $remove = unlink($path);
           if($remove==false){
            $_SESSION['upload'] = "<div class='error'>Faild To Remove Image</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            die();
            }
       }
       
       $sql = "DELETE FROM dbl_food WHERE id=$id";

       $res = mysqli_query($conn, $sql);

       if($res==true){

        $_SESSION['delete'] = "<div class='success'>Food deleted successfully.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');

       }else{

        $_SESSION['delete'] = "<div class='error'>Faild to Delete Food.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');

       }

    }else{
        //redirect to the page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>