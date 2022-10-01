<?php

    require_once 'config.php';

    $id = $_GET['id'];
    $profile_pic = $_GET['profile_pic'];

    if(isset($id) AND isset($profile_pic)) {

        if($profile_pic != "") {
            $image_path = "upload-images/".$profile_pic;
            $remove_image = unlink($image_path);
        }

        $delete_user = "DELETE FROM `users` WHERE `ID` = $id";
        $delete_user_query = mysqli_query($conn, $delete_user);

        header('location: admin/users_detail.php');
    } else {
        header('location: admin/users_detail.php');
    }

?>