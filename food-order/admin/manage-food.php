<?php include('partials/menu.php'); ?>
     <!--Main Content Section Start-->
     <div class="main-content">
            <div class="wrapper">
                <h1>Mange Sweet</h1>
                <br /><br/>
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['remove']))
                {
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['failed-remove']))
                {
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);
                }
                if(isset($_SESSION['uplode']))
                {
                    echo $_SESSION['uplode'];
                    unset($_SESSION['uplode']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['no-sweet-found']))
                {
                    echo $_SESSION['no-sweet-found'];
                    unset($_SESSION['no-sweet-found']);
                }
            ?>
            <br><br>
                <!--Button to Add Admin -->
                <a href="<?php echo SITEURL; ?>admin/add-food.php"class="btn-primary">Add Sweet</a>

                <br /><br /> <br />
                <table  class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Active</th>
                        <th>Actions</th>
                        <?php
                        //Query to get all category from database
                        $sql = "SELECT * FROM tbl_food";

                        //Execute Query
                        $res = mysqli_query($conn,$sql);

                        //Count row
                        $count = mysqli_num_rows($res);

                        $sn=1;

                        //Check the whether wehave data in database or not
                        if($count>0)
                        {
                            //we have data in database
                            //get the data and display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $price =$row['price'];
                                $image_name = $row['image_name'];
                                $active = $row['active'];

                                ?>
                                <tr>
                                    <td> <?php echo $sn++; ?> </td>
                                    <td> <?php echo $title; ?> </td>
                                    <td><?php echo $price, "per kg"; ?></td>
                                    <td>
                                        <?php 

                                            //check weather image name is available or not
                                            if($image_name!="")
                                            {
                                                //Display the image
                                                ?>

                                                <img src="<?php echo SITEURL; ?>images/sweet/<?php echo $image_name; ?>" width="100px">
                                                <?php
                                            }
                                            else
                                            {
                                                //Display the message
                                                echo "<div class='error'> Image not Available.</div>";
                                            }


                                        ?> 

                                    </td>
                            
                                    <td> <?php echo $active; ?> </td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Ubdate Menu</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?> " class="btn-danger">Delete Menu</a>
                                    </td>
                                </tr>
                                <?php

                            }
                        }
                        else
                        {
                            //we do not have data
                            //we will display the message inside table
                            ?>

                            <tr>
                                <td colspan="7"><div class="error">No Sweet Added.</div></td>
                            </tr>

                            <?php
                        }
                    ?>

                  
                </table>

                
            </div>
        </div>
        <!--Main Content Section End-->

<?php include('partials/footer.php');?>