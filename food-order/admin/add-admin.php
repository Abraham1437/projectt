<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br /><br />
        <?php 
            if(isset($_SESSION['add']))//Checking Whether the Session is set of Not
            {
                echo $_SESSION['add'];//Display the Session Message if Set
                unset($_SESSION['add']);//Remove Session Message
            }
        ?>

        <form action=""method="POST">
            <table class="tbl-30">
                <tr>
                    <td>FullName:</td>
                    <td>
                        <input type="text"name="full_name"placeholder="Enter Your Name">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text"name="username"placeholder="Your Username">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password"name="password" placeholder="Your Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="Submit"name="Submit"value="Add Admin"class="btn-secondary">

                    </td>
                </tr>
            </table>
        </form>

    </div>

</div>
<?php include('partials/footer.php');?>
<?php
    //process the value from form and save it in database
    
    //Check Whether the submit button is clicked or not 

    if(isset($_POST['Submit']))
    {
        //Button Clicked 
        //echo "Button Clicked";

        //1.Get the data from Form
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];
        $password=md5($_POST['password']);//Password Encryption With md5

        //2.SQL Query to Save data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'        
        ";

       

        //3.Executing Query and Saving data into Database
        $res = mysqli_query($conn,$sql);

        //4.Check Whether the (Qurey is Executed)data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //Data Inserted
            //echo "Data Inserted";
            //Create a session Variable to Display Message
            $_SESSION['add'] = "Admin Add Successfully";
            //Redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            //Failed to Inserted Data
            //echo "Fail to Insert Data";
            //Create a session Variable to Display Message
            $_SESSION['add'] = "Failed to Add Admin";
            //Redirect page to Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
    
?>