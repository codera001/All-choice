<?php  include('partials/menu.php');?>

<?php
   if(isset($_GET['id'])){
    $id = $_GET['id'];
   }
?>



<div class="main-content">
    <div class="wrapper">
       <h1>Update Password</h1> 
       <br>
       <?php 
  if(isset($_SESSION['pwd-not-match'])){
    echo $_SESSION['pwd-not-match'];
    unset($_SESSION['pwd-not-match']); //removing session messsage
 }
?>
<br/>
       <form action="" method="POST">
        <table>
            <tr>
                <td>
                  Current Password:
                </td>
                <td>
                    <input type="password" name="current_password">
                </td>
            </tr>

            <tr>
                <td>
                    New Password:
                </td>
                <td>
                    <input type="text" name="new_password" >
                </td>
            </tr>

            <tr>
                <td>
                    Confirm Password
                </td>
                <td>
                    <input type="text" name="confirm_password" >
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                   <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                </td>
            </tr>
        </table>
       </form>
    </div>
</div>


<?php  include('partials/footer.php');?>

<?php 
   if(isset($_POST['submit'])){
       $id = $_POST['id'];
       $current_pass= md5($_POST['current_password']);
       $current_password = mysqli_real_escape_string($conn, $current_pass);
       $new_pass = md5($_POST['new_password']);
       $new_password = mysqli_real_escape_string($conn, $new_pass);
       $confirm_pass = md5($_POST['confirm_password']);
       $confirm_password = mysqli_real_escape_string($conn, $confirm_pass);

       $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_password'";

       $res = mysqli_query($conn, $sql) or die (mysqli_error($conn));

       if($res==TRUE ){
        $count = mysqli_num_rows($res);
        if($count == 1 ){
           // check whether the new password and confirm match
           if($new_password == $confirm_password) {
            // update password
            $sql2 = "UPDATE tbl_admin SET password = '$new_password' WHERE id = $id" ;

            $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

        if($res2 == TRUE){
            $_SESSION['change-password'] = "<div class='success'>Password changed successfully</div>";
              header("location:" .SITEURL.'admin/manage-admin.php');
        }else{
            $_SESSION['change-password'] = "<div class='error'>Failed to change password</div>";
              header("location:" .SITEURL.'admin/manage-admin.php');
        }
           }else{
              $_SESSION['pwd-not-match'] = "<div class='error'>Password did not match</div>";
            //   header("location:" .SITEURL.'admin/manage-admin.php');
           }

        } else{
            $_SESSION['user-not-found'] = "<div class='error'> User not found</div>";
            header("location:" .SITEURL.'admin/manage-admin.php');

        }
       }
   }
?>