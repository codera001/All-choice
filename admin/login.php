<?php include('config/constants.php');?>
<html lang="en">
<head>
    <title>All Choice sharwarma and pizza</title>
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">
            Login
        </h1>
     <br/>
     <?php
       if(isset($_SESSION['login-message'])){
        echo $_SESSION['login-message'];
        unset($_SESSION['login-message']);
       }
       if(isset($_SESSION['no-login-message'])){
        echo $_SESSION['no-login-message'];
        unset($_SESSION['no-login-message']);
       }
      
     ?>
     <br/>

        <form action="" method="POST" class="text-center">
        Username:
        <input type="text" name="username" placeholder="enter your username">
        <br/>
        Password:
        <input type="password" name="password" placeholder="enter your password">
       <br/>
        <input type="submit" value="Login" class="btn-primary" name="submit">
        <br/>
        </form>
        <p class="text-center">Created by - <a href="#">Nwoye Vera</a></p>
    </div>


    <?php
    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);


        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'"  ;
        $res= mysqli_query($conn, $sql) or die(mysqli_error($conn));     
            $count = mysqli_num_rows($res);
            if($count == 1 ) {
                // $_SESSION['login-message'] = "<div class='error'>Login success</div>";
                $_SESSION['user'] = $username; //To check whether user is logged in or not and logout will unset it
              header("location:" .SITEURL.'admin/index.php');
            } else{
                $_SESSION['login-message'] = "<div class='error text-center'>Invalid Login details</div>";

            }
        
    }
    
    ?>
</body>
</html>