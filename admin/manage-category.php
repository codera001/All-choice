<?php include('partials/menu.php'); ?>

<div class="main-content">
      <div class="wrapper">
         <h1>Manage Category</h1>

         <br/>
           <?php
           if(isset($_SESSION['add-category'])){
            echo $_SESSION['add-category'];
            unset ($_SESSION['add-category']);
           }
           if(isset($_SESSION['delete-category'])){
            echo $_SESSION['delete-category'];
            unset ($_SESSION['delete-category']);
           }
           if(isset($_SESSION['update-category'])){
            echo $_SESSION['update-category'];
            unset ($_SESSION['update-category']);
           }
           
            ?>
            <br/>
         <!-- button to add admin -->
         <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">
            Add Category
</a>

         <br/>
         <br/>
         <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
           <?php
            $sql = "SELECT * FROM tbl_category";
            // execute the query
            $res = mysqli_query($conn, $sql);
            // check whether the query has been executed or not
            if($res==TRUE){
            // count rows to check if we have the data in the database or not
              $count =mysqli_num_rows($res); //function to get data
             $sn = 1; //variable created is used to handle id delete
              if($count > 0){
                while($rows =mysqli_fetch_assoc($res)){
                    // while we have data in the database get individual data
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $image_name = $rows['image_name'];
                    $featured = $rows['featured'];
                    $active = $rows['active'];
           ?>
            <tr>
                <td><?php echo $sn++ ?></td>
                <td><?php echo $title?></td>
                <td>
                    <?php 
                // check whether imagename is availaible or not 
                if($image_name ==true){
                    // display the image
                    ?>
                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" alt="" width="80px">
                    <?php
                }else{
                    // display message error 
                    echo "<div class='error'>Image not added</div>";
                }
                ?>
                </td>
                <td><?php echo $featured?></td>
                <td><?php echo $active?></td>
                <td>
                <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary">Update</a>
                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php  echo $id;?>" class="btn-danger">Delete</a>
                </td>
                

            </tr>
            <?php  

}
}
}
?>
           
         </table>

      </div>
    </div>
<?php include('partials/footer.php'); ?>