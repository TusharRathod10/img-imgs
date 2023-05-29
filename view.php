<?php

$con = mysqli_connect('localhost', 'root', '', 'img') or die('Connection Failed.');

$select = "SELECT * FROM imgs";
$exe = mysqli_query($con, $select);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>

    <div class="box" style="display: flex; flex-wrap: wrap; width: 100%; ">
        <?php while ($data = mysqli_fetch_assoc($exe)) { ?>
            <div class="box" style="display: flex; width:24%; flex-direction: column; margin:5px 8px; border:1px solid red;">
                <h2 style="margin: 10px;"><?php echo $data['id'];?></h2>
                              <img src="img/<?php echo $data['image']; ?>" alt="image" style="width:100%; height:100%;">
                <a href="insert.php?update_id=<?php echo $data['id']; ?>"><button class="btn btn-primary btn-circle" style="margin: 10px;"><i class="fa fa-edit"></i>update</button></a>    
            </div>
        <?php } ?>
    </div>
    <br><a href="insert.php"><input class="btn btn-primary" style="margin: 0px 10px; padding:5px 40px;" type="submit" value="Exit"></a>

</body>

</html>