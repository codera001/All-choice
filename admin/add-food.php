<?php include('partials/menu.php');?>

    <div class="main-content">
        <div class="wrapper">
          <h1>Add Food</h1>  
          <br/>
         <?php if(isset($_SESSION['upload'])){
               echo $_SESSION['upload'];
               unset($_SESSION['upload']);
         
         }?>

         <br/>
         <br/>
          <!-- add category starts here -->
         <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
               <tr>
                <td>
                    Title:
                </td>
                <td>
          <input type="text" name="title" placeholder="Title of the food">
                </td>
               </tr>
               <tr>
                <td>
                    Description:
                </td>
                <td>
                    <textarea name="description" id="" cols="30" rows="5" placeholder="Description of food"></textarea>
                </td>
               </tr>

               <tr>
                <td>
                    Price:
                </td>
                <td>
                    <input type="number" name="price">
                </td>
               </tr>
               <tr>
                <td>
                    Select Image:
                </td>
                <td>
          <input type="file" name="image" placeholder="Category title" accept="image/jpg, image/jpeg, image/png">
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
                              $id = $row['id'];
                              $title = $row['title'];
                              ?>
                              <option value="<?php echo $id ;?>"><?php echo $title;?></option>
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
                    <input type="radio" name="featured" value="Yes"> Yes
                    <input type="radio" name="featured" value="No"> No
                </td>
               </tr>

               <tr>
                 <td>
                    Active:
                 </td>
                 <td>
                    <input type="radio" name="active" value="Yes"> Yes
                    <input type="radio" name="active" value="No">No
                 </td>
               </tr>

               <tr>
                <td colspan="2">
                   <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                </td>
               </tr>
            </table>

         </form>
  


         <?php 
         if(isset($_POST['submit'])){
          $title = mysqli_real_escape_string($conn, $_POST['title']);
          $description = mysqli_real_escape_string($conn, $_POST['description']);
          $price = mysqli_real_escape_string($conn, $_POST['price']);
          $category = mysqli_real_escape_string($conn, $_POST['category']);
          // $image_name =$_FILES['image'];

        //   for radio button, we have to check if the value has been selected or not
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
                  if($image_name != ""){
                // Autorename image
                // get the( extension of image
                $tmp = explode('.', $image_name);
                $ext = end($tmp);

                // rename image
                $image_name = "Food_category_" .rand(000,999).'.' .$ext;
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = '../images/food/'.$image_name;
                // upload image 
                $upload = move_uploaded_file($source_path, $destination_path) or die();
                
                // check whether the image is uploaded or not and if the image is not uploaded we will stop the process and redirect with error message
                if($upload == false){
                  $_SESSION['upload'] = "<div class='error'>Failed to upload</div>";
                  header('location:'.SITEURL. 'admin/add-category.php');
                  die();
                }
              }
            }else{
                // don't upload image and set the image name value as null
                $image_name ="";
            }

          $sql = "INSERT INTO tbl_food SET
          title = '$title',
          description = '$description',
          price = '$price',
          image_name ='$image_name',
          category_id = '$category',
          featured = '$featured',
          active = '$active'
          ";

          $res = mysqli_query($conn, $sql) 
          or die(mysqli_error($conn));

          if($res == TRUE){
            $_SESSION['add-food'] = "<div class='success'>
             Food added successfully
            </div>";
            header("location:".SITEURL.'admin/manage-food.php');
          }else{
            $_SESSION['add-food'] = "<div class= 'error'>Failed to add food</div>";
          }



         }
         ?>


          <!-- add category ends here -->
        </div>
    </div>










<?php include('partials/footer.php'); ?>