<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update food</h1>

        <br/>


         <?php
         $id = $_GET['id'];

         $sql= "SELECT * FROM tbl_food WHERE id=$id";
         $res = mysqli_query($conn, $sql);
         if($res==TRUE){
            $count = mysqli_num_rows($res);
            if($count == 1){
               $row = mysqli_fetch_assoc($res);
               $title = $row['title'];
               $description = $row['description'];
               $price = $row['price'];
               $current_image = $row['image_name'];
               $category = $row['category_id'];
               $featured  = $row['featured'];
               $active = $row['active'];
            }else{
                header("location:".SITEURL.'admin/manage-food.php');
            }
         }
         ?>
      




        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
               <tr>
                <td>
                    Title:
                </td>
                <td>
          <input type="text" name="title" placeholder="food title" value="<?php echo $title;?>">
                </td>
               </tr>

               <tr>
                <td>
                    Description:
                </td>
                <td>
          <input type="text" name="description" placeholder="food description" value="<?php echo $description;?>">
                </td>
               </tr>
               <tr>

                <td>
                    Price:
                </td>
                <td>
          <input type="number" name="price" placeholder="food price" value="<?php echo $price;?>">
                </td>
               </tr>
               <tr>

                <td>
                    Current Image:
                </td>
                <td>
                    <?php 
                   if($current_image != "") {
            //    display the image
                    ?>
            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image;?>" alt="" width="100px">

                   <?php
                   }else{
                   
                    echo "<div class='error'>Image not Added</div>";
                   }
                   ?>
             
                </td>
               </tr>

               <tr>
                <td>
                    New Image:
                </td>
                <td>
          <input type="file" name="image" placeholder= "food title" accept="image/jpg, image/jpeg, image/png">
                </td>
               </tr>

               <tr>
                <td>
                    Category:
                </td>

                <td>
                    <select name="category" >
                        <?php
                        // create PHP code to display categories from database
                        // create SQL to get all active categories from database
                        $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' ";
                        $res = mysqli_query($conn, $sql);
                        if($res == TRUE){
                          $count =mysqli_num_rows($res);
                          if($count > 0){
                            while($row = mysqli_fetch_assoc($res)){
                              $category_id = $row['id'];
                              $category_title = $row['title'];
                              ?>
                              <option value="<?php echo $category_id ;?>"><?php echo $category_title;?></option>
                              <?php  
                            }
                          }else{
                            ?>
                            <option value="0">No category found</option>
                            <?php
                          }
                        }
                        ?>
                       
                    </select>
                </td>
              </tr>

               <tr>
                <td>
                  Featured:
                </td>
                <td>
                    <input <?php if($featured == "Yes"){echo "checked";}?>   type="radio" name="featured" value="Yes"> Yes
                    <input <?php if($featured == "No"){echo "checked";}?> type="radio" name="featured" value="No"> No
                </td>
               </tr>

               <tr>
                 <td>
                    Active:
                 </td>
                 <td>
                    <input <?php if($active == "Yes"){echo "checked";}?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($active == "No"){echo "checked";}?> type="radio" name="active" value="No">No
                 </td>
               </tr>

               <tr>
                <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>"> 
                   <input type="submit" name="submit" value="Update food" class="btn-secondary">
                </td>
               </tr>
            </table>

         </form>
  


    </div>
   </div>



<!-- handle update here -->

<?php
if(isset($_POST['submit'])){
    //get all values from form to update
    $id = $_POST['id'];
    $title= mysqli_real_escape_string($conn, $_POST['title']);
    if(isset($_POST['featured'])){
        $featured = $_POST['featured'];

      }else{
        $featured = "No";
      }
       
      if(isset($_POST['active'])){
      $active = $_POST['active'];
        
      }else{
        $active = "No";
      }

      //check whether the image is selected or not and set the value for the image accordingly
        // print_r($_FILES['image']);
         //break the code here
    //    To upload image we need image name, source path and destination path
        if(isset($_FILES['image']['name'])){
            $image_name = $_FILES['image']['name'];
            if($image_name != ''){
            // Autorename image
            // get the( extension of image
            $tmp = explode('.', $image_name);
            $ext = end($tmp);

            // rename image
            $image_name = "Food_food_" .rand(000,999).'.' .$ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = '../images/food/'.$image_name;
            // upload image 
            $upload = move_uploaded_file($source_path, $destination_path) or die();
            
            // check whether the image is uploaded or not and if the image is not uploaded we will stop the process and redirect with error message
            if($upload == false){
              $_SESSION['upload'] = "<div class='error'>Failed to upload</div>";
              header('location:'.SITEURL. 'admin/add-food.php');
              die();
            }
            

            // remove current image
            $remove_path = "../images/category/".$current_image;
            $remove = unlink($remove_path);
            // check whether image is removed and if removed or not 
            // if failed to remove then display message and stop the process
            if($remove == false ){
                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                die(); //stop the process 
            }
        }else{
            $image_name = $current_image;
        }
        }else{
            // don't upload image and set the image name value as null
            $image_name = $current_image;
        }

    $sql3 = "UPDATE tbl_food SET
    title ='$title',
    description = '$description',
    price = '$price',
    image_name = '$image_name',
    category_id = '$category',
    featured = '$featured',
    active = '$active'
    WHERE id= '$id'
    ";

    $res3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
    
    if($res3 == TRUE){
        $_SESSION['update-food'] = "<div class='success'>Food Updated Successfully</div>";
        header("location:" .SITEURL.'admin/manage-food.php');

    }else{
        $_SESSION['update-food'] = "<div class='error'>Failed to Update food</div>";
        header("location:" .SITEURL.'admin/manage-food.php');

    }
}
?>

<?php include('partials/footer.php');?>





