<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <?php require_once 'links.php'; ?>
</head>
<body>

    <?php require_once 'header.php'; ?>

    <section class="banner p-3">
        <div class="container text-center text-white p-5">
            <h1>About Us</h1>
            <div class="links">
                <a href="index.php" class="nav-link d-inline">Home</a> / <span>&nbsp;&nbsp; About</span>
            </div><!--links-->
        </div><!--container-->
    </section>

    <section>
        <!----------------- About -------------------->
        <div class="container about_container p-3 mt-5">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 p-0">
                    <img src="images/about.jpg" class="w-100 h-100">
                </div><!--col-lg-6-->
                <div class="col-lg-6 col-md-6 col-sm-12 bg-white text-dark p-3">
                    <h2>Why Choose Us?</h2>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor praesentium vel suscipit nulla impedit vitae minus molestias nisi cupiditate dolorum temporibus beatae accusantium aliquam, voluptas quidem odio perspiciatis ea quis minima rem officiis libero excepturi dicta. Debitis ipsa fuga dignissimos? Quo assumenda facilis doloremque. Odio cumque provident tenetur repellat vel.</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor praesentium vel suscipit nulla impedit vitae minus molestias nisi cupiditate dolorum temporibus beatae accusantium aliquam, voluptas quidem odio perspiciatis ea quis minima rem officiis libero excepturi dicta.</p>
                    <a href="contact.php" class="btn btn-primary">Contact Us</a>
                </div><!--col-lg-6-->
            </div><!--row-->
        </div><!--container-->
        <!----------------- Team -------------------->
        <h1 class="text-center text-white pt-5">Our Team</h1>
        <div class="container team_container">
            <div class="card">
                <img src="images/1.png" class="main_img">
                <div class="content">
                    <img src="images/1.png" alt="">
                    <h3>Client One</h3>
                    <p>
                        I am student of IT Punjab University Lahore and i like to learn coding.
                    </p>
                    <div class="social_links">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-github"></i></a>
                    </div><!--social_links-->
                    <a href="#" class="btn">message me</a>
                </div><!--content-->
            </div><!--card-->
            <div class="card">
                <img src="images/2.png" class="main_img">
                <div class="content">
                    <img src="images/2.png" alt="">
                    <h3>Client Two</h3>
                    <p>
                        I am student of IT Punjab University Lahore and i like to learn coding.
                    </p>
                    <div class="social_links">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-github"></i></a>
                    </div><!--social_links-->
                    <a href="#" class="btn">message me</a>
                </div><!--content-->
            </div><!--card-->
            <div class="card">
                <img src="images/3.png" class="main_img">
                <div class="content">
                    <img src="images/3.png" alt="">
                    <h3>Client Three</h3>
                    <p>
                        I am student of IT Punjab University Lahore and i like to learn coding.
                    </p>
                    <div class="social_links">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-github"></i></a>
                    </div><!--social_links-->
                    <a href="#" class="btn">message me</a>
                </div><!--content-->
            </div><!--card-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>
    <!-- Vanilla Js -->
    <script type="text/javascript" src="js/vanilla-tilt.js"></script>

    <script>
        // Js code for our team section
        VanillaTilt.init(document.querySelectorAll(".card"), {
            max: 25,
            speed: 400,
            glare: true,
            "max-glare": 1
        });
    </script>

</body>
</html>