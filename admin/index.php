<?php include('partials/nav.php');?>

        <!--main content start -->
        <div class="main-content">
            <div class="wrapper">
                <h1><i>DASHBOARD</i></h1><br>

                                    <?php 

                                        if(isset($_SESSION['login'])){

                                            echo $_SESSION['login'];
                                            unset($_SESSION['login']);
                                            }

                                    ?>
<br>
                <a href="<?php echo SITEURL;?>admin/manage-category.php">
                    <div class="col-4 text-center">
                    <?php 
                    
                        $sql = "SELECT * FROM dbl_category";
                        
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);


                    ?>
                    <h1 style="font-weight: bold;"><?php echo $count;?></h1>
                    <br>
                    Categories
                </div></a>
                <a href="<?php echo SITEURL;?>admin/manage-food.php">
                    <div class="col-4 text-center"  style="color: white;">
                    <?php 
                    
                    $sql = "SELECT * FROM dbl_food";
                    
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    ?>
                    <h1 style="font-weight: bold;"><?php echo $count;?></h1>
                    <br>
                    Foods
                    </div>
                </a>
                <a href="<?php echo SITEURL;?>admin/manage-order.php">
                <div class="col-4 text-center">
                <?php 
                    
                    $sql = "SELECT * FROM tbl_order";
                    
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                ?>
                    <h1 style="font-weight: bold;"><?php echo $count;?></h1>
                    <br>
                    Total Orders
                </div>
                </a>
                <a href="<?php echo SITEURL;?>admin/manage-order.php">
                <div class="col-4 text-center">
                <?php 
                    
                    $sql = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
                    
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($res);

                    $total_revenue = $row['Total'];
                ?>
                    <h1 class="total-rev">$ <?php echo $total_revenue;?></h1>
                    <br>
                    Revenue Generated
                </div></a>
                <div class="clear-fix"></div>
            </div>
        </div>
        <!--main content ends -->
<?php include('partials/footer.php');?>

    