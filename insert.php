<?php

$con = mysqli_connect('localhost', 'root', '', 'img') or die('Connection Failed.');

if (isset($_POST['submit'])) {
    if (empty($_FILES['image']['name'])) {
        $img_err = "Image is Required ! ";
    } else {
        $explode = explode('.', $_FILES['image']['name']);
        $extension = end($explode);
        $img = time() . "." . $extension;
        $tmp = $_FILES['image']['tmp_name'];
        $file = "img/" . $img;
        $move = move_uploaded_file($tmp, $file);
        if ($move) {
            $insert = "INSERT INTO imgs(`image`) VALUES ('$img')";
            $exe = mysqli_query($con, $insert);
            $success = "Image Upload Successfully.";
        } else {
            $error = "Something Went Wrong.";
        }
    }
}
if (isset($_POST['view'])) {
    header('location:view.php');
}

$select_data = "SELECT * FROM imgs";
$select_exe = mysqli_query($con, $select_data);

if (isset($_GET['update_id'])) {
    $update_id = $_GET['update_id'];

    $get_data = "SELECT * FROM imgs WHERE `id`='$update_id' ";
    $data_exe = mysqli_query($con, $get_data);
    $data_arr = mysqli_fetch_assoc($data_exe);
    $uimage = $data_arr['image'];
}

if (isset($_POST['update'])) {
    $id = $_GET['update_id'];

    if (isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")) {
        unlink('img/' . $uimage);
        $explode = explode('.', $_FILES['image']['name']);
        $extension = end($explode);
        $image = time() . "." . $extension;
        $tmp = $_FILES['image']['tmp_name'];
        $file = "img/" . $image;
        $move = move_uploaded_file($tmp, $file);
    } else {
        $image = $uimage;
    }
    $update = "UPDATE imgs SET `image`='$image' WHERE `id`= '$id'";
    $update_exe = mysqli_query($con, $update);
    if ($update_exe) {
        $success = "Image Update Successfully.";
        header('location:view.php');
    } else {
        $error = "Something Went Wrong.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image</title>
</head>

<body>
    <h1>Image</h1>
    <p style="color: green;">
        <?php if (isset($success)) {
            echo $success;
        } ?>
    </p>
    <form action="" method="post" enctype="multipart/form-data">

        <input type="file" name="image" id="">
        <p style="color : red;">
            <?php if (isset($img_err)) {
                echo $img_err;
            } elseif (isset($error)) {
                echo $error;
            } ?>
        </p>
        <?php if (isset($_GET['update_id'])) { ?>
            <img src="img/<?php echo $data_arr['image']; ?>" alt="image" style="width:100px;"><br>
            <input type="submit" value="update" name="update">
        <?php } elseif ((!isset($_GET['update_id']))) { ?>
            <input type="submit" value="submit" name="submit">
            <input type="submit" value="view" name="view">
        <?php } ?>

    </form>
    <script> if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }</script>
</body>

</html>
