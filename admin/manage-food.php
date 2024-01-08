<?php include('partials/menu.php'); ?>

<div class="main-content">
      <div class="wrapper">
         <h1>Manage Food</h1>

         <br/>
           <?php
           if(isset($_SESSION['add-food'])){
            echo $_SESSION['add-food'];
            unset ($_SESSION['add-food']);
           }
           if(isset($_SESSION['delete-food'])){
            echo $_SESSION['delete-food'];
            unset ($_SESSION['delete-food']);
           }
           if(isset($_SESSION['update-food'])){
            echo $_SESSION['update-food'];
            unset ($_SESSION['update-food']);
           }
           
            ?>
            <br/>
         <!-- button to add admin -->
         <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">
            Add food
</a>

         <br/>
         <br/>
         <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
           <?php
            $sql = "SELECT * FROM tbl_food";
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
                    $description = $rows['description'];
                    $price = $rows['price'];
                    $image_name = $rows['image_name'];
                    $category_id = $rows['category_id'];
                    $featured = $rows['featured'];
                    $active = $rows['active'];
           ?>
            <tr>
                <td><?php echo $sn++ ?></td>
                <td><?php echo $title?></td>
                <td><?php echo $description?></td>
                <td><?php echo $price?></td>
                <td>
                    <?php 
                // check whether imagename is availaible or not 
                if($image_name ==true){
                    // display the image
                    ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" alt="" width="80px">
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
                <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update</a>
                <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php  echo $id;?>" class="btn-danger">Delete</a>
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