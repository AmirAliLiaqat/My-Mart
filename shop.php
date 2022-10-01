<?php session_start(); ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <?php require_once 'links.php'; ?>
</head>
<body>

    <?php require_once 'header.php'; ?>

    <section class="banner p-3">
        <div class="container text-center text-white p-5">
            <h1>Shop</h1>
            <div class="links">
                <a href="index.php" class="nav-link d-inline">Home</a> / <span>&nbsp;&nbsp; Shop</span>
            </div><!--links-->
        </div><!--container-->
    </section>

    <section>
        <!----------------- Products -------------------->
        <div class="container products_container pt-5">
            <h1 class="text-center text-white my-4">Latest Products</h1>
            <div class="row">
                <?php
                
                    require_once 'config.php';

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
                                header('location: shop.php');
                            }
                        }

                    }

                    $fetch_products = "SELECT * FROM `products` WHERE `product_status` = 'publish'";
                    $fetch_products_query = mysqli_query($conn, $fetch_products) or die('Query Failed');

                    if(mysqli_num_rows($fetch_products_query) > 0) {
                        while($row = mysqli_fetch_assoc($fetch_products_query)) {
                
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
                <div class="col-lg-4  col-md-4 col-sm-6 mb-3">
                    <div class="inner_content bg-white text-dark text-center dashboard_div p-3">
                        <!-- <div class="position-absolute p-3 bg-danger text-white sale_box">sale</div> -->
                        <img src="upload-images/<?php echo $row['product_img']; ?>">
                        <div class="title mt-3"><?php echo $row['name']; ?></div>
                        <div class="price text-danger"><?php echo number_format($row['price']); ?> <?php echo $row['currency']; ?>/-</div>
                        <a href="view_product.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-lg mt-3"><i class="fa-solid fa-eye"></i></a>
                        <?php if(isset($_SESSION['fname'])) { ?>
                        <a href="shop.php?id=<?php echo $row['id']; ?>&product_img=<?php echo $row['product_img']; ?>&name=<?php echo $row['name']; ?>&price=<?php echo $row['price']; ?>" class="btn btn-primary btn-lg mt-3"><i class="fa-solid fa-cart-shopping"></i></a>
                        <?php } ?>
                    </div><!--inner_content-->
                </div><!--col-lg-4-->
                <?php
                        }
                    } else { ?>
                        <div class="text-center bg-white text-danger p-3">no product found...</div>
                    <?php }
                ?>
            </div><!--row-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>

</body>
</html>