<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br/>

        <?php 
         if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']); //removing session messsage
         }
         ?>

         <?php
         $id = $_GET['id'];

         $sql= "SELECT * FROM tbl_admin WHERE id=$id";
         $res = mysqli_query($conn, $sql);
         if($res==TRUE){
            $count = mysqli_num_rows($res);
            if($count == 1){
               $row = mysqli_fetch_assoc($res);
               $full_name = $row['full_name'];
               $username = $row['username'];
            }else{
                header("location:".SITEURL.'admin/manage-admin.php');
            }
         }
         ?>
        <form action="" method="POST">
         <table class="tbl-30">
            <tr>
                <td >Full Name:</td>
                <td><input type="text" name="full_name"
                 placeholder="enter your name" value="<?php echo $full_name?>"></td>
                 
                
            </tr>
            <tr>
                <td >Username:</td>
                <td><input type="text" name="username" placeholder="Your Username" value="<?php echo $username ?>"></td>
                
            </tr>
        
            <tr>
                <td colspan="2">
                 <input type="hidden" name="id" value="<?php echo $id; ?>">   
                <input type="submit" name="submit" value="Update Admin" class="btn-secondary"></td>
                
            </tr>
         </table>

        </form>
    </div>
   </div>

<?php include('partials/footer.php')?>

<!-- handle update here -->

<?php
if(isset($_POST['submit'])){
    //get all values from form to update
    $id = $_POST['id'];
    $full_name= $_POST['full_name'];
    $username=$_POST['username'];

    $sql = "UPDATE tbl_admin SET
    full_name = '$full_name',
    username = '$username'
    WHERE id= '$id'
    ";

    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    
    if($res==TRUE){
        $_SESSION['update-admin'] = "<div class='success'>Admin Update Successfully</div>";
        header("location:" .SITEURL.'admin/manage-admin.php');
    }else{
        $_SESSION['update-admin'] = "<div class='error'>Failed to Update Admin</div>";
        header("location:" .SITEURL.'admin/manage-admin.php');

    }
}
?>



