<?php include('partials/nav.php');?>
<html><head>
<link rel="stylesheet" href="../css/admin.css">
</head>
<div class="main-content">
            <div class="wrapper">
                <h1 class="h1">Add category</h1><br><br><br>
<?php
if(isset($_SESSION['add'])){
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
if(isset($_SESSION['upload'])){
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}

?>

                <form action="" method="POST" enctype="multipart/form-data">

                    <table class="tbl-30">
                        <tr>
                            <td>Title</td>
                            <td><input type="text" name="title" placeholder="Category Title"></td>
                        </tr>
                        <tr>
                            <td>Select Image:</td>
                            <td><input type="file" name="image"></td>
                        </tr>
                        <tr><td></td></tr>
                        <tr>
                            <td><lable>Featured:</lable></td>
                            <td>
                                <input type="radio" name="featured" value="Yes">Yes
                                <input type="radio" name="featured" value="No">No
                            </td>
                        </tr>
                            <tr>
                                <td>Active:</td>
                                <td><input type="radio" name="active" value="Yes">Yes
                                <input type="radio" name="active" value="No">No
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" name="submit" value="Add Category" class="btn-login">
                                </td>
                            </tr>
                            </table>
                        </form>

                        <?php 
                            if(isset($_POST['submit'])){
                                 //echo "clicked";
                                 $tilte= $_POST['title'];
                                 //for radio button action
                                 if(isset($_POST['featured'])){

                                    $featured=$_POST['featured'];

                                 }else{
                                    $featured="No";

                                 }
                                 if(isset($_POST['active'])){
                                    $active= $_POST['active'];
                                 }else{
                                    $active="No";
                                 }

                                 //print_r($_FILES['image']);

                                 //die();

                                                if(isset($_FILES['image']['name']))
                                                {

                                                    //upload image

                                                    $image_name= $_FILES['image']['name'];

                                                                            if($image_name!="")
                                                                            {


                                                                            //auto rename image
                                                                            $ext= end(explode('.',$image_name));

                                                                            $image_name="food_category_".rand(000,999).'.'.$ext;

                                                                            $source_path= $_FILES['image']['tmp_name'];

                                                                            $destination_path= "../images/category/".$image_name;

                                                                            $upload= move_uploaded_file($source_path,$destination_path);

                                                                                if($upload==false){

                                                                                    $_SESSION['upload']= "<div class='error'>Faild to upload image.</div>";
                                                                                    header('location:'.SITEURL.'admin/add-category.php');
                                                                                    die();
                                                                                }
                                                                        }
                                                }else
                                                {
                                    //dont upload
                                    
                                    $image_name= "";
                                }

                                $sql="INSERT INTO dbl_category SET title='$tilte',image_name='$image_name',featured='$featured',	active='$active'";

                                $res=mysqli_query($conn,$sql);

                                if($res==true){
                                        $_SESSION['add'] = "<div class='success'><b>Category Added Successfully</b>.</div>";
                                        header('location:'.SITEURL.'admin/manage-category.php');
                                }else{
                                    $_SESSION['add'] = "<div class='error'><b>Faild To Add Category</b>.</div>";
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                }
                            }
                        ?>
            </div>
</div>

<?php include('partials/footer.php');?>