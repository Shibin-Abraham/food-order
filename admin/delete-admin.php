<?php 
    include('../config/constants.php');

   $id= $_GET['id'];//take id

   $sql= "DELETE FROM tbl_admin WHERE id=$id";//delete row of that id

   $res= mysqli_query($conn,$sql);

if($res==TRUE){
   // echo "success";
   $_SESSION['delete']= "<div class='success'>Admin Deleted Successfully.</div>";
   header('location:'.SITEURL.'admin/manage-admin.php');
}else{
   // echo "faild";
   $_SESSION['delete']= "<div class='error'>Faild To Delete Admin Try Again Later.</div>";
   header('location:'.SITEURL.'admin/manage-admin.php');
}


?>