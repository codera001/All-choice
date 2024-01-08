<?php
 include('config/constants.php');
// get id of the admin to be deleted which was passed in the manage admin page
$id = $_GET['id'];  
// create sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";
$res = mysqli_query($conn, $sql);
if($res==TRUE){
    $_SESSION['delete-admin'] = "<div class='success'>Admin Deleted Successfully</div>";
    header('location:'.SITEURL.'admin/manage-admin.php' );

}else{
    $_SESSION['delete-admin'] = "<div class='error'>Failed to delete Admin, Try again later</div>";
    header('location:'.SITEURL.'admin/manage-admin.php' );

}
?>