<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin </h1>
        <br><br>

        <?php
            //1. Get id for Selected Admin
            $id=$_GET['id'];

            //2.Create SQl query to Get the Details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //Execute the query
            $res=mysqli_query($conn,$sql);

            //Check Whether the Query is Execute or not
            if($res==true)
            {
                //Check Whether the data is available or not
                $count = mysqli_num_rows($res);
                //Check Wheather we have admin data or not
                if($count==1)
                {
                    //Get the Dedails
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];

                }
                else
                {
                    //Redirect to manage Admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>FullName: </td>
                    <td>
                        <input type="text"name="full_name"value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text"name="username"value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden"name="id"value="<?php echo $id; ?>">
                        <input type="submit"name="submit"value="Update Admin"class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>

</div>
<?php
    //check wheather the submit Button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";
        //Get all the values from form to update
         $id = $_POST['id'];
         $full_name = $_POST['full_name'];
         $username = $_POST['username'];

         //create a SQL Query to Update Admin
         $sql = "UPDATE tbl_admin SET
         full_name = '$full_name',
         username = '$username'
         WHERE id='$id'
         ";

         //Execute the Query
         $res = mysqli_query($conn,$sql);

         //Check Whether the Query Execute Successfully or not
        if($res == TRUE)
        {
            //Query Execute and Admin Updated
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to Update Admin 
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }


    }
?>



<?php include('partials/footer.php'); ?>