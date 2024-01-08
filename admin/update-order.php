<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update order</h1>

        <br />


        <?php
        $id = $_GET['id'];

        $sql = "SELECT * FROM tbl_order WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if ($res == TRUE) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $rows = mysqli_fetch_assoc($res);
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
            } else {
                header("location:" . SITEURL . 'admin/manage-order.php');
            }
        }
        ?>





        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>
                        Food Name:
                    </td>
                    <td>
                        <input type="text" name="food" placeholder="order name" value="<?php echo $food; ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        Qty:
                    </td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        Status
                    </td>

                    <td>
                    <select name="status">
                        <option value="Ordered">Ordered</option>
                        <option value="On Delivery">On Delivery</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                    </td>
                    
                </tr>

                <tr>
                    <td>
                        Customer Name:
                    </td>
                    <td>
                        <input type="text" name="customer_name" placeholder="customer name"
                            value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Customer Contact:
                    </td>
                    <td>
                        <input type="text" name="customer_contact" placeholder="customer contact"
                            value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Customer Email:
                    </td>
                    <td>
                        <input type="text" name="customer_email" placeholder="customer email"
                            value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Customer Address:
                    </td>
                    <td>
                        <input type="text" name="customer_address" placeholder="customer address"
                            value="<?php echo $customer_address; ?>">
                    </td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update order" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>



    </div>
</div>



<!-- handle update here -->

<?php
if (isset($_POST['submit'])) {
    //get all values from form to update
    $id = $_POST['id'];
    $food = mysqli_real_escape_string($conn, $_POST['food']);
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);
    $total = $price * $qty;
    $order_date = date("Y-m-d h:i:s");
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $customer_name = mysqli_real_escape_string($conn,$_POST['customer_name']);
    $customer_contact = mysqli_real_escape_string($conn,$_POST['customer_contact']);
    $customer_email = mysqli_real_escape_string($conn,$_POST['customer_email']);
    $customer_address = mysqli_real_escape_string($conn,$_POST['customer_address']);

    $sql2 = "UPDATE tbl_order SET 
    food = '$food',
    price = '$price',
    qty = '$qty',
    total = '$total',
    order_date = '$order_date',
    status = '$status',
    customer_name = '$customer_name',
    customer_contact = '$customer_contact',
    customer_email = '$customer_email',
    customer_address = '$customer_address'
    WHERE id= '$id'";
    


    $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

    if ($res2 == TRUE) {
        $_SESSION['update-order'] = "<div class='success'>Order Updated Successfully</div>";
        header("location:" . SITEURL . 'admin/manage-order.php');

    } else {
        $_SESSION['update-order'] = "<div class='error'>Failed to Update Order</div>";
        header("location:" . SITEURL . 'admin/manage-order.php');

    }
}
?>
<?php include('partials/footer.php'); ?>