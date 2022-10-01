<footer>
    <div class="container d-flex justify-content-between p-3">
        <div class="copyright">
            <?php
                require_once 'config.php'; 
                $fetch_options = "SELECT * FROM `options`";
                $fetch_options_query = mysqli_query($conn, $fetch_options) or die('Query Failed');

                if(mysqli_num_rows($fetch_options_query) > 0) {
                    while($row = mysqli_fetch_assoc($fetch_options_query)) {
            ?>
            <p class="text-white mb-0"><?php echo $row['footer_text']; ?></p>
            <?php
                    }
                }
            ?>
        </div><!--copyright-->
        <div class="date_time">
            <a href="#" class="mx-1"><i class="fa-brands fa-facebook-f btn btn-light text-primary rounded-circle"></i></a>
            <a href="#" class="mx-1"><i class="fa-brands fa-twitter btn btn-light text-info rounded-circle"></i></a>
            <a href="#" class="mx-1"><i class="fa-brands fa-instagram btn btn-light text-danger rounded-circle"></i></a>
            <a href="#" class="mx-1"><i class="fa-brands fa-linkedin-in btn btn-light text-primary rounded-circle"></i></a>
        </div><!--date_time-->
    </div><!--container-->
</footer>