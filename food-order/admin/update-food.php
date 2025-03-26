<?php include('partials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Sweet</h1>

            <br><br>

            <?php
                //Check the eather id
                if(isset($_GET['id']))
                {
                    //echo "Geting the data";
                    $id = $_GET['id'];

                    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

                    $res2 = mysqli_query($conn,$sql2);

                    $count = mysqli_num_rows($res2);

                    if($count==1)
                    {
                        $row = mysqli_fetch_assoc($res2);
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $current_category = $row['category_id'];
                        $current_image = $row['image_name'];
                        $active = $row['active'];
                    }
                    else
                    {
                        $_SESSION['no-sweet-found'] = "<div class='error'> Sweet not found.</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }

                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            ?>

        <form action=""method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text"name="title"value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" rows="5"cols="30"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number"name="price"value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                            if($current_image!="")
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/sweet/<?php echo $current_image; ?>" width="100px">
                                <?php

                            }
                            else
                            {
                                echo "<div class='error'> Image not Added.</div>";

                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                $res = mysqli_query($conn,$sql);

                                if($count>0)
                                {
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];

                                        ?>
                                        <option value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php

                                        echo "<option value='$category_id'>$category_title</option>";
                                    }
                                    
                                }
                                else
                                {
                                    echo "<option value='0'>Category Not Available.</option>";
                                }
                            ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio"name="active"value="Yes">Yes
                        
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio"name="active"value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value=" <?php echo $id; ?> ">
                      <input type="submit" name="submit"value="Update Category"class="btn-secondary">
                    </td>
                </tr>
        
            </table>
        </form>
        <?php
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $active = $_POST['active'];

                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    if($image_name !="")
                    {
                        $ext = end(explode('.',$image_name));
    
                        //Rename the image
                        $image_name = "-sweet_Name_".rand(0000,9999).'.'.$ext;//e.g. Food_Category_834.jpg
                        
                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/sweet/".$image_name;

                        //finally Uplode the image
                        $uplode_name = move_uploaded_file($source_path,$destination_path);

                        //check whether image is uplode or not
                        //And if the image not uplode redirect with error message

                        if($uplode_name==false)
                        {
                            //set message
                            $_SESSION['uplode'] = "<div class='error'>Failed to uplode image.</div>";
                            //Redirect to add category page
                            header('location:'.SITEURL.'admin/manage-food.php');
                            //Stop the process
                        
                            die();
                        }
                        if($current_image !="")
                        {
                            $remove_path ="../images/sweet/".$current_image;
                        
                            $remove = unlink($remove_path);

                         if($remove==false)
                            {
                             $_SESSION['failed-remove'] = "<div class='error'> Failed to remove current image. </div>";

                                header('location:'.SITEURL.'admin/manage-food.php');

                             die();
                            }

                            
                        }

                        
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }



                $sql2 = "UPDATE tbl_food SET
                title = '$title',
                price = $price,
                description = '$description',
                image_name = '$image_name',
                category_id = $category_id,
                active = '$active'
                WHERE id=$id
                ";

                $res2 = mysqli_query($conn,$sql2);


                if($res2==true)
                {
                    $_SESSION['update'] = "<div class='success'> Sweet Uplode Successfully.</div>";
                    header('location:'.SITEURL."admin/manage-food.php");
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'> Failed to Sweet Uplode .</div>";
                    header('location:'.SITEURL."admin/manage-food.php");

                }

            }
        ?>
    </div>
</div>



<?php include('partials/footer.php'); ?>