<?php
 include('config/constants.php');
// get id of the admin to be deleted which was passed in the manage admin page
$id = $_GET['id'];  
// create sql query to delete admin
$sql = "DELETE FROM tbl_food WHERE id=$id";
$res = mysqli_query($conn, $sql);
if($res==TRUE){
    $_SESSION['delete-food'] = "<div class='success'>Food Deleted Successfully</div>";
    header('location:'.SITEURL.'admin/manage-food.php' );

}else{
    $_SESSION['delete-food'] = "<div class='error'>Failed to delete Food, Try again later</div>";
    header('location:'.SITEURL.'admin/manage-food.php' );

}
?>