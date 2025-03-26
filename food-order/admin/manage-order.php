<?php include('partials/menu.php'); ?>
     <!--Main Content Section Start-->
     <div class="main-content">
            <div class="wrapper">
                <h1>Mange Order</h1>

                <br /><br /> <br />

                <?php
                     if(isset($_SESSION['update']))
                     {
                     echo $_SESSION['update'];
                     unset($_SESSION['update']);
                     }
                ?>
                <table style="width: 100%; ">
                    <tr>
                        <th>S.N.</th>
                        <th>Sweet</th>
                        <th>Price</th>
                        <th>Quty</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

                        $res = mysqli_query($conn,$sql);

                        $count = mysqli_num_rows($res);

                        $sn = 1;

                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $coustomer_address = $row['coustomer_address'];

                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?>.</td>
                                    <td><?php echo $food; ?></td>
                                    <td><?php echo $price, ".per Kg"; ?></td>
                                    <td><?php echo $qty,".Kg"; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $order_date; ?></td>

                                    <td>
                                        <?php 
                                            if($status=="ordered")
                                            {
                                                echo "<label>$status</label>";
                                            }
                                            elseif($status=="on delivery")
                                            {
                                                echo "<label style='color: orange;'>$status</label>";
                                            }
                                            elseif($status=="deliverded")
                                            {
                                                echo "<label style='color: green;'>$status</label>";
                                            }
                                            elseif($status=="cancelled")
                                            {
                                                echo "<label style='color: red;'>$status</label>";
                                            }

                                        ?>
                                
                                    </td>

                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td><?php echo $coustomer_address; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">UbdateOrder</a>
                                        
                                    </td>
                                    
                                </tr>
                                <?php
                            }

                        }
                        else
                        {
                            echo "<tr><td colspan='12' class='error'> Orders Not Available </td></tr>";
                        }
                    ?>
                    
                </table>
                
            </div>
        </div>
        <!--Main Content Section End-->

<?php include('partials/footer.php');?>