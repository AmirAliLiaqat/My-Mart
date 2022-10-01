<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <?php require_once 'admin_links.php'; ?>
</head>
<body>

    <?php require_once 'header.php'; ?>

    <?php
        require_once '../config.php'; 

        if(!isset($_SESSION['fname'])) {
            header('location: ../login.php');
        }

        error_reporting(0);

        // Code for add product
        if(isset($_POST['add_product'])) {
            
            $title = $_POST['title'];
            $product_description = $_POST['product_description'];
            $price = $_POST['price'];
            $sale = $_POST['sale'];
            $currency = $_POST['currency'];
            $product_status = $_POST['product_status'];
            date_default_timezone_set("Asia/Karachi");
            $product_added_date = date("h:i:s:a M d Y"); 

            if($sale != '') {
                $sale = $sale.'%';
            } else {
                $sale = '0%';
            }

            if(isset($_FILES['product_img']['name'])) {
                $product_img = $_FILES['product_img']['name'];
                // Auto rename image
                $ext = end(explode('.',$product_img));
                // Rename the image
                $product_img = "product_img_".rand(00,99).'.'.$ext;
                $source_path = $_FILES['product_img']['tmp_name'];
                $destination_path = "../upload-images/".$product_img;

                // Finally upload the image
                $upload = move_uploaded_file($source_path, $destination_path);
            } else {
                $product_img = "";
            }

            $add_product = "INSERT INTO `products`(`product_img`, `name`,`product_description`,`price`, `sale`, `currency`,`product_status`, `date_added`) 
            VALUES ('$product_img','$title','$product_description','$price','$sale','$currency','$product_status','$product_added_date')";

            $add_product_query = mysqli_query($conn, $add_product) or die('Query Failed');
        
            if($add_product_query) {
                $message[] = "Product added Successfully...";
            } else {
                $message[] = "There was a problem to adding the new product...";
            }
            
        }

        // Code for update product
        if(isset($_POST['update_product'])) {
            $id = $_GET['id'];
            $title = $_POST['title'];
            $product_description = $_POST['product_description'];
            $price = $_POST['price'];
            $sale = $_POST['sale'];
            $currency = $_POST['currency'];
            $product_status = $_POST['product_status'];
            $current_image = $_POST['current_image'];
            date_default_timezone_set("Asia/Karachi");
            $product_updated_date = date("h:i:s:a M d Y"); 

            if(isset($_FILES['product_img']['name'])) {
                $product_img = $_FILES['product_img']['name'];

                if($product_img != "") {
                    // Auto rename image
                    $ext = end(explode('.',$product_img));
                    // Rename the image
                    $product_img = "product_img_".rand(00,99).'.'.$ext;
                    $source_path = $_FILES['product_img']['tmp_name'];
                    $destination_path = "../upload-images/".$product_img;

                    // Finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    if($current_image != "") {
                        // Remove the current image
                        $remove_path = "../upload-images/".$current_image;
                        $remove_image = unlink($remove_path);
                    }

                } else {
                    $product_img = $current_image;
                }
                
            } else {
                $product_img = $current_image;
            }

            $update_product = "UPDATE `products` SET `product_img`='$product_img',`name`='$title',`product_description`='$product_description',`price`='$price',`sale`='$sale',`currency`='$currency',`product_status`='$product_status',`updated_date`='$product_updated_date' WHERE `id` = '$id'";

            $update_product_query = mysqli_query($conn, $update_product) or die('Query Failed');
        
            if($update_product_query) {
                header('location: products.php');
            } else {
                $message[] = "Failed to update product!";
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
                        <h1>Products</h1></br>

                        <?php if(isset($_GET['id'])) { ?> 

                        <?php

                            $id = $_GET['id'];
                            $fetch_products = "SELECT * FROM `products` WHERE `id` = '$id'";
                            $fetch_products_query = mysqli_query($conn, $fetch_products) or die('Query Failed');

                            if(mysqli_num_rows($fetch_products_query) > 0) {
                                while($row = mysqli_fetch_assoc($fetch_products_query)) {
                        
                        ?>
                        <form action="" method="post" enctype="multipart/form-data" class="row d-flex justify-content-center bg-white text-dark add_items_div p-3 m-2">
                            <h3 class="text-center">Update Product</h3>
                            <div class="col-md-6">
                                <label for="title" class="form-label my-2">Product Title :</label>
                                <input type="text" name="title" class="form-control" placeholder="enter product name" value="<?php echo $row['name']; ?>" required>
                            </div><!--col-md-6-->
                            <div class="col-md-6">
                                <label for="price" class="form-label my-2">Price :</label>
                                <input type="text" name="price" class="form-control" placeholder="enter product price" value="<?php echo $row['price']; ?>" required>
                            </div><!--col-md-6-->
                            <div class="col-md-6">
                                <label for="sale" class="form-label my-2">Sale :</label>
                                <input type="text" name="sale" class="form-control" placeholder="enter sale price" value="<?php echo $row['sale']; ?>">
                            </div><!--col-md-6-->
                            <div class="col-md-6">
                                <label for="currency" class="form-label my-2">Currency :</label>
                                <select name="currency" class="form-control">
                                    <option <?php if($row['currency']=='Rs') {echo "selected";} ?> value="Rs">Rs</option>
                                    <option <?php if($row['currency']=='USD') {echo "selected";} ?> value="USD">USD</option>
                                </select>
                            </div><!--col-md-6-->
                            <div class="col-md-6">
                                <label for="current_img" class="form-label my-2">Current Product Img :</label></br>
                                <img src="../upload-images/<?php echo $row['product_img']; ?>" width="100">
                            </div><!--col-md-6-->
                            <div class="col-md-6">
                                <label for="product_img" class="form-label my-2">New Product Img :</label>
                                <input type="file" name="product_img" class="form-control">
                            </div><!--col-md-6-->
                            <div class="col-md-6">
                                <label for="product_description" class="form-label my-2">Product Description :</label>
                                <textarea name="product_description" class="form-control" id="editor" cols="30" rows="10"><?php echo $row['product_description']; ?></textarea>
                            </div><!--col-md-6-->
                            <div class="col-md-6">
                                <label for="product_status" class="form-label my-2">Status :</label>
                                <select name="product_status" class="form-control">
                                    <option <?php if($row['product_status']=='publish') {echo "selected";} ?> value="publish">Publish</option>
                                    <option <?php if($row['product_status']=='draft') {echo "selected";} ?> value="draft" selected>Draft</option>
                                </select>
                            </div><!--col-md-6-->
                            <div class="text-center">
                                <input type="hidden" name="current_image" value="<?php echo $row['product_img']; ?>">
                                <input type="submit" name="update_product" class="btn btn-primary text-center mt-3 btn-lg" value="Update">
                            </div><!--text-center-->
                        </form>
                        <?php
                                }
                            }
                        ?>

                        <?php } else { ?>

                        <form action="" method="post" enctype="multipart/form-data" class="row d-flex justify-content-center bg-white text-dark add_items_div p-3 m-2">
                            <h3 class="text-center">Add Product</h3>
                            <div class="col-md-6">
                                <label for="title" class="form-label my-2">Product Title :</label>
                                <input type="text" name="title" class="form-control" placeholder="enter product name" required>
                            </div><!--col-md-6-->
                            <div class="col-md-6">
                                <label for="price" class="form-label my-2">Product Price :</label>
                                <input type="text" name="price" class="form-control" placeholder="enter product price" required>
                            </div><!--col-md-6-->
                            <div class="col-md-6">
                                <label for="sale" class="form-label my-2">Sale :</label>
                                <input type="text" name="sale" class="form-control" placeholder="enter sale price">
                            </div><!--col-md-6-->
                            <div class="col-md-6">
                                <label for="currency" class="form-label my-2">Currency :</label>
                                <select name="currency" class="form-control">
                                    <option value="Rs" selected>Rs</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div><!--col-md-6-->
                            <div class="col-md-6">
                                <label for="product_img" class="form-label my-2">Product Img :</label>
                                <input type="file" name="product_img" class="form-control" required>
                            </div><!--col-md-6-->
                            <div class="col-md-6">
                                <label for="product_status" class="form-label my-2">Status :</label>
                                <select name="product_status" class="form-control">
                                    <option value="publish">Publish</option>
                                    <option value="draft" selected>Draft</option>
                                </select>
                            </div><!--col-md-6-->
                            <div class="col-md-12">
                                <label for="product_description" class="form-label my-2">Product Description :</label>
                                <textarea name="product_description" class="form-control" id="editor" cols="30" rows="10"></textarea>
                            </div><!--col-md-12-->
                            <div class="text-center">
                                <input type="submit" name="add_product" class="btn btn-primary text-center mt-3 btn-lg" value="Add Product">
                            </div><!--text-center-->
                        </form>

                        <?php } ?>

                        <section>
                            <!----------------- Products -------------------->
                            <div class="container products_container">
                                <h1 class="text-center text-white my-4">Latest Products</h1>
                                <div class="row">
                                    <?php

                                        if(isset($_GET['id']) AND isset($_GET['product_img'])) {
                                            $id = $_GET['id'];
                                            $product_img = $_GET['product_img'];

                                            if($product_img != "") {
                                                $image_path = "../upload-images/".$product_img;
                                                $remove_image = unlink($image_path);
                                            }
                                    
                                            $delete_product = "DELETE FROM `products` WHERE `ID` = $id";
                                            $delete_product_query = mysqli_query($conn, $delete_product);
                                    
                                            header('location: products.php');
                                        } else {
                                            header('location: products.php');
                                        }

                                        $fetch_products = "SELECT * FROM `products`";
                                        $fetch_products_query = mysqli_query($conn, $fetch_products) or die('Query Failed');

                                        if(mysqli_num_rows($fetch_products_query) > 0) {
                                            while($row = mysqli_fetch_assoc($fetch_products_query)) {
                                    
                                    ?>
                                    <div class="col-md-4 col-sm-6 mb-3">
                                        <div class="inner_content bg-white text-dark text-center dashboard_div p-3">
                                            <img src="../upload-images/<?php echo $row['product_img']; ?>">
                                            <div class="title mt-3"><?php echo $row['name']; ?></div>
                                            <div class="price text-danger"><?php echo number_format($row['price']); ?> <?php echo $row['currency']; ?>/-</div>
                                            <a href="products.php?id=<?php echo $row['id']; ?>" class="btn btn-warning mt-3">Update</a>
                                            <a href="products.php?id=<?php echo $row['id']; ?>&product_img=<?php echo $row['product_img']; ?>" onclick="return confirm('are you sure to delete this product?')" class="btn btn-danger mt-3">Delete</a>
                                        </div><!--inner_content-->
                                    </div><!--col-md-4-->
                                    <?php
                                            }
                                        } else { ?>
                                            <div class="text-center bg-white text-danger p-3">no product found...</div>
                                        <?php }
                                    ?>
                                </div><!--row-->
                            </div><!--container-->
                        </section>
                    </div><!--col-lg-10-->
                </div><!--row-->
            </div><!--admin_content-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>

</body>
</html>