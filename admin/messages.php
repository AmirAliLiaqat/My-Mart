<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
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
                        <h1>Messages</h1></br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped text-center fst-italic">
                                <thead class="bg-white text-dark">
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Username</th>
                                        <th>Number</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Send Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                    require_once '../config.php';

                                    if(isset($_GET['id'])) {
                                        $id = $_GET['id'];

                                        $delete_message = "DELETE FROM `messages` WHERE `id` = '$id'";
                                        $delete_message_query = mysqli_query($conn, $delete_message) or die('Query Failed');
                                        if($delete_message_query) {
                                            header('location: messages.php');
                                        }
                                    }

                                    $sr = 1;

                                    $select_data = "SELECT * FROM `messages`";
                                    $select_data_query = mysqli_query($conn, $select_data) or die('Query Failed');

                                    if(mysqli_num_rows($select_data_query) > 0) {
                                        while($row = mysqli_fetch_assoc($select_data_query)) {
                                ?>
                                <tbody>
                                    <tr class="text-white">
                                        <td><?php echo $sr++ ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['number']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['message']; ?></td>
                                        <td><?php echo $row['activity']; ?></td>
                                        <td><a href="messages.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('are you sure to delete this message?')" name="delete_message">Delete Message</a></td>
                                    </tr>
                                </tbody>
                                <?php
                                        }
                                    } else { ?>
                                        <tr class="text-center">
                                            <td colspan="6">No message found.</td>
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

    <?php require_once 'footer.php'; ?>

</body>
</html>