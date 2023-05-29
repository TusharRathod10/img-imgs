<?php

$con = mysqli_connect('localhost', 'root', '', 'img');
if (isset($_POST['submit'])) {

    if (isset($_FILES['multiple']['name']) && empty($_FILES['multiple']['name'])) {
        $file_err = "multiple is requitred";
    } else {
        $image = $_FILES['multiple'];
        if (count($_FILES['multiple']['name']) >= 2) {
            for ($i = 0; $i < count($image['name']); $i++) {
                $rand = rand(1000000, 99999999);
                $explode = explode(".", $image['name'][$i]);
                $extension = end($explode);
                $multiple_image[] = $rand . "." . $extension;
                move_uploaded_file($image['tmp_name'][$i], "img/" . $multiple_image[$i]);
            }
            $image = implode(',', $multiple_image);
            if (isset($image) && !empty($image)) {

                $insert = "INSERT INTO multi(`images`)VALUES('$image')";
                $insert_exe = mysqli_query($con, $insert);
                header('location:multi-views.php');
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MULTIPLE</title>
</head>

<body>
    <h1>multiple</h1>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="multiple[]" multiple>
        <input type="submit" name="submit" value="submit">
    </form>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</body>

</html>