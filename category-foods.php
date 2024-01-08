<?php include('partials-front/menu.php') ?>




    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
        <?php
if(isset($_GET['category_id'])){
    // category id is set and get the id
    $category_id = $_GET['category_id'];
    
    // get the category title based on category id
    $sql = "SELECT title FROM tbl_category WHERE id = '$category_id'";
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($res);
    $category_title = $row['title'];
    
?>
    <h2>Foods on <a href="#" class="text-white">"<?php echo  $category_title;?>"</a></h2>
<?php
}else{
    header("location:" .SITEURL);
}

?> 

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
          <?php
          $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";
          
          $res2 = mysqli_query($conn, $sql2);
          $count2 = mysqli_num_rows($res2);
          if($count2 > 0){
             while($row2 = mysqli_fetch_assoc($res2)){
                $id = $row2['id'];
             $title = $row2['title'];
             $description = $row2['description'];
             $price = $row2['price'];
             $image_name = $row2['image_name'];
?>
<div class="food-menu-box">
                <div class="food-menu-img">
                <?php
            if($image_name == ""){
                echo "<div class= 'error'>Image not found</div>";
            }else{
                ?>
                <!-- even when not featured  but active shows here -->
                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

                <?php
            }
            
            ?>
                   
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="food-price"><?php echo $price;?></p>
                    <p class="food-detail">
                       <?php echo $description;?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                </div>
                
            </div>
                
<?php

                }
          }else{
            echo "<div class='error'>Food not availaible</div>";
          }
          
          ?>
            

        
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php')?>
