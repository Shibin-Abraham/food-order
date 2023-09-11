<?php include('partials/nav.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1><br>
        
        <?php 
            if(isset($_GET['id'])){
                $id=$_GET['id'];
                $_SESSION['id-of-id']= $id;
            }
            
        ?>
        <?php
         if(isset($_SESSION['pwd-not-match'])){

            echo $_SESSION['pwd-not-match'];
             unset($_SESSION['pwd-not-match']);
         }
         if(isset($_SESSION['user-note-found'])){

            echo $_SESSION['user-note-found'];
             unset($_SESSION['user-note-found']);
         }
         if(isset($_SESSION['faild-pwd'])){

            echo $_SESSION['faild-pwd'];
             unset($_SESSION['faild-pwd']);
         }
        
        ?><br>
       

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td><input type="password" name="old_password" placeholder="Current Password" required></td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td><input type="password" name="new_password" placeholder="New Password" required></td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $_SESSION['id-of-id']; ?>">
                        <input type="submit" value="Change Password" name="submit" class="btn-pass">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>


<?php 

            if(isset($_POST['submit'])){
                //echo "clicked";
                //get data from form
                //$id= $_POST['id'];
                $session= $_SESSION['id-of-id'];
                $current_password= md5($_POST['old_password']);
                $new_password= md5($_POST['new_password']);
                $confirm_password= md5($_POST['confirm_password']);

                //check whether the user with current id and password exists or not

                $sql= "SELECT * FROM tbl_admin WHERE id=$session AND password='$current_password'";//Note '$current_password' is varchar

                $res= mysqli_query($conn,$sql);

                if($res==TRUE){
                    $count=mysqli_num_rows($res);

                    if($count==1){
                        //echo $current_password;
                        
                            if($new_password==$confirm_password){
                                

                               // echo "match";
                               $sql2= "UPDATE tbl_admin SET 
                               password='$new_password' WHERE id=$session
                               ";
                               $res2= mysqli_query($conn,$sql2);

                               if($res==TRUE){

                                $_SESSION['change-pwd'] = "<diV class='success2'>Password Changed Successfully.</div>";
                                header('location:'.SITEURL.'admin/manage-admin.php');
                                unset($_SESSION['id-of-id']);

                               }else{

                                $_SESSION['faild-pwd'] = "<diV class='error'>Faild To Change Password.</div>";
                                header('location:'.SITEURL.'admin/update-password.php');

                               }

                            }else{
                                $_SESSION['pwd-not-match'] = "<diV class='error'>Password Did Not match.</div>";
                                header('location:'.SITEURL.'admin/update-password.php');
                            }
                    
                    
                    }else{
                        $_SESSION['user-note-found'] = "<diV class='error'>Sorry,User Not Found.</div>";
                        header('location:'.SITEURL.'admin/update-password.php');
                    }
                }
                //the newpassword == confirm password
                //change password if all above is true


            }
?>


<?php include('partials/footer.php');?>