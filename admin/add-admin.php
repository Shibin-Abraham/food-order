<?php include('partials/nav.php');?>


        <div class="main-content">
            <div class="wrapper">
                <h1 class="h1">ADD ADMIN</h1><br>

                    <?php //if admin added faild to do this operation
                        if(isset($_SESSION['add'])){
                            
                            echo $_SESSION['add'];
                            unset($_SESSION['add']);//remove session
                        }
                    ?>
                    <br><br>

                <form action="" method="POST">
                    <table class="tbl-30">
                        <tr>
                            <td>Full Name: </td>
                            <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                        </tr>
                        <tr>
                            <td>Username: </td>
                            <td><input type="text" name="username" placeholder="Your Username"></td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td><input type="password" name="password" placeholder="Your Password"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn-secondary"></td>
                        </tr>
                    </table>


                </form>

            </div>
        </div>


<?php include('partials/footer.php');?>

<?php
//process the value from form and save it in database
if(isset($_POST['submit'])){
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);//password encryption with md5

    //sql query to save data into data base
    $sql= "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
    ";

    //3. execute query
    
    $res= mysqli_query($conn,$sql);

    //4.check whether the data is inserted or not
    if($res==TRUE){
        //create session variable
        $_SESSION['add']="<div class='success2'>Admin Added Successfully</div>";
        header("location:".SITEURL.'admin/manage-admin.php');//redirect to manage-admin.php
    }else{
        $_SESSION['add']="<div class='error'>Faild To Add Admin</div>";
        header("location:".SITEURL.'admin/add-admin.php');//redirect to manage-admin.php
    }
}


?>