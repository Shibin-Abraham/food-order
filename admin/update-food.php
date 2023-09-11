<?php include('partials/nav.php');?>

<?php 

    if(isset($_GET['id'])){
        $id=$_GET['id'];

        $sql2= "SELECT * FROM dbl_food WHERE id=$id";

        $res2= mysqli_query($conn,$sql2);

        $row = mysqli_fetch_array($res2);

        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $current_image = $row['image_name'];
        $current_category = $row['category_id'];
        $featured =$row['featured'];
        $active = $row['active'];

    }else{
        //header('location:'.SITEURL.'admin/manage-food.php');
        echo ("<script>location.href='".SITEURL."admin/manage-food.php';</script>");
    }

?>
<div class="main-content">

    <div class="wrapper">
    <h1>Update Food</h1>
    <br><br>

             <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">

                <tr>
                    <td>Title:</td>
                    <td><input style="text-align: center; font-weight: bold;" type="text" value="<?php echo $title;?>" name="title" placeholder="Title of the Food"></td>
                </tr>
                
                <tr>
                    <td>Description:</td>
                    <td><textarea style="text-align: center; font-weight: bold;" name="description"  cols="30" rows="5" placeholder="Description of the Food."><?php echo $title;?></textarea></td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td><input style="text-align: center; font-weight: bold;" type="number" name="price" value="<?php echo $price;?>" placeholder="Price of the Food"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                            if($current_image == ""){
                                echo "<div class='error'>Image not Availabe.</div>";
                            }else{
                                ?>
                                <img style="width: 180px; height: 125px; border-radius: 17px;" src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" alt="<?php echo $title;?>">
                                <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                        <?php 
                            $sql = "SELECT * FROM dbl_category WHERE active='Yes'";

                            $res = mysqli_query($conn,$sql);

                            $count = mysqli_num_rows($res);

                            if($count>0)
                            {
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                                    

                                   // echo "<option value='$category_id'>$category_title</option>";
                                    ?>
                                    <option <?php if($current_category==$category_id){echo "Selected";}?> value="<?php echo $category_id; ?>"><?php echo $category_title;?></option>
                                    <?php
                                    
                                }
                            }
                            else
                            {
                            
                            echo "<option value='0'>No Category Found.</option>";
                                
                            }
                        ?>
 
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <input <?php if($featured=="yes"){echo "checked";}?> type="radio" name="featured" value="yes">Yes
                        <input <?php if($featured=="no"){echo "checked";}?> type="radio" name="featured" value="no">No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input <?php if($active=="yes"){echo "checked";}?> type="radio" name="active" value="yes">Yes
                        <input <?php if($active=="no"){echo "checked";}?> type="radio" name="active" value="no">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
             </form>
             <?php 
                
                if(isset($_POST['submit'])){
                    //echo "update btn clicked";

                    //Geting Data from form
                   $id = $_POST['id'];
                   $title = $_POST['title'];
                   $description = $_POST['description'];
                   $price = $_POST['price'];
                   $current_image = $_POST['current_image'];
                   $category = $_POST['category'];

                  $featured = $_POST['featured'];
                  $active = $_POST['active'];

                    if($_FILES['image']['name']!=""){

                       $image_name = $_FILES['image']['name'];//associative Array([name]=>food.png[type]=>image/png[tmp_name]=>C:Xampnew\tmp\php\phpA74.tmp[error]=>0[size]=>64851)

                        if($image_name!=""){
                            $explode= explode('.', $image_name);
                            $ext= end($explode);// Get the extension of the image

                            $image_name = "Food-Name-".rand(0000,9999).'.'.$ext;

                            $src_path = $_FILES['image']['tmp_name'];//sourc path

                            $des_path = "../images/food/".$image_name;

                            $upload = move_uploaded_file($src_path,$des_path);

                            if($upload==false){
                                $_SESSION['upload'] = "<div class='error'>Faild To Upload New Image.</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                die();

                            }
                        }else{
                            $image_name = $current_image;
                        }


                    }else{
                      $image_name = $current_image;
                      
                    }

                    $sql3 = "UPDATE dbl_food SET title='$title',description='$description',price=$price,image_name='$image_name',category_id= '$category',featured='$featured',active='$active' WHERE id=$id";
                    //"UPDATE `dbl_food` SET `title`='$title',`description`='$description',`price`='$price',`image_name`='$image_name',`category_id`='$category',`featured`='$featured',`active`='$active' WHERE id=$id";
                    $res3 = mysqli_query($conn,$sql3);

                   if($res3==true){
                        $_SESSION['update'] = "<div class='success'>Food Update Successfully.</div>";
                       // header('location:'.SITEURL.'admin/manage-food.php');
                       echo ("<script>location.href='".SITEURL."admin/manage-food.php';</script>");
                    }else{
                        $_SESSION['update'] = "<div class='error'>Faild To Update Food.</div>";
                        header("Location:".SITEURL."admin/manage-food.php");
                    }


                }
             
             ?>

    </div>
</div>
<?php include('partials/footer.php')?>