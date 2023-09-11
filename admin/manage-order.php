<?php include('partials/nav.php')?>



<div class="main-content">
    <div class="wrapper2">
    <h1 style="font-weight: 900;">Manage Order</h1><br><br>

    <?php 
    
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

    ?>
    <br>

    <table class="tbl-full" >
    <tr>
        <th>S.N </th>
        <th> Food </th>
        <th> Price </th>
        <th> Qty </th>
        <th> Total</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Customer-Name</th>
        <th>Customer-Contact</th>
        <th>Email</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>

    <?php 
    
        $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; // DISPLAY the latest order first
        
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        $i = 1;  //for display the serial.numbers

        if($count>0){

            while($row = mysqli_fetch_assoc($res)){

                $id = $row['id'];
                $food = $row['food'];
                $price =$row['price'];
                $qty = $row['qty'];
                $total = $row['total'];
                $order_date = $row['order_date'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];

                ?>
                    <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo $food;?></td>
                        <td><?php echo $price;?></td>
                        <td><?php echo $qty;?></td>
                        <td><?php echo $total;?></td>
                        <td><?php echo $order_date;?></td>

                        <td>
                            <?php 
                                if($status=="Ordered"){
                                    echo "<lable style='color: blue;'><b>".$status."</b></lable>";
                                }elseif($status=="On Delivery"){
                                    echo "<lable style='color: #ff45b0;'><b>".$status."</b></lable>";
                                }elseif($status=="Delivered"){
                                    echo "<lable style='color: #28f569;'><b>".$status."</b></lable>";
                                }elseif($status=="Cancelled"){
                                    echo "<lable style='color: red;'><b>".$status."</b></lable>";
                                }
                            ?>
                        </td>

                        <td><?php echo $customer_name;?></td>
                        <td><?php echo $customer_contact;?></td>
                        <td><?php echo $customer_email;?></td>
                        <td><?php echo $customer_address;?></td>
                        <td>
                        <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update Order</a>
            
                        </td>
                    </tr>

                <?php

            }

        }else{
            echo "<tr><td colspan='12' class='error'>Order Not Available.</td></tr>";
        }

    ?>
    <?php 
        $sql = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
                    
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);

        $total_revenue = $row['Total'];
    ?>
   
   
</table>
<br><br>
<h1 style="text-align: center;color: black;font-weight: 900;">TOTAL REVENUE<?php echo "<div style='color: rgb(248, 21, 97);font-weight: 900;'>"?><?php echo "$ ".$total_revenue;?><?php echo "</div>"?></h1>

    </div>
</div>
<?php include('partials/footer.php')?>