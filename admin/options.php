<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Options</title>
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
                        <h1>Options</h1>
                        <?php
                            require_once '../config.php'; 

                            error_reporting(0);

                            // Code for update site information
                            if(isset($_POST['update'])) {
                                
                                $id = $_POST['id'];
                                $site_title = $_POST['site_title'];
                                $site_description = $_POST['site_description'];
                                $footer_text = $_POST['footer_text'];
                                $currency_format = $_POST['currency_format'];
                                $current_logo = $_POST['current_logo'];
                                $current_favicon = $_POST['current_favicon'];

                                if(isset($_FILES['site_logo']['name'])) {
                                    $site_logo = $_FILES['site_logo']['name'];
                    
                                    if($site_logo != "") {
                                        // Auto rename image
                                        $ext = end(explode('.',$site_logo));
                                        // Rename the image
                                        $site_logo = "site_logo_".rand(00,99).'.'.$ext;
                                        $logo_source_path = $_FILES['site_logo']['tmp_name'];
                                        $logo_destination_path = "../upload-images/".$site_logo;
                    
                                        // Finally upload the image
                                        $upload_logo = move_uploaded_file($logo_source_path, $logo_destination_path);
                    
                                        if($current_logo != "") {
                                            // Remove the current image
                                            $remove_logo_path = "../upload-images/".$current_logo;
                                            $remove_logo_image = unlink($remove_logo_path);
                                        }
                    
                                    } else {
                                        $site_logo = $current_logo;
                                    }
                                    
                                } else {
                                    $site_logo = $current_logo;
                                }

                                if(isset($_FILES['site_favicon']['name'])) {
                                    $site_favicon = $_FILES['site_favicon']['name'];
                    
                                    if($site_favicon != "") {
                                        // Auto rename image
                                        $ext = end(explode('.',$site_favicon));
                                        // Rename the image
                                        $site_favicon = "site_favicon_".rand(00,99).'.'.$ext;
                                        $favicon_source_path = $_FILES['site_favicon']['tmp_name'];
                                        $favicon_destination_path = "../upload-images/".$site_favicon;
                    
                                        // Finally upload the image
                                        $upload_favicon = move_uploaded_file($favicon_source_path, $favicon_destination_path);
                    
                                        if($current_favicon != "") {
                                            // Remove the current image
                                            $remove_favicon_path = "../upload-images/".$current_favicon;
                                            $remove_favicon_image = unlink($remove_favicon_path);
                                        }
                    
                                    } else {
                                        $site_favicon = $current_favicon;
                                    }
                                    
                                } else {
                                    $site_favicon = $current_favicon;
                                }

                                $update_options = "UPDATE `options` SET `site_title`='$site_title',`site_favicon`='$site_favicon',`site_logo`='$site_logo',`site_description`='$site_description',`footer_text`='$footer_text',`currency_format`='$currency_format' WHERE `id` = '1'";

                                $update_options_query = mysqli_query($conn, $update_options) or die('Query Failed');
                            
                                if($update_options_query) {
                                    $message[] = "Site information updated successfully...";
                                } else {
                                    $message[] = "There was a problem to updating site information...";
                                }
                                
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
                        <form action="" method="post" enctype="multipart/form-data" class="row d-flex justify-content-center p-3 m-2">
                            <?php
                                $fetch_options = "SELECT * FROM `options`";
                                $fetch_options_query = mysqli_query($conn, $fetch_options) or die('Query Failed');

                                if(mysqli_num_rows($fetch_options_query) > 0) {
                                    while($row = mysqli_fetch_assoc($fetch_options_query)) {
                            ?>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="site_title" class="form-label my-2">Site Title :</label>
                                    <input type="text" name="site_title" class="form-control" placeholder="enter site name" value="<?php echo $row['site_title']; ?>" required>
                                </div><!--form-group-->
                                <div class="form-group">
                                    <label for="site_favicon" class="form-label my-2">Site Favicon :</label>
                                    <input type="file" name="site_favicon" class="form-control">
                                    <img src="../upload-images/<?php echo $row['site_favicon']; ?>" width="70">
                                </div><!--form-group-->
                                <div class="form-group">
                                    <label for="site_description" class="form-label my-2">Site Description :</label>
                                    <textarea name="site_description" class="form-control" id="editor" cols="30" rows="5"><?php echo $row['site_description']; ?></textarea>
                                </div><!--form-group-->
                            </div><!--col-md-6-->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="site_logo" class="form-label my-2">Site Logo :</label>
                                    <input type="file" name="site_logo" class="form-control">
                                    <img src="../upload-images/<?php echo $row['site_logo']; ?>" width="100">
                                </div><!--form-group-->
                                <div class="form-group">
                                    <label for="footer_text" class="form-label my-2">Footer Text :</label>
                                    <input type="text" name="footer_text" class="form-control" placeholder="enter footer text" value="<?php echo $row['footer_text']; ?>" required>
                                </div><!--form-group-->
                                <div class="form-group">
                                    <label for="currency_format" class="form-label my-2">Currency Format :</label>
                                    <select name="currency_format" class="form-control">
                                        <option <?php if($row['currency_format']=='Rs') {echo "selected";} ?> value="Rs">Rs</option>
                                        <option <?php if($row['currency_format']=='USD') {echo "selected";} ?> value="USD">USD</option>
                                        <option <?php if($row['currency_format']=='EUR') {echo "selected";} ?> value="EUR">EUR</option>
                                    </select>
                                </div><!--form-group-->
                            </div><!--col-md-6-->
                            <?php
                                    }
                                }
                            ?>

                            <div class="text-end">
                                <input type="hidden" name="current_logo" value="<?php echo $row['site_favicon']; ?>">
                                <input type="hidden" name="current_favicon" value="<?php echo $row['site_logo']; ?>">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" name="update" class="btn btn-primary mt-3 btn-lg" value="Update">
                            </div><!--text-center-->

                        </form>
                    </div><!--col-lg-10-->
                </div><!--row-->
            </div><!--admin_content-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>

</body>
</html>