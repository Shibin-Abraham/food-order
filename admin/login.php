<?php include('../config/constants.php');?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login  Food Order system</title>
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">-->
<link rel="stylesheet" href="../css/login.css">
<!--<link rel="stylesheet" href="../css/admin.css">-->

</head>
<body>
<!-- partial:index.partial.html -->
<div id="login-form-wrap">
<div class="waviy">
   <span style="--i:1">L</span>
   <span style="--i:2">O</span>
   <span style="--i:3">G</span>
   <span style="--i:4">I</span>
   <span style="--i:5">N</span>

  </div><br>
                     <?php 

                            if(isset($_SESSION['login'])){

                                echo $_SESSION['login'];
                                unset($_SESSION['login']);
                            }
                            if(isset($_SESSION['no-login-meassage'])){

                              echo $_SESSION['no-login-meassage'];
                              unset($_SESSION['no-login-meassage']);
                            }
  
                     ?>
  <br>
  <form id="login-form" method="POST" action="">
    <p>
    <input type="text" id="username" name="username" placeholder="Enter Username" required><i class="validation"><span></span><span></span></i>
    </p>
    <p>
    <input type="Password" id="password" name="Password" placeholder="Enter Password" required><i class="validation"><span></span><span></span></i>
    </p>
    <p>
    <input type="submit" id="login" value="Login" name="submit">
    </p>
  </form>
  <div id="create-account-wrap">
    <p>Not a member? <a href="#">Create Account</a><p>
  </div><!--create-account-wrap-->
</div><!--login-form-wrap-->
<!-- partial -->
  
</body>
</html>

<!-------------------------------------------------- PHP--------------------------------------------------------- -->
<?php 

        if(isset($_POST['submit'])){
            //process for login
            //$username= $_POST['username'];
            $username= mysqli_real_escape_string($conn, $_POST['username']);
            $raw_password= md5($_POST['Password']);
            $password= mysqli_real_escape_string($conn, $raw_password);

            //sql query to check username and password

            $sql= "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

            $res= mysqli_query($conn,$sql);

            $count= mysqli_num_rows($res);

            if($count==1){
                $_SESSION['login']="<div class='success2'>Login Successfull.</div>";

                  $_SESSION['user']= $username;//check loged in or not

                header('location:'.SITEURL.'admin/');
            }else{
                $_SESSION['login']="<div class='error'>Username or Password did not match.</div>";
                header('location:'.SITEURL.'admin/login.php');
            }
        }
?>
