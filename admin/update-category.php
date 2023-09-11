<?php include('partials/nav.php') ?>

<div class="main-content">

    <div class="wrapper">
        <h1>Update Category</h1><br><br>

    <?php 
    
    if(isset($_GET['id']))
    {
        $id= $_GET['id'];

        $sql="SELECT * from dbl_category WHERE id=$id";

        $res= mysqli_query($conn,$sql);

        $count= mysqli_num_rows($res);
        
        if($count==1)
        {
            $row= mysqli_fetch_assoc($res);
            $title= $row['title'];
            $current_image= $row['image_name'];
            $featured= $row['featured'];
            $active= $row['active'];


        }else{
            $_SESSION['no-category-found']="<div class='error'><b>Category not Found</b>.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else{
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    
    ?>

        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
                        <tr>
                            <td>Title:</td>
                            <td><input style="text-align: center; font-weight: bold;" type="text" name="title" placeholder="Category Title" value="<?php echo $title;?>"></td>
                        </tr>
                        <tr>
                            <td>Current Image:</td>
                            <td>
                                <?php
                                    if($current_image!="")
                                    {
                                        ?>


                                        <img style="width: 180px; height: 125px; border-radius: 10px;" src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>">

                                        <?php
                                    }else
                                    {
                                        echo "<div class='error'>Image not Added.</div>";
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>New Image:</td>
                            <td><input style="font-weight: bold;" type="file" name="image" ></td>
                        </tr>
                        <tr>
                            <td><lable>Featured:</lable></td>
                            <td>
                                <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"><b>Yes</b>
                                <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"><b>No</b>
                            </td>
                        </tr>
                            <tr>
                                <td>Active:</td>
                                <td><input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"><b>Yes</b>
                                <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"><b>No</b>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                                    
                                    <input type="hidden" name="id" value="<?php echo $id;?>">

                                    <input style="font-weight: bold;" type="submit" name="submit" value="Update Category" class="btn-login">
                                </td>
                            </tr>
                            </table>
                        </form>
                        <?php 
                            if(isset($_POST['submit']))
                            {
                                //echo "clicked";
                                $id= $_POST['id'];
                                $title= $_POST['title'];
                                $current_image= $_POST['current_image'];
                                $featured= $_POST['featured'];
                                $active= $_POST['active'];

                                //image is selected or not
                                if(isset($_FILES['image']['name']))
                                {
                                    $image_name = $_FILES['image']['name'];

                                            if($image_name!="")
                                            {

                                                $ext= end(explode('.',$image_name));

                                                $image_name="food_category_".rand(000,999).'.'.$ext;

                                                $source_path= $_FILES['image']['tmp_name'];

                                                $destination_path= "../images/category/".$image_name;

                                                $upload= move_uploaded_file($source_path,$destination_path);

                                                            if($upload==false){

                                                                $_SESSION['upload']= "<div class='error'>Faild to upload image.</div>";
                                                                header('location:'.SITEURL.'admin/manage-category.php');
                                                                die();
                                                            }

                                                            if($current_image!="")
                                                            {
                                                                    $remove_path = "../images/category/".$current_image;

                                                                    $remove = unlink($remove_path);

                                                            if($remove==false)
                                                            {
                                                                    $_SESSION['failed-remove']= "<div class='error'>Faild to remove current image.</div>";
                                                                    header('location:'.SITEURL.'admin/manage-category.php');
                                                                    die();//stop the proccess
                                                            }

                                                            }

                                                    
                                            }else
                                            {
                                                $image_name = $current_image;
                                            }
                                }else
                                {
                                    $image_name = $current_image;
                                }

                                $sql2 = "UPDATE dbl_category SET title='$title',image_name='$image_name',featured='$featured',active='$active' WHERE id=$id";

                                $res2 = mysqli_query($conn,$sql2);

                                if($res2==true)
                                {
                                    $_SESSION['update']= "<div class='success'><b>Category Updated Successfully<b>.</di>";
                                    header("location:".SITEURL.'admin/manage-category.php');
                                }else
                                {
                                    $_SESSION['update']= "<div class='error'><b>Faild to Updated Category<b>.</di>";
                                    header("location:".SITEURL.'admin/manage-category.php');
                                }
                            }
                        ?>

    </div>

</div>

<?php include('partials/footer.php') ?>