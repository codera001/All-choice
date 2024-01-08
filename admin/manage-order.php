<?php include('partials/menu.php'); ?>

<div class="main-content">
      <div class="wrapper">
         <h1>Manage order</h1>

         <br/>
           <?php
         
           if(isset($_SESSION['delete-order'])){
            echo $_SESSION['delete-order'];
            unset ($_SESSION['delete-order']);
           }
           if(isset($_SESSION['update-order'])){
            echo $_SESSION['update-order'];
            unset ($_SESSION['update-order']);
           }
           
            ?>
            <br/>
         <!-- button to add admin -->
         <!-- <a href="<?php echo SITEURL;?>admin/add-order.php" class="btn-primary">
            Add order
</a> -->

         <br/>
         <br/>
         <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order date</th>
                <th>Status</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
           <?php
            $sql = "SELECT * FROM tbl_order";
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
                    $food = $rows['food'];
                    $price = $rows['price'];
                    $qty = $rows['qty'];
                    $total = $rows['total'];
                    $order_date = $rows['order_date'];
                    $status = $rows['status'];
                    $customer_name = $rows['customer_name'];
                    $customer_contact = $rows['customer_contact'];
                    $customer_email = $rows['customer_email'];
                    $customer_address = $rows['customer_address'];
           ?>
            <tr>
                <td><?php echo $sn++ ?></td>
                <td><?php echo $food?></td>
                <td><?php echo $price?></td>
                <td><?php echo $qty?></td>
                <td><?php echo $total?></td>
                <td><?php echo $order_date?></td>
                <td><?php 
                if($status == "Ordered"){
                    echo "<label>$status</label>";
                }elseif($status == "On Delivery"){
                    echo "<label style='color:orange;'>$status</label>";
                }
                elseif($status == "Delivered"){
                    echo "<label style='color:green;'>$status</label>";
                }
                elseif($status == "Cancelled"){
                    echo "<label style='color:red;'>$status</label>";
                }
                ?>
            
            </td>
                <td><?php echo $customer_name?></td>
                <td><?php echo $customer_contact?></td>
                <td><?php echo $customer_email?></td>
                <td><?php echo $customer_address?></td>
                <td>
                <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update</a>
               
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