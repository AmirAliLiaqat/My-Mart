<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <?php require_once 'admin_links.php'; ?>
</head>
<body>

    <?php require_once 'header.php'; ?>

    <?php
        require_once '../config.php';

        if(!isset($_SESSION['fname'])) {
            header('location: ../login.php');
        } 

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
                $destination_path = "../upload-images/".$profile_pic;

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

    <section class="admin_section section_content">
        <div class="container-fluid">
            <div class="admin_content text-white">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-12" id="admin-menu">
                        <?php require_once 'sidebar.php'; ?>
                    </div><!--col-lg-2-->
                    <div class="col-lg-10 col-md-01 col-sm-12 text-white p-3">
                        <h1 class="d-flex justify-content-between">
                            Users Details 
                            <div class="action">
                                <button class="btn btn-primary" onclick="window.print();" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-solid fa-print"></i> Print</button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-user"></i> Add User</button>
                            </div><!--action-->
                        </h1></br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped text-center fst-italic">
                                <thead class="bg-white text-dark">
                                    <tr>
                                        <th>Id</th>
                                        <th>Profile Pic</th>
                                        <th>Fname</th>
                                        <th>Lname</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>Country</th>
                                        <th>Zip</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                        <th>Login Activity</th>
                                    </tr>
                                </thead>
                                <?php
                                
                                    require_once '../config.php';

                                    $select_data = "SELECT * FROM `users`";
                                    $select_data_query = mysqli_query($conn, $select_data) or die('Query Failed');
                                    $id = 1;

                                    if(mysqli_num_rows($select_data_query) > 0) {
                                        while($row = mysqli_fetch_assoc($select_data_query)) {      
                                
                                ?>
                                <tbody>
                                    <tr class="text-white">
                                        <td><?php echo $id++ ?></td>
                                        <td>
                                            <?php
                                                if($row['profile_pic']!="") { 
                                                    ?>
                                                        <img src="../upload-images/<?php echo $row['profile_pic']; ?>" width="100" height="10%">
                                                    <?php
                                                } else {
                                                    echo "No image added";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $row['fname']; ?></td>
                                        <td><?php echo $row['lname']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><?php echo $row['city']; ?></td>
                                        <td><?php echo $row['country']; ?></td>
                                        <td><?php echo $row['zip']; ?></td>
                                        <td class="">
                                            <a class="btn btn-info" href="user_profile.php?id=<?php echo $row['ID']; ?>" role="button"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-danger" href="../delete_user.php?id=<?php echo $row['ID']; ?>&profile_pic=<?php echo $row['profile_pic']; ?>" role="button"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                        <?php if($row['status'] == 'admin') { ?>
                                            <td classs="p-1">
                                                <span class="bg-danger text-white p-1 rounded-pill"><?php echo $row['status']; ?></span>
                                            </td>
                                        <?php } else { ?>
                                            <td classs="p-1">
                                                <span class="bg-success text-white p-1 rounded-pill"><?php echo $row['status']; ?></span>
                                            </td>
                                        <?php } ?>
                                        <td><?php echo $row['last_login_details']; ?></td>
                                    </tr>
                                </tbody>
                                <?php
                                        }
                                    } else { ?>
                                        <tr class="text-center">
                                            <td colspan="6">No User Found.</td>
                                        </tr>
                                    <?php }
                                ?>
                            </table>
                        </div><!--table-responsive-->
                    </div><!--col-lg-10-->
                </div><!--row-->
            </div><!--admin_content-->
        </div><!--container-->
    </section>

    <!-- Modal for adding new user-->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div><!--modal-header-->
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <label for="fname" class="form-label mt-2">First Name</label>
                                <input type="text" name="fname" class="form-control" value="" required>
                            </div><!--col-6-->
                            <div class="col-6">
                                <label for="lname" class="form-label mt-2">Last Name</label>
                                <input type="text" name="lname" class="form-control" value="" required>
                            </div><!--col-6-->
                        </div><!--row-->

                        <label for="email" class="form-label mt-2">Email</label>
                        <input type="email" name="email" class="form-control" value="" required>

                        <label for="password" class="form-label mt-2">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                        <!-- An element to toggle between password visibility -->
                        <input type="checkbox" class="my-3" onclick="show_hide_password()"> Show Password </br>

                        <label for="number" class="form-label mt-2">Phone Number</label>
                        <input type="number" name="number" class="form-control" value="" required>

                        <div class="row">
                            <div class="col-6">
                                <label for="city" class="form-label mt-2">City</label>
                                <input type="text" name="city" class="form-control" value="" required>
                            </div><!--col-6-->
                            <div class="col-6">
                                <label for="country" class="form-label mt-2">Country</label>
                                <input type="text" name="country" class="form-control" value="" required>
                            </div><!--col-6-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col-6">
                                <label for="zip" class="form-label mt-2">Zip Code</label>
                                <input type="text" name="zip" class="form-control" value="" required>
                            </div><!--col-6-->
                            <div class="col-6">
                                <label for="status" class="form-label mt-2">Status</label>
                                <select name="status" class="form-control">
                                    <option selected>--please select--</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div><!--col-6-->
                        </div><!--row-->

                        <label for="profile_pic" class="form-label mt-2">Profile Picture</label>
                        <input type="file" name="profile_pic" class="form-control" value="" required>

                        <button type="submit" class="btn btn-primary my-3 w-100 form-btn" name="register">Register</button>
                    </form>
                </div><!--modal-body-->
            </div><!--modal-content-->
        </div><!--modal-dialog-->
    </div><!--modal-->

    <?php require_once 'footer.php'; ?>

</body>
</html>