<!-- favicon -->
<?php
    require_once 'config.php'; 
    $fetch_options = "SELECT * FROM `options`";
    $fetch_options_query = mysqli_query($conn, $fetch_options) or die('Query Failed');

    if(mysqli_num_rows($fetch_options_query) > 0) {
        while($row = mysqli_fetch_assoc($fetch_options_query)) {
?>
<link rel="shortcut icon" href="upload-images/<?php echo $row['site_favicon']; ?>" type="image/x-icon">
<?php
        }
    }
?>
<!-- Custom Css -->
<link rel="stylesheet" href="css/style.css">
<!-- Custom Js -->
<script src="js/script.js"></script>
<!-- Bootstrap Css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Bootstrap Bundle Js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Font Awesome Css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">