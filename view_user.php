<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <?php require_once 'links.php'; ?>
</head>
<body>

    <?php require_once 'header.php'; ?>

    <section class="admin_section section_content mt-5">
        <div class="container p-4">
            <div class="admin_content text-white">
                <h1>User Profile</h1></br>
                <?php
                
                    require_once 'config.php';
                    $id = $_GET['id'];

                    $select_data = "SELECT * FROM `users` WHERE `id` = '$id'";
                    $select_data_query = mysqli_query($conn, $select_data) or die('Query Failed');
                    $sn = 1;

                    if(mysqli_num_rows($select_data_query) > 0) {
                        while($row = mysqli_fetch_assoc($select_data_query)) {
                
                ?>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                        <?php
                            if($row['profile_pic']!="") { 
                                ?>
                                    <img src="upload-images/<?php echo $row['profile_pic']; ?>" width="100" height="30%">
                                <?php
                            } else {
                                echo "No image added";
                            }
                        ?>
                    </div><!--col-lg-3-->
                    <div class="col-lg-9 col-md-9 col-sm-6">
                        <table class="text-white">
                            <tr class="user_detail_tr">
                                <td class="user_detail_td">First Name:</td>
                                <td class="user_detail_td"><?php echo $row['fname']; ?></td>
                            </tr>
                            <tr class="user_detail_tr">
                                <td class="user_detail_td">Last Name:</td>
                                <td class="user_detail_td"><?php echo $row['lname']; ?></td>
                            </tr>
                            <tr class="user_detail_tr">
                                <td class="user_detail_td">Email:</td>
                                <td class="user_detail_td"><?php echo $row['email']; ?></td>
                            </tr>
                            <tr class="user_detail_tr">
                                <td class="user_detail_td">Phone Number:</td>
                                <td class="user_detail_td"><?php echo $row['phone']; ?></td>
                            </tr>
                            <tr class="user_detail_tr">
                                <td class="user_detail_td">Country:</td>
                                <td class="user_detail_td"><?php echo $row['country']; ?></td>
                            </tr>
                            <tr class="user_detail_tr">
                                <td class="user_detail_td">City:</td>
                                <td class="user_detail_td"><?php echo $row['city']; ?></td>
                            </tr>
                            <tr class="user_detail_tr">
                                <td class="user_detail_td">Zip Code:</td>
                                <td class="user_detail_td"><?php echo $row['zip']; ?></td>
                            </tr>
                            <tr class="user_detail_tr">
                                <td class="user_detail_td">Status:</td>
                                <td class="user_detail_td"><?php echo $row['status']; ?></td>
                            </tr>
                            <tr class="user_detail_tr">
                                <td class="user_detail_td">Last Login:</td>
                                <td class="user_detail_td"><?php echo $row['last_login_details']; ?></td>
                            </tr>
                            <tr class="user_detail_tr border-bottom-0">
                                <td class="user_detail_td"></td>
                                <td class="user_detail_td">
                                    <button class="btn btn-primary" onclick="window.print();" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-solid fa-print"></i> Print</button>
                                    <a class="btn btn-info" href="update_user.php?id=<?php echo $row['ID']; ?>" role="button"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    <a class="btn btn-danger" href="delete_user.php?id=<?php echo $row['ID']; ?>&profile_pic=<?php echo $row['profile_pic']; ?>" role="button"><i class="fa-solid fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                        </table>
                    </div><!--col-lg-9-->
                </div><!--row-->
                <?php
                        }
                    } else { ?>
                        <tr class="text-center">
                            <td colspan="6">No User Found.</td>
                        </tr>
                    <?php }
                ?>
            </div><!--admin_content-->
        </div><!--container-->
    </section>

    <?php require_once 'footer.php'; ?>

</body>
</html>