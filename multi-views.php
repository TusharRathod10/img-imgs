<?php

$con = mysqli_connect('localhost', 'root', '', 'img');

$select = "SELECT * FROM multi";
$select_exe = mysqli_query($con, $select);

if (isset($_GET['delete_id'])) {
    $id = base64_decode($_GET['delete_id']);

    $select1 = "SELECT * FROM multi WHERE `id`='$id'";
    $select_exe1 = mysqli_query($con, $select1);

    while ($data = mysqli_fetch_assoc($select_exe1)) {
        $imgs = explode(',', $data['images']);
        for ($i = 0; $i < count($imgs); $i++) {
            if (isset($imgs[$i])) {
                unlink('img/' . $imgs[$i]);
                $delete_data = "DELETE FROM multi WHERE `id`='$id'";
                $delete_exe = mysqli_query($con, $delete_data);

                if ($delete_exe) {
                    $success = "Admin deleted successfully.";
                    header('location:multi-views.php');
                } else {
                    $error = "Something went wrong.";
                }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        td {
            padding: 30px;
            font-weight: bold;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <h1>MULTIPLE IMAGES</h1>
    <table>
        <tbody>
            <?php while ($data = mysqli_fetch_assoc($select_exe)) { ?>
                <tr>
                    <td>
                        <?php echo $data['id']; ?>
                    </td>
                    <?php
                    $img = explode(',', $data['images']);
                    for ($i = 0; $i < count($img); $i++) {
                        ?>
                        <td><img src="img/<?php echo $img[$i]; ?>" alt="" srcset="" width="100px"></td>
                    <?php } ?>

                    <td><a href="multi-views.php?delete_id=<?php echo base64_encode($data['id']); ?>"><button
                                class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></button></a></td>
                </tr>
            <?php } ?>
            <hr>
        </tbody>
    </table>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</body>

</html>