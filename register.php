<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
    <?php require_once 'links.php'; ?>
</head>
<body>

    <?php require_once 'header.php'; ?>

    <?php
        require_once 'config.php'; 

        // Code for register form
        if(isset($_POST['register'])) {
            
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $number = $_POST['number'];
            $country = $_POST['country'];
            $city = $_POST['city'];
            $zip = $_POST['zip'];
            $status = $_POST['status'];

            if(isset($_FILES['profile_pic']['name'])) {
                $profile_pic = $_FILES['profile_pic']['name'];
                // Auto rename image
                $ext = end(explode('.',$profile_pic));
                // Rename the image
                $profile_pic = "profile_pic_".rand(00,99).'.'.$ext;
                $source_path = $_FILES['profile_pic']['tmp_name'];
                $destination_path = "upload-images/".$profile_pic;

                // Finally upload the image
                $upload = move_uploaded_file($source_path, $destination_path);
            } else {
                $profile_pic = "";
            }

            $register_user = "INSERT INTO `users`(`profile_pic`, `fname`, `lname`, `email`, `password`, `phone`, `country`, `city`, `zip`, `status`) VALUES ('$profile_pic','$fname','$lname','$email', md5('$password'), '$number','$country','$city','$zip', '$status')";

            $register_user_query = mysqli_query($conn, $register_user) or die('Query Failed');
        
            if($register_user_query) {
                $message[] = "User register Successfully...";
            } else {
                $message[] = "There was a problem to register the user...";
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

    <div class="row my-5 d-flex justify-content-center">
        <h3 class="bg-dark text-info text-center p-2">Register Form</h3>
        <div class="col-lg-6 col-md-6 col-sm-10 form-box mt-5 bg-dark text-white">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="fname" class="form-label mt-2">First Name</label>
                <input type="text" name="fname" class="form-control" value="" required>

                <label for="lname" class="form-label mt-2">Last Name</label>
                <input type="text" name="lname" class="form-control" value="" required>

                <label for="email" class="form-label mt-2">Email</label>
                <input type="email" name="email" class="form-control" value="" required>

                <label for="password" class="form-label mt-2">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
                <!-- An element to toggle between password visibility -->
                <input type="checkbox" class="my-3" onclick="show_hide_password()"> Show Password </br>

                <label for="number" class="form-label mt-2">Phone Number</label>
                <input type="number" name="number" class="form-control" value="" required>

                <label for="city" class="form-label mt-2">City</label>
                <input type="text" name="city" class="form-control" value="" required>

                <label for="country" class="form-label mt-2">Country</label>
                <input type="text" name="country" class="form-control" value="" required>

                <label for="zip" class="form-label mt-2">Zip Code</label>
                <input type="text" name="zip" class="form-control" value="" required>

                <label for="status" class="form-label mt-2">Status</label>
                <select name="status" class="form-control">
                    <option selected>--please select--</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>

                <label for="profile_pic" class="form-label mt-2">Profile Picture</label>
                <input type="file" name="profile_pic" class="form-control" value="" required>

                <p class="text-center pt-4">Already have an account. <a href="login.php" class="text-info">login</a></p>

                <button type="submit" class="btn btn-outline-info my-3 w-100 form-btn" name="register">Register</button>
            </form>
        </div><!--form-box-->
    </div><!--form-container-->

    <?php require_once 'footer.php'; ?>
    
</body>
</html>