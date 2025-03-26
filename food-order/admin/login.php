<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login - Sweet order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>
            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>
            <!-- Login form start hear -->
             <form action=""method="POST" class="text-center">
                Username: <br>
                <input type="text"name="username"placeholder="Enter User Name"><br><br>
                Paassword: <br>
                <input type="password"name="password"placeholder="Enter Password"> <br> <br>

                <input type="submit" name="submit" value="Login"class="btn-primary">

                <br><br>

             </form>


            <!-- Login form End hear -->

            <p class="text-center">Created By - <a href="www.bombatsweet.com">Bombay Sweets</a></p>
        </div>    

    </body>
</html>
<?php
    if(isset($_POST['submit']))
    {
        //check whether sub btn click or not
        //1.get the data from login form
        $username=$_POST['username'];
        $password=md5($_POST['password']);

        //2. SQL to check Whether
        $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute the Query
        $res=mysqli_query($conn,$sql);

        //4.Count row to check whether the user exit or not
        $count=mysqli_num_rows($res);

        if($count==1)
        {
            //user available and login Success
            $_SESSION['login']="<div class='success'>Login Success.</div>";
            $_SESSION['user']=$username; //To check the user is logged in or not and logout will unset it

            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //User not available to fail
            $_SESSION['login']="<div class='error text-center'>Username or Password Did not Match.</div>";

            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>