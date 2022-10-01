<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <?php require_once 'links.php'; ?>
</head>
<body>

    <?php require_once 'header.php'; ?>

    <?php
        require_once 'config.php';

        // Code for edit form
        if(isset($_POST['update'])) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $number = $_POST['number'];
            $country = $_POST['country'];
            $city = $_POST['city'];
            $zip = $_POST['zip'];
            $status = $_POST['status'];
            $current_image = $_POST['current_image'];
            $id = $_POST['id'];

            if(isset($_FILES['profile_pic']['name'])) {
                $profile_pic = $_FILES['profile_pic']['name'];

                if($profile_pic != "") {
                    // Auto rename image
                    $ext = end(explode('.',$profile_pic));
                    // Rename the image
                    $profile_pic = "profile_pic_".rand(00,99).'.'.$ext;
                    $source_path = $_FILES['profile_pic']['tmp_name'];
                    $destination_path = "upload-images/".$profile_pic;

                    // Finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    if($current_image != "") {
                        // Remove the current image
                        $remove_path = "upload-images/".$current_image;
                        $remove_image = unlink($remove_path);
                    }

                } else {
                    $profile_pic = $current_image;
                }
                
            } else {
                $profile_pic = $current_image;
            }

            $update = "UPDATE `users` SET `profile_pic`='$profile_pic',`fname`='$fname',`lname`='$lname',`email`='$email',`password`=md5('$password'),`phone`='$number',`country`='$country',`city`='$city',`zip`='$zip',`status`='$status' WHERE `ID` = $id";

            $update_query = mysqli_query($conn, $update) or die('Query Failed');
        
            if($update_query) {
                header('location: admin/user_profile.php?id='.$id);
            } else {
                $message[] = "Failed to register user!";
            }
            
        }
    ?>
    
    <div class="row my-5 d-flex justify-content-center">
        <h3 class="bg-dark text-info text-center p-2">Update Form</h3>
        <div class="col-lg-6 col-md-6 col-sm-10 form-box mt-5 bg-dark text-white">
            <?php 
            
                if(isset($_GET['id'])){ 
                    $id = $_GET['id'];

                    $fetch_data = "SELECT * FROM `users` WHERE `ID` = $id";
                    $fetch_data_query = mysqli_query($conn, $fetch_data) or die("Query Failed");

                    if(mysqli_num_rows($fetch_data_query) > 0) {
                        while($row = mysqli_fetch_assoc($fetch_data_query)) {
                        

            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="fname" class="form-label mt-2">First Name</label>
                <input type="text" name="fname" class="form-control" value="<?php echo $row['fname']; ?>" required>

                <label for="lname" class="form-label mt-2">Last Name</label>
                <input type="text" name="lname" class="form-control" value="<?php echo $row['lname']; ?>" required>

                <label for="email" class="form-label mt-2">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>

                <label for="password" class="form-label mt-2">Password</label>
                <input type="password" name="password" class="form-control" id="password" value="<?php echo $row['password']; ?>" required>
                <!-- An element to toggle between password visibility -->
                <input type="checkbox" class="my-3" onclick="show_hide_password()"> Show Password </br>

                <label for="number" class="form-label mt-2">Phone Number</label>
                <input type="number" name="number" class="form-control" value="<?php echo $row['phone']; ?>" required>

                <label for="country" class="form-label mt-2">Country</label>
                <input type="text" name="country" class="form-control" value="<?php echo $row['country']; ?>" required>

                <label for="city" class="form-label mt-2">City</label>
                <input type="text" name="city" class="form-control" value="<?php echo $row['city']; ?>" required>

                <label for="zip" class="form-label mt-2">Zip Code</label>
                <input type="text" name="zip" class="form-control" value="<?php echo $row['zip']; ?>" required>

                <label for="status" class="form-label mt-2">Status</label>
                <select name="status" class="form-control">
                    <option <?php if($row['status']=='user') {echo "selected";} ?> value="user">User</option>
                    <option <?php if($row['status']=='admin') {echo "selected";} ?> value="admin">Admin</option>
                </select>

                <label for="current_profile_pic" class="form-label mt-2">Current Profile Picture</label><br>
                <?php
                    if($row['profile_pic']!="") { 
                        ?>
                            <img src="upload-images/<?php echo $row['profile_pic']; ?>" width="100" height="10%">
                        <?php
                    } else {
                        echo "No image added";
                    }
                ?><br>

                <label for="profile_pic" class="form-label mt-2">New Profile Picture</label>
                <input type="file" name="profile_pic" class="form-control" value="">

                <input type="hidden" name="current_image" value="<?php echo $row['profile_pic']; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button type="submit" class="btn btn-outline-info my-3 w-100 form-btn" name="update">Update</button>
            </form>
            <?php 
                        }
                    }
                }    
            ?>
        </div><!--form-box-->
    </div><!--form-container-->

    <?php require_once 'footer.php'; ?>
    
</body>
</html>