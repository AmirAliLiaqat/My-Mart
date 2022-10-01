<nav class="navbar navbar-expand-lg navbar-light bg-dark header">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <?php
                require_once 'config.php'; 
                $fetch_options = "SELECT * FROM `options`";
                $fetch_options_query = mysqli_query($conn, $fetch_options) or die('Query Failed');

                if(mysqli_num_rows($fetch_options_query) > 0) {
                    while($row = mysqli_fetch_assoc($fetch_options_query)) {
            ?>
            <img src="upload-images/<?php echo $row['site_logo']; ?>">
            <?php
                    }
                }
            ?>
        </a>
        <button class="navbar-toggler bg-white text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-around" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="shop.php">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="contact.php">Contact</a>
                </li>
                <?php if(isset($_SESSION['fname'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="orders.php">Orders</a>
                </li>
                <?php } ?>
            </ul>
            <?php
            
                if(isset($_SESSION['status'])) {
                    if($_SESSION['status'] === 'user') {
                        ?>
                            <div class="icons d-flex">
                                <div class="p-2"><a href="search.php"><i class="fa-solid fa-2x fa-magnifying-glass text-white"></i></a></div><!--p-2-->
                                <div class="p-2">
                                    <?php 
                                        require_once 'config.php';
                                        $fetch_products = "SELECT * FROM `cart`";
                                        $fetch_products_query = mysqli_query($conn, $fetch_products) or die("Query Failed");

                                        $number_of_products_in_cart = mysqli_num_rows($fetch_products_query);
                                    ?>
                                    <a href="cart.php"><i class="fa-solid fa-2x fa-cart-shopping text-white position-relative"></i></a>
                                    <span class="position-absolute translate-middle badge rounded-pill bg-danger"><?php echo $number_of_products_in_cart; ?></span>
                                </div><!--p-2-->
                                <div class="profile dropdown">
                                    <span class="nav-link dropdown-toggle text-white" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-2x fa-circle-user"></i>&nbsp;&nbsp;<?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname']; ?>
                                    </span>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="view_user.php?id=<?php echo $_SESSION['ID']; ?>"><i class="fa-solid fa-user"></i> View Account</a></li>
                                        <li><a class="dropdown-item" href="delete_user.php?id=<?php echo $_SESSION['ID']; ?>"><i class="fa-solid fa-trash"></i> Delete Account</a></li>
                                        <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                                    </ul>
                                </div><!--profile-->
                            </div><!--icons-->
                        <?php
                    } else {
                        ?>
                            <div class="btns">
                                <a class="btn btn-primary" href="login.php" role="button">Login</a>
                                <a class="btn btn-outline-primary" href="register.php" role="button">Register</a>
                            </div><!--btns-->
                        <?php
                    }
                } else {
                    ?>
                        <div class="btns">
                            <a class="btn btn-primary" href="login.php" role="button">Login</a>
                            <a class="btn btn-outline-primary" href="register.php" role="button">Register</a>
                        </div><!--btns-->
                    <?php
                }

            ?>
            
        </div><!--collapse-->
    </div><!--container-->
</nav>