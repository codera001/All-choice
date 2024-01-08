<?php
 include('config/constants.php');
// get id of the admin to be deleted which was passed in the manage admin page
$id = $_GET['id'];  
// create sql query to delete admin
$sql = "DELETE FROM tbl_category WHERE id=$id";
$res = mysqli_query($conn, $sql);
if($res==TRUE){
    $_SESSION['delete-category'] = "<div class='success'>Category Deleted Successfully</div>";
    header('location:'.SITEURL.'admin/manage-category.php' );

}else{
    $_SESSION['delete-category'] = "<div class='error'>Failed to delete Category, Try again later</div>";
    header('location:'.SITEURL.'admin/manage-category.php' );

}
?>