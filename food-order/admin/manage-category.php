<?php include('partials/menu.php'); ?>
     <!--Main Content Section Start-->
     <div class="main-content">
            <div class="wrapper">
                <h1>Mange Category</h1>
                <br/><br />
                <?php
                    if(isset($_SESSION['add']))
                    {
                    echo $_SESSION['add'];//Displaying Session Message
                    unset($_SESSION['add']);//Removing session Message
                    }
                    if(isset($_SESSION['remove']))
                    {
                    echo $_SESSION['remove'];//Displaying Session Message
                    unset($_SESSION['remove']);//Removing session Message
                    }
                    if(isset($_SESSION['delete']))
                    {
                    echo $_SESSION['delete'];//Displaying Session Message
                    unset($_SESSION['delete']);//Removing session Message
                    }
                    if(isset($_SESSION['no-category-found']))
                    {
                    echo $_SESSION['no-category-found'];//Displaying Session Message
                    unset($_SESSION['no-category-found']);//Removing session Message
                    }
                    if(isset($_SESSION['update']))
                    {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['uplode']))
                    {
                    echo $_SESSION['uplode'];
                    unset($_SESSION['uplode']);
                    }
                    if(isset($_SESSION['failed-remove']))
                    {
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);
                    }
                ?>
                <br><br>
                <!--Button to Add Admin -->
                <a href="<?php echo SITEURL; ?>admin/add-category.php"class="btn-primary">Add Category</a>

                <br /><br /> <br />
                <table  class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        //Query to get all category from database
                        $sql = "SELECT * FROM tbl_category";

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
                                $image_name = $row['image_name'];
                                $active = $row['active'];

                                ?>
                                <tr>
                                    <td> <?php echo $sn++; ?> </td>
                                    <td> <?php echo $title; ?> </td>
                                    
                                    <td>
                                        <?php 

                                            //check weather image name is available or not
                                            if($image_name!="")
                                            {
                                                //Display the image
                                                ?>

                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
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
                                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Ubdate Category</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?> " class="btn-danger">Delete Category</a>
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
                                <td colspan="6"><div class="error">No Category Added.</div></td>
                            </tr>

                            <?php
                        }
                    ?>

                   
                        
                
                </table>
                
            </div>
        </div>
        <!--Main Content Section End-->

<?php include('partials/footer.php');?>