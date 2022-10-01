<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Google Recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?php require_once 'links.php'; ?>
</head>
<body>

    <?php 
        require_once 'header.php';
        require_once 'config.php'; 

        session_start();

        if(isset($_POST['login'])) {
    
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            date_default_timezone_set("Asia/Karachi");
            $login_detail = date("h:i:s:a M d Y"); 

            $login_user = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
            $login_user_query = mysqli_query($conn, $login_user) or die('Query Failed');

            $user_login_detail = "UPDATE `users` SET `last_login_details`= '$login_detail' WHERE `email` = '$email'";
            $user_login_detail_query = mysqli_query($conn, $user_login_detail) or die('Query Failed');
            
            if(mysqli_num_rows($login_user_query) > 0) {
                $row = mysqli_fetch_assoc($login_user_query);

                $_SESSION['ID'] = $row['ID'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['lname'] = $row['lname'];
                $_SESSION['status'] = $row['status'];

                if($_SESSION['status'] === 'user') { 
                    header('location: index.php');
                } else {
                    header('location: admin/dashboard.php');
                }
            } else {
                $message[] = "Login Details are incorrect...";
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
        <h3 class="bg-dark text-info text-center p-2">Login Form</h3>
        <div class="col-lg-3 col-md-3 col-sm-10 form-box mt-5 text-white">
            <form action="" method="post">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" class="form-control" required>

                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
                <!-- An element to toggle between password visibility -->
                <input type="checkbox" class="my-3" onclick="show_hide_password()"> Show Password </br>

                <label for="recaptcha" class="form-label">Recaptcha</label>
                <div class="g-recaptcha" data-sitekey="6LcxYvwgAAAAAChgviNqFW_QYAcHTiGQebZ39p5i"></div>

                <p class="text-center pt-2">Don't have an account. <a href="register.php" class="text-info">register</a></p>

                <button type="submit" class="btn btn-outline-info my-3 w-100 form-btn" name="login">Login</button>
            </form>
        </div><!--form-box-->
    </div><!--form-container-->
    
    <?php require_once 'footer.php'; ?>
    
</body>
</html>