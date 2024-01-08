
    <?php include('partials/menu.php'); ?>



    <!-- Main section starts -->
    <div class="main-content">
      <div class="wrapper">
         <h1>Manage Admin</h1>

         <br/>
         <?php 
         if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']); //removing session messsage
         }
         if(isset($_SESSION['delete-admin'])){
            echo $_SESSION['delete-admin'];
            unset($_SESSION['delete-admin']); //removing session messsage
         }
         if(isset($_SESSION['update-admin'])){
            echo $_SESSION['update-admin'];
            unset($_SESSION['update-admin']); //removing session messsage
         }
         if(isset($_SESSION['user-not-found'])){
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']); //removing session messsage
         }
       
         if(isset($_SESSION['change-password'])){
            echo $_SESSION['change-password'];
            unset($_SESSION['change-password']); //removing session messsage
         }

         ?>
         <br/>
         <br/>
         <!-- button to add admin -->
         <a href="add-admin.php" class="btn-primary">
            Add Admin
         </a>

         <br/>
         <br/>

         <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
         <?php
            //  sql query to get all details from database 
            $sql = "SELECT * FROM tbl_admin";
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
                    $full_name = $rows['full_name'];
                    $username = $rows['username'];
           // display value in the table               
        // break the php so you can add html code below  
         ?> 
             <tr>
                <td><?php echo $sn++;?></td>
                <td><?php echo $full_name; ?></td>
                <td><?php echo $username; ?></td>
                <td>
                  <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update</a>
                <!--NOTE: we get data from url through GET method and data from from through POST method -->
                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php  echo $id;?>" class="btn-danger">Delete</a>
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
    <!-- Main section ends -->



  <?php include('partials/footer.php'); ?>
