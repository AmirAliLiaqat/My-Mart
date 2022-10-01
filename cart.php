<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <?php require_once 'links.php'; ?>
</head>
<body>

    <?php require_once 'header.php'; ?>

    <?php 
        require_once 'config.php';
    
        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            $delete_from_cart = "DELETE FROM `cart` WHERE `id` = '$id'";
            $delete_from_cart_query = mysqli_query($conn, $delete_from_cart) or die("Query Failed");
            if($delete_from_cart_query) {
                header('location: cart.php');
            }
        }

        if(isset($_GET['delete_all'])) {

            $delete_all_from_cart = "DELETE FROM `cart`";
            $delete_all_from_cart_query = mysqli_query($conn, $delete_all_from_cart) or die("Query Failed");
            if($delete_all_from_cart_query) {
                header('location: cart.php');
            }
        }
    
    ?>

    <section class="admin_section section_content">
        <div class="container p-4">
            <div class="admin_content text-white">
                <h1 class="text-center">My Cart</h1></br>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped text-center fst-italic">
                        <thead class="bg-white text-dark">
                            <tr>
                                <th>Sn#</th>
                                <th>Product Img</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Qty.</th>
                                <th>Sub Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                        
                            require_once 'config.php';

                            error_reporting(0);

                            $grand_total = 0;
                            $select_data = "SELECT * FROM `cart`";
                            $select_data_query = mysqli_query($conn, $select_data) or die('Query Failed');
                            $sn = 1;

                            if(mysqli_num_rows($select_data_query) > 0) {
                                while($row = mysqli_fetch_assoc($select_data_query)) {
                                    $sub_total = $row['price'] *  $row['quantity'];
                                    $grand_total += $sub_total;
                        
                        ?>
                        <tbody>
                            <tr class="text-white">
                                <td><?php echo $sn++ ?></td>
                                <td>
                                    <?php
                                        if($row['product_img']!="") { 
                                            ?>
                                                <img src="upload-images/<?php echo $row['product_img']; ?>" width="100" height="10%">
                                            <?php
                                        } else {
                                            echo "No image added";
                                        }
                                    ?>
                                </td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo number_format($row['price']); ?> Rs/-</td>
                                <?php 
                                    if(isset($_POST['update_quantity'])) {
                                        $product_quantity = $_POST['product_quantity'];
                                        $update_quantity = "UPDATE `cart` SET `quantity`='$product_quantity'";
                                        $update_quantity_query = mysqli_query($conn, $update_quantity) or die("Query Failed");
                                        header('location: cart.php');
                                    }
                                ?>
                                <td class="d-flex justify-content-center">
                                    <form action="" method="post">
                                        <input type="number" class="form-control" name="product_quantity" value="<?php echo $row['quantity']; ?>">
                                        <button type="submit" name="update_quantity" class="btn btn-warning mt-2">Update</button>
                                    </form>
                                </td>
                                <td><?php echo number_format($sub_total); ?> Rs/-</td>
                                <td class="">
                                    <a class="btn btn-danger" href="cart.php?id=<?php echo $row['id']; ?>" role="button"><i class="fa-solid fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                        </tbody>
                        <?php
                                }
                            } else { ?>
                                <tr class="text-center text-white">
                                    <td colspan="7">your cart is empty</td>
                                </tr>
                            <?php }
                        ?>
                        <tr class="text-white">
                            <td colspan="5" class="text-end">Total Amount : &nbsp;&nbsp;</td>
                            <td><?php echo number_format($grand_total); ?> Rs/-</td>
                            <td><a class="btn btn-danger <?php echo ($grand_total > 1)?'':'disabled'; ?>" href="cart.php?delete_all=delete" role="button"><i class="fa-solid fa-trash"></i> Delete All</a></td>
                        </tr>
                    </table>
                </div><!--table-responsive-->
                <h2 class="d-flex justify-content-between">
                    <a href="shop.php" class="btn btn-primary">Continue Shopping</a>
                    <a href="checkout.php" class="btn btn-success <?php echo ($grand_total > 1)?'':'disabled'; ?>">Proceed to Checkout</a>
                </h2>
            </div><!--admin_content-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>
        
</body>
</html>