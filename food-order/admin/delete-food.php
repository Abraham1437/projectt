<?php
    include('../config/constants.php');

    //check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get The value Deleted
        //echo "value and delete";

        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the Physical image file is available
        if($image_name !="")
        {
            $path="../images/sweet/".$image_name;

            //remove the image
            $remove=unlink($path);

            //Failed to remove image 
            if($remove==false)
            {
                $_SESSION['remove']="<div class='error'> Failed to Remove Sweet. </div>";

                header('location:'.SITEURL.'admin/manage-food.php');

                die();
            }
        }


        //Delete Data from Database
        $sql = "DELETE FROM tbl_food WHERE id=$id";


        $res = mysqli_query($conn,$sql);

        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'> Sweet Deleted Success. </div>";

            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'> Failed to Deleted Sweet. </div>";

            header('location:'.SITEURL.'admin/manage-food.php');
        }

       
    }
    else
    {
        //Redirect to manage category
        header('location:'.SITEURL.'admin/manage-food.php');

    }

?>