<?php include('partials/nav.php');?>

        <!--main content start -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1><br>

                <?php 
                    if(isset($_SESSION['add'])){
                    
                        echo $_SESSION['add'];
                        
                        unset($_SESSION['add']); //Removing session
                     }
                     if(isset($_SESSION['delete'])){

                         echo $_SESSION['delete'];
                         unset($_SESSION['delete']);
                     }
                     if(isset($_SESSION['update'])){

                        echo $_SESSION['update'];
                         unset($_SESSION['update']);
                     }
                    
                     if(isset($_SESSION['change-pwd'])){

                        echo $_SESSION['change-pwd'];
                         unset($_SESSION['change-pwd']);
                     }
                     
                ?>
                <br><br><br>
                <!-- Button add admin-->
                    <a href="add-admin.php" class="btn-primary">+ Add Admin</a>

                <br><br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                     <?php
                     //display all admin 
                        $sql= "SELECT * FROM tbl_admin";
                        $res= mysqli_query($conn,$sql);//execute query

                    if($res==TRUE){
                        $count = mysqli_num_rows($res);//get no.of rows in table

                        $inc=1;
                        //rows should <0
                        if($count>0){
                            //we have data in table
                                while($rows= mysqli_fetch_assoc($res)){
                                    $id= $rows['id'];
                                    $full_name= $rows['full_name'];
                                    $username= $rows['username'];
                                    //display values

                                    ?>
                                    <tr>
                                        <td><?php echo $inc++;?>.</td>
                                        <td><?php echo $full_name;?></td>
                                        <td style="color: black;"><?php echo $username;?></td>
                                        <td>
                                            <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-pass">Change Password</a>
                                            <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary"> Update Admin</a>
                                            <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                        </td>
                                    </tr>

                                    <?php
                                 }
                        }else{
                            //we don't have data in table
                        }
                    }
                     ?>

                </table>
                
            </div>
        </div>
        <!--main content ends -->
 <?php include('partials/footer.php');?>

       