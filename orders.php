<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <?php require_once 'links.php'; ?>
</head>
<body>

    <?php require_once 'header.php'; ?>

    <section class="banner p-3">
        <div class="container text-center text-white p-5">
            <h1>Orders</h1>
            <div class="links">
                <a href="index.php" class="nav-link d-inline">Home</a> / <span>&nbsp;&nbsp; Orders</span>
            </div><!--links-->
        </div><!--container-->
    </section>

    <section>
        <div class="container py-5">
            <div class="row">
                <?php
                
                    require_once 'config.php';
                    $user_id = $_SESSION['ID'];

                    $select_data = "SELECT * FROM `orders` WHERE `user_id` = '$user_id'";
                    $select_data_query = mysqli_query($conn, $select_data) or die('Query Failed');

                    if(mysqli_num_rows($select_data_query) > 0) {
                        while($row = mysqli_fetch_assoc($select_data_query)) {      
                
                ?>
                <div class="col-lg-4 col-md-4 col-sm-8 mb-3">
                    <div class="inner_content bg-white text-dark dashboard_div p-3">
                        <p>Name: <span class="text-danger"><?php echo $row['name']; ?></span></p>
                        <p>Number: <span class="text-danger"><?php echo $row['number']; ?></span></p>
                        <p>Email: <span class="text-danger"><?php echo $row['email']; ?></span></p>
                        <p>Address: <span class="text-danger"><?php echo $row['address']; ?></span></p>
                        <p>Payment Method: <span class="text-danger"><?php echo $row['payment_method']; ?></span></p>
                        <p>Your Order: <span class="text-danger"><?php echo $row['total_products']; ?></span></p>
                        <p>Total Price: <span class="text-danger"><?php echo number_format($row['total_price']); ?> Rs/-</span></p>
                        <p>Placed on: <span class="text-danger"><?php echo $row['placed_on']; ?></span></p>
                        <p>Payment Status: <span class="<?php echo ($row['payment_status'] == 'completed') ? 'text-success' : 'text-danger'; ?>"><?php echo $row['payment_status']; ?></span></p>
                    </div><!--inner_content-->
                </div><!--col-lg-4-->
                <?php
                        }
                    } else { ?>
                        <div class="text-center bg-white text-danger p-3">no order found...</div>
                    <?php }
                ?>
            </div><!--row-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>

</body>
</html>