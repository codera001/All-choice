<?php  include('partials/menu.php')?>
   <div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br/>

        <?php 
         if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']); //removing session messsage
         }
         ?>
        <form action="" method="POST">
         <table class="tbl-30">
            <tr>
                <td >Full Name:</td>
                <td><input type="text" name="full_name"
                 placeholder="enter your name"></td>
                 
                
            </tr>
            <tr>
                <td >Username:</td>
                <td><input type="text" name="username" placeholder="Your Username"></td>
                
            </tr>
            <tr>
                <td >Password:</td>
                <td><input type="password" name="password" placeholder="Your Password"></td>
                
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn-secondary"></td>
                
            </tr>
         </table>

        </form>
    </div>
   </div>


<?php include('partials/footer.php') ?>


<?php
// process the value from form and save it in database and check whether the submit button is clicked or not

if(isset($_POST['submit'])){
    // get data from form
    $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $raw_password = md5($_POST['password']);
    $password = mysqli_real_escape_string($conn, $raw_password);
    // SQL Query to save data in the databse
    $sql = "INSERT INTO  tbl_admin SET 
            full_name = '$full_name',
            username = '$username',
            password = '$password'
            ";
    //Execute query and save in database
    
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn)); 
    if($res == TRUE){
        // Create a session variable to display mesage
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
        //  redirect page
        header("location:".SITEURL.'admin/manage-admin.php' );
    } else{
        $_SESSION['ADD'] = "<div class='error'>Failed to Add Admin</div>";
        header("location:".SITEURL.'admin/add-admin.php');
    }
 } 
?>