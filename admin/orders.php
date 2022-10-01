<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <?php require_once 'admin_links.php'; ?>
</head>
<body>

    <?php require_once 'header.php'; ?>
    
    <?php
        if(!isset($_SESSION['fname'])) {
            header('location: ../login.php');
        }

        if(isset($message)) {
            foreach ($message as $message) {
                echo '
                    <div class="message">
                        <span>'.$message.'</span>
                        <i onclick="this.parentElement.remove();">&#10060;</i>
                    </div><!--message-->
                ';
            }
        }
    ?>

    <section class="admin_section section_content">
        <div class="container-fluid">
            <div class="admin_content text-white">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-12" id="admin-menu">
                        <?php require_once 'sidebar.php'; ?>
                    </div><!--col-lg-2-->
                    <div class="col-lg-10 col-md-01 col-sm-12 text-white p-3">
                        <h1>All Orders</h1></br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped text-center fst-italic">
                                <thead class="bg-white text-dark">
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Name</th>
                                        <th>Number</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Payment Method</th>
                                        <th>Your Order</th>
                                        <th>Total Price</th>
                                        <th>Placed on</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                    require_once '../config.php';

                                    if(isset($_POST['delete_message'])) {
                                        $order_id = $_POST['order_id'];

                                        $delete_order = "DELETE FROM `orders` WHERE `id` = '$order_id'";
                                        $delete_order_query = mysqli_query($conn, $delete_order) or die('Query Failed');
                                        if($delete_order_query) {
                                            $message[] = "Order deleted successfully...";
                                        }
                                    }

                                    $sr = 1;

                                    if(isset($_POST['update_message'])) {
                                        $order_id = $_POST['order_id'];
                                        $payment_status = $_POST['payment_status'];

                                        $order_updated = "UPDATE `orders` SET `payment_status`='$payment_status' WHERE `id` = '$order_id'";
                                        $order_updated_query = mysqli_query($conn, $order_updated) or die('Query Failed');
                                        if($order_updated_query) {
                                            $message[] = "Order updated successfully...";
                                        }
                                    }

                                    $select_data = "SELECT * FROM `orders`";
                                    $select_data_query = mysqli_query($conn, $select_data) or die('Query Failed');

                                    if(mysqli_num_rows($select_data_query) > 0) {
                                        while($row = mysqli_fetch_assoc($select_data_query)) {
                                ?>
                                <tbody>
                                    <tr class="text-white">
                                        <td><?php echo $sr++ ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['number']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['payment_method']; ?></td>
                                        <td><?php echo $row['total_products']; ?></td>
                                        <td><?php echo number_format($row['total_price']); ?> Rs/-</td>
                                        <td><?php echo $row['placed_on']; ?></td>
                                        <form action="" method="post">
                                            <td class="d-flex">
                                                <select name="payment_status" class="form-control mb-3">
                                                    <option <?php if($row['payment_status']=='pending') {echo "selected";} ?> value="pending">Pending</option>
                                                    <option <?php if($row['payment_status']=='completed') {echo "selected";} ?> value="completed">Completed</option>
                                                </select>
                                                <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">&nbsp;&nbsp;
                                            </td>
                                            <td>
                                                <button class="btn btn-warning" name="update_message"><i class="fa-solid fa-pen-to-square"></i></button>
                                                <button class="btn btn-danger" onclick="return confirm('are you sure to delete this order?')" name="delete_order"><i class="fa-solid fa-trash"></i></button>
                                            </td>
                                        </form>
                                        
                                    </tr>
                                </tbody>
                                <?php
                                        }
                                    } else { ?>
                                        <tr class="text-center">
                                            <td colspan="6" class="text-danger">No order found.</td>
                                        </tr>
                                    <?php }
                                ?>
                            </table>
                        </div><!--table-responsive-->
                    </div><!--col-lg-10-->
                </div><!--row-->
            </div><!--admin_content-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>

</body>
</html>