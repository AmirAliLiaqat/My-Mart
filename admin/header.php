<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-dark border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">
            <?php
                require_once '../config.php'; 
                $fetch_options = "SELECT * FROM `options`";
                $fetch_options_query = mysqli_query($conn, $fetch_options) or die('Query Failed');

                if(mysqli_num_rows($fetch_options_query) > 0) {
                    while($row = mysqli_fetch_assoc($fetch_options_query)) {
            ?>
            <img src="../upload-images/<?php echo $row['site_logo']; ?>">
            <?php
                    }
                }
            ?>
        </a>
        </button>
        <div class="profile dropdown">
            <span class="nav-link dropdown-toggle text-white" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-2x fa-circle-user"></i>&nbsp;&nbsp; <?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname']; ?>
            </span>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="user_profile.php?id=<?php echo $_SESSION['ID']; ?>"><i class="fa-solid fa-user"></i> View Account</a></li>
                <li><a class="dropdown-item" href="../delete_user.php?id=<?php echo $_SESSION['ID']; ?>"><i class="fa-solid fa-trash"></i> Delete Account</a></li>
                <li><a class="dropdown-item" href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>
        </div><!--profile-->
    </div><!--container-->
</nav>