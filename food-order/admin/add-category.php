<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php
             if(isset($_SESSION['add']))
             {
                echo $_SESSION['add'];//Displaying Session Message
                unset($_SESSION['add']);//Removing session Message
             }
             if(isset($_SESSION['uplode']))
             {
                echo $_SESSION['uplode'];//Displaying Session Message
                unset($_SESSION['uplode']);//Removing session Message
             }
        ?>
        <br><br>
        <!--Add Category form start-->
        <form action=""method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text"name="title"placeholder="category title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file"name="image">
                    </td>
                </tr>
                
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio"name="active"value="Yes">Yes
                        <input type="radio"name="active"value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit"name="submit"value="Add Category"class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <!--Add Category form End-->

        <?php
            //Check Whether the submit button click or not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1.Get the Value From Category Form
                $title=$_POST['title'];

                //For Radio input,we need to check whether the button is selected or not
               
                if(isset($_POST['active'])) 
                {
                    //Get the Value From Form
                    $active=$_POST['active'];
                }
                else
                {
                    //Set the Default Value
                    $active="No";
                }

                //Check Whether the image is selected or not set the value for image name accoridingly
                //print_r($_FILES['image']);

                //die();
                if(isset($_FILES['image']['name']))
                {
                    $image_name=$_FILES['image']['name'];

                    if($image_name != "")
                    {

                    
                        

                        //Auto Rename our Image
                        //Get the Extension of our image(jpg,png,gif,ect..)e.g. "specialfood1.jpg"
                        $ext = end(explode('.',$image_name));
    
                        //Rename the image
                        $image_name = "Food_Category_".rand(000,999).'.'.$ext;//e.g. Food_Category_834.jpg
                        
                        $source_path=$_FILES['image']['tmp_name'];

                        $destination_path="../images/category/".$image_name;

                        //finally Uplode the image
                        $uplode_name = move_uploaded_file($source_path,$destination_path);

                        //check whether image is uplode or not
                        //And if the image not uplode redirect with error message

                        if($uplode_name==false)
                        {
                            //set message
                            $_SESSION['uplode'] = "<div class='error'>Failed to uplode image.</div>";
                            //Redirect to add category page
                            header('location:'.SITEURL.'admin/add-category.php');
                            //Stop the process
                        
                            die();
                        }
                    }
                }
                else
                {
                    $image_name="";
                }

                //2.Create SQl Query to Insert category into Database
                $sql="INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                active='$active'
                ";

                //3.Execute the Query and Save in Database
                $res=mysqli_query($conn,$sql);

                //4.
                if($res==true)
                {
                    $_SESSION['add']="<div class='success'> Category Add Successfully. </div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    $_SESSION['add']="<div class='error'> Failed to Add Category. </div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        ?>
    </div>
</div>



<?php include('partials/footer.php'); ?>