<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <?php require_once 'links.php'; ?>
</head>
<body>

    <?php require_once 'header.php'; ?>

    <section>
        <div class="container">
            <div class="admin_content text-white p-5">
                <?php
                
                    require_once 'config.php';
                    
                    $id = $_GET['id'];
                    
                    error_reporting(0);

                    if(isset($_GET['id']) && isset($_GET['product_img']) && isset($_GET['name']) && isset($_GET['price'])) {
                        $id = $_GET['id'];
                        $user_id = $_SESSION['ID'];
                        $product_img = $_GET['product_img'];
                        $name = $_GET['name'];
                        $price = $_GET['price'];
                        $quantity = '1';

                        $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE `name` = '$name' AND `user_id` = '$user_id'") or die("Query Failed");

                        if(mysqli_num_rows($check_cart_numbers) > 0) {
                            $message[] = "already added to cart!";
                        } else {
                            $add_to_cart = "INSERT INTO `cart`(`user_id`, `product_img`, `name`, `price`, `quantity`) VALUES ('$user_id','$product_img','$name','$price','$quantity')";
                            $add_to_cart_query = mysqli_query($conn, $add_to_cart) or die('Query Failed');
                            if($add_to_cart_query) {
                                header('location: view_product.php'.'?id='.$id);
                            }
                        }

                    }

                    $select_data = "SELECT * FROM `products` WHERE `id` = '$id'";
                    $select_data_query = mysqli_query($conn, $select_data) or die('Query Failed');
                    $sn = 1;

                    if(mysqli_num_rows($select_data_query) > 0) {
                        while($row = mysqli_fetch_assoc($select_data_query)) {
                
                ?>

                <?php
                    if(isset($message)) {
                        foreach ($message as $message) {
                            echo '
                            <div class="message">
                                <span>'.$message.'</span>
                                <i class="fas fa-times fa-2x text-danger" onclick="this.parentElement.remove();"></i>
                            </div><!--message-->
                            ';
                        }
                    }
                ?>

                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                        <?php
                            if($row['product_img']!="") { 
                                ?>
                                    <img src="upload-images/<?php echo $row['product_img']; ?>" width="300">
                                <?php
                            } else {
                                echo "No image added";
                            }
                        ?>
                    </div><!--col-lg-3-->
                    <div class="col-lg-9 col-md-9 col-sm-6 text-white px-5">
                        <?php if($row['sale'] == '0%') { echo ''; } else { ?>
                                <h4 class="bg-success text-white p-3"><?php echo $row['sale']; ?>&nbsp; off</h4>
                        <?php } ?>
                        <h3><?php echo $row['name']; ?></h3>
                        <span style="font-size:24px;"><?php echo number_format($row['price']); ?> <?php echo $row['currency']; ?>/-</span>
                        <p><?php echo $row['product_description']; ?></p>
                        <h2>
                            <a href="shop.php" class="btn btn-success btn-lg">Continue Shopping</a>
                            <?php if(isset($_SESSION['fname'])) { ?>
                            <a href="view_product.php?id=<?php echo $row['id']; ?>&product_img=<?php echo $row['product_img']; ?>&name=<?php echo $row['name']; ?>&price=<?php echo $row['price']; ?>" class="btn btn-primary btn-lg">Add to cart</a>
                            <?php } ?>
                        </h2>
                    </div><!--col-lg-9-->
                </div><!--row-->
                <?php
                        }
                    } else { ?>
                        <tr class="text-center">
                            <td colspan="6">No User Found.</td>
                        </tr>
                    <?php }
                ?>
            </div><!--admin_content-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>

</body>
</html>