<?php 
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name!="")
        {
            $path = "../images/category/".$image_name;

            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category <i>Image</i>.</div>";

                header('location:'.SITEURL.'admin/manage-category.php');

                die();
            }
        }

        $sql = "DELETE FROM dbl_category WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        if($res == true)
        {
            $_SESSION['delete']="<div class='success2'><b>Category Deleted <i>Successfully</i></b>.</div>";

            header('location:'.SITEURL.'admin/manage-category.php');
        }else
        {
            $_SESSION['delete']="<div class='error'>Faild to Delete <i>Category</i>.</div>";

            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>