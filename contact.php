<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <?php require_once 'links.php'; ?>
</head>
<body>

    <?php require_once 'header.php'; ?>

    <section class="banner p-3">
        <div class="container text-center text-white p-5">
            <h1>Contact Us</h1>
            <div class="links">
                <a href="index.php" class="nav-link d-inline">Home</a> / <span>&nbsp;&nbsp; Contact</span>
            </div><!--links-->
        </div><!--container-->
    </section>

    <?php

        require_once 'config.php';

        if(isset($_POST['send_message'])) {
            $username = $_POST['username'];
            $number = $_POST['number'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            date_default_timezone_set("Asia/Karachi");
            $current_date = date("h:i:s:a M d Y");

            $send_message = "INSERT INTO `messages`(`username`, `number`, `email`, `message`, `activity`) VALUES ('$username','$number','$email','$message','$current_date')";
            $send_message_query = mysqli_query($conn, $send_message) or die("Query Failed");

            if($send_message_query) {
                $message[] = 'Your message send successfully...';
            } else {
                $message[] = 'Failed to send message!';
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

    <section>
        <!----------------- Contact -------------------->
        <div class="container contact_container p-5">
            <div class="contact_div d-flex p-3 mb-5">
                <div class="map_div border">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3403.32642764111!2d74.34339782991009!3d31.460205510121252!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3919072e84ee31e5%3A0x1c3d625526b4507a!2sByteBunch!5e0!3m2!1sen!2s!4v1661173940191!5m2!1sen!2s" 
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div><!--map_div-->
                <div class="contact_div">
                    <form method="post">
                        <div class="row">
                            <div class="input-group top_input">
                                <input type="text" id="name" name="username" required>
                                <label for="name"><i class="fas fa-user"></i>&nbsp; Your Name</label>
                            </div><!--input-group-->
                            <div class="input-group top_input">
                                <input type="text" id="number" name="number" required>
                                <label for="number"><i class="fas fa-phone"></i>&nbsp; Phone No.</label>
                            </div><!--input-group-->
                        </div><!--row-->
                        <div class="input-group">
                            <input type="email" id="email" name="email" required>
                            <label for="email"><i class="fas fa-envelope"></i>&nbsp; Email Id</label>
                        </div><!--input-group-->
                        <div class="input-group">
                            <textarea id="message" rows="8" name="message" required></textarea>
                            <label for="message"><i class="fas fa-comments"></i>&nbsp; Your Message</label>
                        </div><!--input-group-->
                        <button type="submit" name="send_message" class="submit_btn">Submit <i class="fas fa-paper-plane"></i></button>
                    </form>
                </div><!--contact_div-->
            </div><!--contact_div-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>

</body>
</html>;