<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <?php require_once 'links.php'; ?>
</head>
<body>

    <?php require_once 'header.php'; ?>

    <section class="admin_section section_content">
        <div class="container p-4">
            <div class="admin_content text-white">
                <h1 class="text-center">Checkout</h1></br>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped text-center fst-italic">
                        <thead class="bg-white text-dark">
                            <tr>
                                <th>Sn#</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Qty.</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <?php
                        
                            require_once 'config.php';

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
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo number_format($row['price']); ?> Rs/-</td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo number_format($sub_total); ?> Rs/-</td>
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
                            <td colspan="4" class="text-end">Total Amount : &nbsp;&nbsp;</td>
                            <td><?php echo number_format($grand_total); ?> Rs/-</td>
                        </tr>
                    </table>
                </div><!--table-responsive-->
            </div><!--admin_content-->
            <?php
                if(isset($_POST['place_order'])) {
                    var_dump($_POST);
                    $user_id = $_SESSION['ID'];
                    $username = $_POST['username'];
                    $number = $_POST['number'];
                    $email = $_POST['email'];
                    $payment_method = $_POST['payment_method'];
                    $address = $_POST['house_no'] . ', ' . $_POST['street_no'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . '- ' . $_POST['pin_code'];
                    $placed_on = date('d-M-Y');
            
                    $cart_total = 0;
                    $cart_products[] = '';
            
                    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE 
                    user_id = '$user_id'") or die("Query Failed");
                    if(mysqli_num_rows($cart_query) > 0) {
                        while($cart_item = mysqli_fetch_assoc($cart_query)) {
                            $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
                            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
                            $cart_total += $sub_total;
                        }
                    }

                    $total_products = implode(', ', $cart_products);

                    mysqli_query($conn, "INSERT INTO `orders` (user_id, name, number, email, payment_method, address,
                    total_products, total_price, placed_on) VALUES ('$user_id','$username','$number','$email',
                    '$payment_method','$address','$total_products','$cart_total','$placed_on')" ) or die("Query Failed");
                    $message[] = "order placed successfully";
                    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die("Query Failed");
                }
            ?>
    
            <?php
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

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-10 bg-white text-dark add_items_div p-3">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-10 my-2">
                                <label for="username" class="form-label my-1">Your Name :</label>
                                <input type="text" name="username" class="form-control" placeholder="enter you name">
                            </div><!--col-lg-6-->
                            <div class="col-lg-6 col-md-6 col-sm-10 my-2">
                                <label for="number" class="form-label my-1">Your Number :</label>
                                <input type="number" name="number" class="form-control" placeholder="enter you number">
                            </div><!--col-lg-6-->
                            <div class="col-lg-6 col-md-6 col-sm-10 my-2">
                                <label for="email" class="form-label my-1">Your Email :</label>
                                <input type="email" name="email" class="form-control" placeholder="enter you email">
                            </div><!--col-lg-6-->
                            <div class="col-lg-6 col-md-6 col-sm-10 my-2">
                                <label for="payment_method" class="form-label my-1">Payment Method :</label>
                                <select name="payment_method" class="form-control">
                                    <option value="cash on delivery">cash on delivery</option>
                                    <option value="bank transfer">bank transfer</option>
                                    <option value="credit card">credit card</option>
                                    <option value="paypal">paypal</option>
                                    <option value="jazz cash">jazz cash</option>
                                    <option value="esaypaisa">esaypaisa</option>
                                </select>
                            </div><!--col-lg-6-->
                            <div class="col-lg-6 col-md-6 col-sm-10 my-2">
                                <label for="house_no" class="form-label my-1">Address line 01 :</label>
                                <input type="text" name="house_no" class="form-control" placeholder="e.g house no.">
                            </div><!--col-lg-6-->
                            <div class="col-lg-6 col-md-6 col-sm-10 my-2">
                                <label for="street_no" class="form-label my-1">Address line 01 :</label>
                                <input type="text" name="street_no" class="form-control" placeholder="e.g street no.">
                            </div><!--col-lg-6-->
                            <div class="col-lg-6 col-md-6 col-sm-10 my-2">
                                <label for="city" class="form-label my-1">City :</label>
                                <input type="text" name="city" class="form-control" placeholder="e.g lahore">
                            </div><!--col-lg-6-->
                            <div class="col-lg-6 col-md-6 col-sm-10 my-2">
                                <label for="state" class="form-label my-1">State :</label>
                                <input type="text" name="state" class="form-control" placeholder="e.g punjab">
                            </div><!--col-lg-6-->
                            <div class="col-lg-6 col-md-6 col-sm-10 my-2">
                                <label for="country" class="form-label my-1">Country :</label>
                                <input type="text" name= "country" class="form-control" placeholder="e.g pakistan">
                            </div><!--col-lg-6-->
                            <div class="col-lg-6 col-md-6 col-sm-10 my-2">
                                <label for="pin_code" class="form-label my-1">Pin Code :</label>
                                <input type="number" name="pin_code" class="form-control" placeholder="e.g 123456">
                            </div><!--col-lg-6-->
                            <button type="submit" class="btn btn-primary my-3 w-100" name="place_order">Order now</button>
                        </div><!--row-->
                    </form>
                </div><!--col-lg-12-->
            </div><!--row-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>
        
</body>
</html>