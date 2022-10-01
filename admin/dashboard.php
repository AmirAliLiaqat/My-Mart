<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php require_once 'admin_links.php'; ?>
</head>
<body>

    <?php require_once 'header.php'; ?>

    <?php
        if(!isset($_SESSION['fname'])) {
            header('location: ../login.php');
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
                        <h1>Dashboard</h1></br>
                        <div class="row p-3">
                            <div class="col-lg-3 col-md-3 col-sm-6 mb-3">
                                <div class="inner_content bg-white text-dark text-center dashboard_div p-3">
                                    <?php 
                                        require_once '../config.php';

                                        $fetch_admin_user = "SELECT * FROM `users` WHERE `status` = 'admin'";
                                        $fetch_admin_user_query = mysqli_query($conn, $fetch_admin_user) or die("Query Failed");

                                        $number_of_admin_users = mysqli_num_rows($fetch_admin_user_query);
                                    ?>
                                    <h3>Admin Users</h3> <br>
                                    <h5><?php echo $number_of_admin_users; ?></h5>
                                </div><!--inner_content-->
                            </div><!--col-lg-3-->
                            <div class="col-lg-3 col-md-3 col-sm-6 mb-3">
                                <div class="inner_content bg-white text-dark text-center dashboard_div p-3">
                                    <?php 
                                        $fetch_normal_user = "SELECT * FROM `users` WHERE `status` = 'user'";
                                        $fetch_normal_user_query = mysqli_query($conn, $fetch_normal_user) or die("Query Failed");

                                        $number_of_normal_users = mysqli_num_rows($fetch_normal_user_query);
                                    ?>
                                    <h3>Normal Users</h3> <br>
                                    <h5><?php echo $number_of_normal_users; ?></h5>
                                </div><!--inner_content-->
                            </div><!--col-lg-3-->
                            <div class="col-lg-3 col-md-3 col-sm-6 mb-3">
                                <div class="inner_content bg-white text-dark text-center dashboard_div p-3">
                                    <?php 
                                        $fetch_user = "SELECT * FROM `users`";
                                        $fetch_user_query = mysqli_query($conn, $fetch_user) or die("Query Failed");

                                        $number_of_users = mysqli_num_rows($fetch_user_query);
                                    ?>
                                    <h3>Total Users</h3> <br>
                                    <h5><?php echo $number_of_users; ?></h5>
                                </div><!--inner_content-->
                            </div><!--col-lg-3-->
                            <div class="col-lg-3 col-md-3 col-sm-6 mb-3">
                                <div class="inner_content bg-white text-dark text-center dashboard_div p-3">
                                    <?php 
                                        $fetch_products = "SELECT * FROM `products`";
                                        $fetch_products_query = mysqli_query($conn, $fetch_products) or die("Query Failed");

                                        $number_of_products = mysqli_num_rows($fetch_products_query);
                                    ?>
                                    <h3>Products</h3> <br>
                                    <h5><?php echo $number_of_products; ?></h5>
                                </div><!--inner_content-->
                            </div><!--col-lg-3-->
                            <div class="col-lg-3 col-md-3 col-sm-6 mb-3">
                                <div class="inner_content bg-white text-dark text-center dashboard_div p-3">
                                    <?php 
                                        $fetch_orders = "SELECT * FROM `orders`";
                                        $fetch_orders_query = mysqli_query($conn, $fetch_orders) or die("Query Failed");

                                        $number_of_orders = mysqli_num_rows($fetch_orders_query);
                                    ?>
                                    <h3>Orders</h3> <br>
                                    <h5><?php echo $number_of_orders; ?></h5>
                                </div><!--inner_content-->
                            </div><!--col-lg-3-->
                            <div class="col-lg-3 col-md-3 col-sm-6 mb-3">
                                <div class="inner_content bg-white text-dark text-center dashboard_div p-3">
                                    <?php 
                                        $fetch_messages = "SELECT * FROM `messages`";
                                        $fetch_messages_query = mysqli_query($conn, $fetch_messages) or die("Query Failed");

                                        $number_of_messages = mysqli_num_rows($fetch_messages_query);
                                    ?>
                                    <h3>Messages</h3> <br>
                                    <h5><?php echo $number_of_messages; ?></h5>
                                </div><!--inner_content-->
                            </div><!--col-lg-3-->
                        </div><!--row-->
                    </div><!--col-lg-10-->
                </div><!--row-->
            </div><!--admin_content-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>

</body>
</html>